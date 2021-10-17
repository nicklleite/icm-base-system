<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(array $payload)
    {
        $this->user->fill($payload);
        return $this->user;
    }

}
