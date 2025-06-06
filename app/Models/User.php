<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_LECTURER = 'lecturer';
    public const ROLE_STUDENT = 'student';
    public const ROLE_STAFF = 'staff';
    public const ROLE_TECHNICIAN = 'technician';

    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'profile_picture',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

protected function profilePictureUrl(): Attribute
{
    return Attribute::get(function () {
        if (!$this->profile_picture) {
            return asset('images/default-pfp.png');
        }

        // If it's already a full URL
        if (Str::startsWith($this->profile_picture, ['http://', 'https://'])) {
            return $this->profile_picture;
        }

        return asset('storage/' . $this->profile_picture);
    });
}


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isLecturer(): bool
    {
        return $this->role === self::ROLE_LECTURER;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function isStaff(): bool
    {
        return $this->role === self::ROLE_STAFF;
    }

    public function isTechnician(): bool
    {
        return $this->role === self::ROLE_TECHNICIAN;
    }

    public function getDashboardRoute(): string
    {
        return match($this->role) {
            self::ROLE_ADMIN => route('admin.dashboard'),
            self::ROLE_LECTURER => route('lecturer.dashboard'),
            self::ROLE_STUDENT => route('student.dashboard'),
            self::ROLE_STAFF => route('staff.dashboard'),
            self::ROLE_TECHNICIAN => route('technician.dashboard'),
            default => route('home'),
        };
    }

    protected static function booted(): void
    {
        static::saving(function (User $user) {
            if (!in_array($user->role, [
                self::ROLE_ADMIN,
                self::ROLE_LECTURER,
                self::ROLE_STUDENT,
                self::ROLE_STAFF,
                self::ROLE_TECHNICIAN,
            ])) {
                throw new \InvalidArgumentException("Invalid role assigned");
            }
        });
    }
}
