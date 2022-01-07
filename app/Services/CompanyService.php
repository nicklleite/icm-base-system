<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CompanyService
{
    protected CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param bool $isPaginated
     * @param int $perPage
     *
     * @return Collection|LengthAwarePaginator
     */
    public function list(bool $isPaginated = false, int $perPage = 10): Collection|LengthAwarePaginator
    {
        return $this->companyRepository->getAll(isPaginated: $isPaginated, perPage: $perPage);
    }

    /**
     * @param Company $company
     * @return Company
     */
    public function get(Company $company): Company
    {
        return $this->companyRepository->getById($company);
    }

    /**
     * @param array $payload
     * @return Company
     */
    public function store(array $payload): Company
    {
        $payload['hash'] = (string) Str::uuid();
        return $this->companyRepository->store($payload);
    }
}
