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
     * @param int $user
     * @return User
     */
    public function get(int $user): User
    {
        return $this->userRepository->getById($user);
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
     * @param int $id
     * @param array $payload
     * @return User
     */
    public function update(int $id, array $payload): User
    {
        return $this->userRepository->update($id, $payload);
    }

}
