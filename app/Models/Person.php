<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $primaryKey = 'id';

    protected $fillable = [
        'full_name',
        'social_name',
        'birthday',
        'is_pwd',
        'birth_country',
        'birth_city',
    ];

    protected $hidden = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
