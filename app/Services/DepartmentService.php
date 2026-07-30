<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;
use Illuminate\Support\Str;

class DepartmentService
{
    protected $repository;

    public function __construct(DepartmentRepository $repository)
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
        $data['slug'] = Str::slug($data['name']);
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        $dept = $this->repository->findById($id);
        if ($dept->name !== $data['name']) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
