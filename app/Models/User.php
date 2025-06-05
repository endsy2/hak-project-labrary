<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The admin user credentials
     */
    protected static array $adminCredentials = [
        'id' => 1,
        'name' => 'Admin Senghak',
        'email' => 'senghak@library.com',
        'password' => '062005' // Will be hashed automatically
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        // Create admin user if not exists when model is initialized
        static::created(function ($user) {
            static::ensureAdminExists();
        });

        static::booted(function () {
            static::ensureAdminExists();
        });
    }

    /**
     * Ensure admin user exists in database
     */
    public static function ensureAdminExists(): void
    {
        if (!static::where('id', static::$adminCredentials['id'])->exists()) {
            static::createAdmin();
        }
    }

    /**
     * Create the admin user
     */
    public static function createAdmin(): User
    {
        return static::create([
            'id' => static::$adminCredentials['id'],
            'name' => static::$adminCredentials['name'],
            'email' => static::$adminCredentials['email'],
            'password' => Hash::make(static::$adminCredentials['password']),
        ]);
    }

    /**
     * Check if user is the admin
     */
    public function isAdmin(): bool
    {
        return $this->id === static::$adminCredentials['id'];
    }
}