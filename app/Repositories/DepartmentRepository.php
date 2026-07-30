<?php

namespace App\Repositories;

use App\Models\Department;

class DepartmentRepository
{
    public function getAll()
    {
        return Department::orderBy('sort_order')->orderBy('name')->get();
    }

    public function getAllActive()
    {
        return Department::active()->get();
    }

    public function findById($id)
    {
        return Department::findOrFail($id);
    }

    public function create(array $data): Department
    {
        return Department::create($data);
    }

    public function update($id, array $data): Department
    {
        $dept = Department::findOrFail($id);
        $dept->update($data);
        return $dept;
    }

    public function delete($id): void
    {
        Department::findOrFail($id)->delete();
    }
}
