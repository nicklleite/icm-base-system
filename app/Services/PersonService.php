<?php

namespace App\Services;

use App\Models\Person;
use App\Repositories\PersonRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PersonService
{
    /**
     * @var PersonRepository $personRepository
     */
    protected PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * @param bool $isPaginated
     * @param int $perPage
     *
     * @return Collection|LengthAwarePaginator
     */
    public function list(bool $isPaginated = false, int $perPage = 10): Collection|LengthAwarePaginator
    {
        return $this->personRepository->getAll(isPaginated: $isPaginated, perPage: $perPage);
    }

    /**
     *
     */
    public function store(array $payload): Person
    {
        $payload['hash'] = (string) Str::uuid();
        return $this->personRepository->store($payload);;
    }

}
