<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Table: users
 *
 * === Columns ===
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon\Carbon|null $created_at
 * @property Carbon\Carbon|null $updated_at
 *
 * === Relationships ===
 * @property-read TimeLog|null $timeLogs
 * @property-read DatabaseNotification|null $notifications
 *
 * === Accessors/Attributes ===
 * @property-read mixed $activeTimeLog
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class);
    }

    public function activeTimeLog(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->timeLogs()->whereNull('ended_at')->first()
        );
    }
}
