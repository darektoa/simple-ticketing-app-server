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


    public function sendTransactions() {
        return $this->hasMany(Transaction::class, 'sender_id');
    }


    public function receiveTransactions() {
        return $this->hasMany(Transaction::class, 'receiver_id');
    }


    public function emergencyContact() {
        return $this->hasMany(EmergencyContact::class);
    }
}
