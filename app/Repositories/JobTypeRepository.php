<?php

namespace App\Repositories;

use App\Models\JobType;

class JobTypeRepository
{
    public function getAll()
    {
        return JobType::orderBy('name')->get();
    }

    public function getAllActive()
    {
        return JobType::active()->get();
    }

    public function findById($id)
    {
        return JobType::findOrFail($id);
    }

    public function create(array $data): JobType
    {
        return JobType::create($data);
    }

    public function update($id, array $data): JobType
    {
        $type = JobType::findOrFail($id);
        $type->update($data);
        return $type;
    }

    public function delete($id): void
    {
        JobType::findOrFail($id)->delete();
    }
}
