<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';
    protected $primaryKey = 'id';

    protected $fillable = [
        'hash',
        'company_id', 'full_name',
        'social_name', 'birthday',
        'birth_city', 'birth_state',
        'birth_country', 'is_pwd'
    ];

    protected $hidden = ['hash'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
