<?php

namespace App\Repositories;

use App\Models\Person;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PersonRepository
{
    /**
     * @var Person $person
     */
    protected Person $person;

    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * @param bool $isPaginated
     * @param int $perPage
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getAll(bool $isPaginated = false, int $perPage = 15): Collection|LengthAwarePaginator
    {
        $users = $this->person->whereNull('deleted_at');

        if ($isPaginated) {
            return $users->paginate($perPage);
        }

        return $users->get();
    }
}
