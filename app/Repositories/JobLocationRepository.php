<?php

namespace App\Repositories;

use App\Models\JobLocation;

class JobLocationRepository
{
    public function getAll()
    {
        return JobLocation::orderBy('city')->get();
    }

    public function getAllActive()
    {
        return JobLocation::active()->get();
    }

    public function findById($id)
    {
        return JobLocation::findOrFail($id);
    }

    public function create(array $data): JobLocation
    {
        return JobLocation::create($data);
    }

    public function update($id, array $data): JobLocation
    {
        $loc = JobLocation::findOrFail($id);
        $loc->update($data);
        return $loc;
    }

    public function delete($id): void
    {
        JobLocation::findOrFail($id)->delete();
    }
}
