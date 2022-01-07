<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CompanyRepository
{
    protected Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @param bool $isPaginated
     * @param int $perPage
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getAll(bool $isPaginated = false, int $perPage = 15): Collection|LengthAwarePaginator
    {
        $companies = $this->company->whereNull('deleted_at');

        if ($isPaginated) {
            return $companies->paginate($perPage);
        }

        return $companies->get();
    }

    /**
     * @param Company $company
     * @return Company
     */
    public function getById(Company $company): Company
    {
        $id = $company->id ?? 0;
        return $this->company->findOrFail($id);
    }

    /**
     * @param array $payload
     * @return Company
     */
    public function store(array $payload): Company
    {
        $this->company->fill($payload);
        $this->company->save();

        return $this->company;
    }
}
