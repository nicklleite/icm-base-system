<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $primaryKey = 'id';

    protected $fillable = [
        'hash', 'company_name', 'trading_name', 'registered_number'
    ];

    protected $hidden = [];

    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
