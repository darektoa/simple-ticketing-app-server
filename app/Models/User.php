<?php

namespace App\Models;

use App\Traits\Models\Searchable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable, SoftDeletes;

    protected $appends = [
        'full_name', 'gender_name', 'role_name'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'detail'            => 'json',
    ];
    
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $genderNames = [
        1 => 'Male',
        2 => 'Female',
    ];

    public $roleNames = [
        1 => 'Admin',
        2 => 'User',
    ];


    public function sendTransactions() {
        return $this->hasMany(Transaction::class, 'sender_id');
    }


    public function receiveTransactions() {
        return $this->hasMany(Transaction::class, 'receiver_id');
    }


    public function genderName():Attribute {
        return Attribute::make(
            get: fn($value, $attrs) => (
                $this->genderNames[$attrs['gender']] ?? 'Unknown'
            ),
        );
    }


    public function roleName():Attribute {
        return Attribute::make(
            get: fn($value, $attrs) => (
                $this->roleNames[$attrs['role']] ?? 'Unknown'
            ),
        );
    }


    public function fullName():Attribute {
        return Attribute::make(
            get: fn($value, $attrs) => (
                "{$attrs['first_name']} {$attrs['last_name']}"
            )
        );
    }
}
