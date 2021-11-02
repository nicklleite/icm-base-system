<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @param bool $isPaginated
     * @param int $perPage
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getAll(bool $isPaginated = false, int $perPage = 15): Collection|LengthAwarePaginator
    {
        $users = User::whereNull('deleted_at');

        if ($isPaginated) {
            return $users->paginate($perPage);
        }

        return $users->get();
    }

    /**
     * @param int $id
     * @return User
     */
    public function getById(int $id): User
    {
        return $this->user->findOrFail($id);
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

    public function update(int $id, array $payload): User
    {
        $user = $this->user->findOrFail($id);
        $user->update($payload);

        return $user;
    }

}
