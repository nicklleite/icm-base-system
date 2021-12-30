<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RoleService
{

    protected RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param bool $isPaginated
     * @param int $perPage
     *
     * @return Collection|LengthAwarePaginator
     */
    public function list(bool $isPaginated): Collection|LengthAwarePaginator
    {
        return $this->roleRepository->getAll(isPaginated: $isPaginated);
    }

}
