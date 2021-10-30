<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'hash', 'email', 'username', 'password', 'full_name'
    ];

    protected $hidden = ['hash', 'password'];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = (Hash::needsRehash($value))? Hash::make($value) : $value;
    }
}
