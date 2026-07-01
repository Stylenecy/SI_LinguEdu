@extends('layouts.admin')

@section('title', 'Manajemen Sertifikasi')
@section('page_title', 'Sertifikat')

@push('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        #preview-cert {
            width: 700px;
            max-width: 100%;
            height: 500px;
            background-size: cover;
            background-position: center;
        }
    </style>
@endpush

@section('content')

    {{-- Flash & Validation --}}
    @if (session('status'))
        <div class="alert alert-success mb-5">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger mb-5">
            <ul class="list-disc ps-5">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    {{-- Intro --}}
    <div class="mb-6">
        <p class="eyebrow">Manajemen</p>
        <h2 class="mt-1 font-display text-3xl font-semibold text-ink">Sertifikasi</h2>
        <p class="mt-1 text-sm text-muted">Lihat sertifikat yang diterbitkan dan kelola template.</p>
    </div>

    {{-- Tab --}}
    <div class="mb-6 flex flex-wrap gap-2">
        <button type="button" onclick="showTab('issued')" id="tab-btn-issued" class="chip chip-active">Sertifikat Terbit</button>
        <button type="button" onclick="showTab('template')" id="tab-btn-template" class="chip">Template Sertifikat</button>
    </div>

    {{-- ============================= --}}
    {{-- 1) DAFTAR SERTIFIKAT TERBIT --}}
    {{-- ============================= --}}
    <div id="tab-issued" class="card tab-page p-6">
        <h3 class="mb-4 font-display text-lg font-semibold text-ink">Sertifikat Diterbitkan</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-line text-left text-muted">
                        <th class="py-3 font-medium">No. Sertifikat</th>
                        <th class="py-3 font-medium">Penerima</th>
                        <th class="py-3 text-center font-medium">Level</th>
                        <th class="py-3 text-center font-medium">Nilai</th>
                        <th class="py-3 text-center font-medium">Diterbitkan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($certificates as $cert)
                        <tr class="border-b border-line">
                            <td class="py-3 font-mono text-xs text-brand">{{ $cert->certificate_number }}</td>
                            <td class="py-3">
                                <div class="font-semibold text-ink">{{ $cert->user->name ?? '-' }}</div>
                                <div class="text-xs text-muted">{{ $cert->user->email ?? '' }}</div>
                            </td>
                            <td class="py-3 text-center">
                                <span class="badge badge-brand">{{ $cert->level }}</span>
                            </td>
                            <td class="py-3 text-center font-semibold text-ink">{{ $cert->final_score }}</td>
                            <td class="py-3 text-center text-muted">{{ $cert->issued_at?->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center">
                                <div class="mx-auto mb-3 grid h-12 w-12 place-items-center rounded-full bg-brand-50 text-brand-500">
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6"><path d="M15 15a6 6 0 1 0-6 0m6 0-3 7-3-7m6 0a6 6 0 0 1-6 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <p class="text-muted">Belum ada sertifikat yang diterbitkan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- 2) TEMPLATE SERTIFIKAT (client-side builder) --}}
    {{-- ============================= --}}
    <div id="tab-template" class="card tab-page hidden p-6">
        <h3 class="mb-5 font-display text-lg font-semibold text-ink">Template Sertifikat</h3>

        {{-- FORM CREATE TEMPLATE --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <label class="field-label">Judul Sertifikat</label>
                <input id="temp-title" type="text" class="field">
            </div>
            <div>
                <label class="field-label">Nama Penandatangan</label>
                <input id="temp-sign" type="text" class="field">
            </div>
            <div class="md:col-span-2">
                <label class="field-label">Deskripsi</label>
                <textarea id="temp-desc" class="field" rows="2"></textarea>
            </div>
            <div class="md:col-span-2">
                <label class="field-label">Background Sertifikat (URL)</label>
                <input id="temp-bg" type="text" class="field" placeholder="https://...">
            </div>
        </div>
        <button onclick="createTemplate()" class="btn btn-primary mt-5">Simpan Template</button>

        {{-- TABLE TEMPLATE --}}
        <h4 class="mb-3 mt-8 font-display text-base font-semibold text-ink">Daftar Template</h4>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-line text-left text-muted">
                        <th class="py-3 font-medium">Judul</th>
                        <th class="py-3 font-medium">Penandatangan</th>
                        <th class="py-3 text-center font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody id="template-table"></tbody>
            </table>
        </div>

        {{-- PREVIEW --}}
        <h4 class="mb-3 mt-8 font-display text-base font-semibold text-ink">Preview Sertifikat</h4>
        <div id="preview-cert" class="relative rounded-2xl border border-line bg-white shadow-soft">
            <div id="prev-title" class="absolute top-10 w-full text-center text-2xl font-bold"></div>
            <div id="prev-desc" class="absolute top-48 w-full px-6 text-center"></div>
            <div id="prev-sign" class="absolute bottom-10 w-full text-center font-medium"></div>
            <div id="prev-date" class="absolute bottom-4 w-full text-center text-sm text-gray-600"></div>
        </div>

        <div class="mt-4 flex flex-wrap gap-3">
            <button onclick="downloadPNG()" class="btn btn-outline">Download PNG</button>
            <button onclick="downloadPDF()" class="btn btn-accent">Download PDF</button>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let templates = JSON.parse(localStorage.getItem("cert_templates") || "[]");

    function save() {
        localStorage.setItem("cert_templates", JSON.stringify(templates));
    }

    function showTab(tab) {
        document.querySelectorAll(".tab-page").forEach(t => t.classList.add("hidden"));
        document.getElementById("tab-" + tab).classList.remove("hidden");

        document.querySelectorAll("[id^='tab-btn']").forEach(b => b.classList.remove("chip-active"));
        document.getElementById("tab-btn-" + tab).classList.add("chip-active");

        updateUI();
    }

    function createTemplate() {
        templates.push({
            id: Date.now(),
            title: document.getElementById("temp-title").value,
            desc: document.getElementById("temp-desc").value,
            sign: document.getElementById("temp-sign").value,
            bg: document.getElementById("temp-bg").value
        });
        save();
        updateUI();
        previewLast();
    }

    function deleteTemplate(id) {
        templates = templates.filter(t => t.id !== id);
        save();
        updateUI();
    }

    function previewLast() {
        if (!templates.length) return;
        const t = templates[templates.length - 1];
        document.getElementById("preview-cert").style.backgroundImage = `url('${t.bg}')`;
        document.getElementById("prev-title").innerText = t.title;
        document.getElementById("prev-desc").innerText = t.desc;
        document.getElementById("prev-sign").innerText = t.sign;
        const d = new Date().toLocaleDateString("id-ID", { day: "numeric", month: "long", year: "numeric" });
        document.getElementById("prev-date").innerText = "Diterbitkan pada: " + d;
    }

    function downloadPNG() {
        html2canvas(document.getElementById("preview-cert")).then(canvas => {
            const link = document.createElement("a");
            link.download = "sertifikat.png";
            link.href = canvas.toDataURL();
            link.click();
        });
    }

    function downloadPDF() {
        const { jsPDF } = window.jspdf;
        html2canvas(document.getElementById("preview-cert")).then(canvas => {
            const img = canvas.toDataURL("image/png");
            const pdf = new jsPDF("landscape", "pt", [700, 500]);
            pdf.addImage(img, "PNG", 0, 0, 700, 500);
            pdf.save("sertifikat.pdf");
        });
    }

    function updateUI() {
        let html = "";
        templates.forEach(x => {
            html += `
            <tr class="border-b border-line">
                <td class="py-3 text-ink">${x.title || '-'}</td>
                <td class="py-3 text-muted">${x.sign || '-'}</td>
                <td class="py-3 text-center">
                    <button onclick="deleteTemplate(${x.id})" class="btn btn-ghost btn-sm" style="color: var(--color-danger)">Hapus</button>
                </td>
            </tr>`;
        });
        document.getElementById("template-table").innerHTML = html;
    }

    updateUI();
</script>
@endpush
