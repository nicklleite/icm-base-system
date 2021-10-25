<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository $userRepository
     */
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $payload
     * @return User
     */
    public function store(array $payload): User
    {
        return $this->userRepository->store($payload);
    }

    /**
     * @param array $payload
     * @return User
     */
    public function update(array $payload): User
    {
        return $this->userRepository->update($payload);
    }

}
