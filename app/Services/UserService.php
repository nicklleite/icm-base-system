<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Array $payload
     * @return void
     */
    public function store(array $payload)
    {
        return $this->userRepository->store($payload);
    }

}
