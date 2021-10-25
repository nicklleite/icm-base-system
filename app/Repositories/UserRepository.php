<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * @var User $user
     */
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $payload
     * @return User
     */
    public function store(array $payload): User
    {
        $this->user->fill($payload);
        $this->user->save();

        return $this->user;
    }

    public function update(array $payload): User
    {
        $this->user->fill($payload);
        $this->user->update();

        return $this->user;
    }

}
