<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @mixin Eloquent
 */
class User extends Eloquent
{
    use HasFactory;

    protected $fillable = [
        'hash', 'email', 'username', 'full_name'
    ];
}
