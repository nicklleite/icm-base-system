<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model {
    use HasFactory;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'status',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function company() {
        return $this->hasOne(Company::class);
    }

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function contacts() {
        return $this->hasMany(Contact::class);
    }

    public function dependents() {
        return $this->hasMany(Dependent::class);
    }

    public function responsibles() {
        return $this->hasMany(Responsible::class);
    }
}