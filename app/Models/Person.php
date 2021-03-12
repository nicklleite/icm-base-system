<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model {
    use HasFactory;

    public function user() {
        return $this->hasOne(User::class);
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