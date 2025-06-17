<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Атрибути, доступні для масового заповнення.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'role',
        'group',
        'phone',
    ];

    /**
     * Атрибути, які приховуються при серіалізації.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Приведення типів атрибутів.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Зв'язок "багато-до-багатьох" з ролями.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Перевіряє, чи має користувач вказані роль(і) за slug.
     *
     * @param  string|array<string>  $slugs
     * @return bool
     */
    public function hasRole(string|array $slugs): bool
    {
        $slugs = (array) $slugs;

        return $this->roles()->whereIn('slug', $slugs)->exists();
    }

    /**
     * Перевіряє, чи має користувач доступ до ресурсу.
     *
     * @param  string  $resource
     * @return bool
     */
    public function hasPermission(string $resource): bool
    {
        // Якщо є супер-адмін, даємо доступ до всього
        if ($this->hasRole('super-admin')) {
            return true;
        }

        foreach ($this->roles as $role) {
            if (in_array($resource, $role->permissions ?? [], true)) {
                return true;
            }
        }

        return false;
    }

    // Методи для простих ролей
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isAdminRole(): bool
    {
        return $this->role === 'admin';
    }

    // Перевірка домену email
    public function hasValidStudentEmail(): bool
    {
        return str_ends_with($this->email, '@student.uzhnu.edu.ua');
    }

    // Зв'язки для практичної підготовки
    public function studentApplications()
    {
        return $this->hasMany(\App\Models\StudentApplication::class, 'student_email', 'email');
    }

    public function teacherTopics()
    {
        return $this->hasMany(\App\Models\PracticalTopic::class, 'teacher_id');
    }

}
