<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /** Lessons the user has progress on (pivot: completed, score, completed_at). */
    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class)
            ->withPivot(['completed', 'score', 'completed_at'])
            ->withTimestamps();
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    /** Lessons the user has completed. */
    public function completedLessons()
    {
        return $this->lessons()->wherePivot('completed', true);
    }

    /** Has the user completed every published lesson up to and including $level. */
    public function hasCompletedLevel(int $level): bool
    {
        $total = Lesson::published()->where('level', '<=', $level)->count();
        if ($total === 0) {
            return false;
        }
        $done = $this->completedLessons()->where('level', '<=', $level)->count();
        return $done >= $total;
    }
}
