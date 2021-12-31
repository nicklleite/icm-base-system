<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RoleRepository
{
    protected Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * @param bool $isPaginated
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getAll(bool $isPaginated = false): Collection|LengthAwarePaginator
    {
        $roles = $this->role->whereNull('deleted_at');

        if ($isPaginated) {
            return $roles->paginate(15);
        }

        return $roles->get();
    }



}
