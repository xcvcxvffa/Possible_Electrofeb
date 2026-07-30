<?php

namespace App\Services;

use App\Repositories\JobLocationRepository;

class JobLocationService
{
    protected $repository;

    public function __construct(JobLocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getAllActive()
    {
        return $this->repository->getAllActive();
    }

    public function getById($id)
    {
        return $this->repository->findById($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
