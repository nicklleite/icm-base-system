<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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
     * @param bool $isPaginated
     * @param int $perPage
     *
     * @return Collection|LengthAwarePaginator
     */
    public function list(bool $isPaginated = false, int $perPage = 10): Collection|LengthAwarePaginator
    {
        return $this->userRepository->getAll(isPaginated: $isPaginated, perPage: $perPage);
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
        $payload['hash'] = (string) Str::uuid();
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
