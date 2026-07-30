<?php

namespace App\Repositories;

use App\Models\CareerCategory;

class CareerCategoryRepository
{
    public function getAll()
    {
        return CareerCategory::with(['parent', 'iconMedia'])
            ->orderBy('sort_order')->orderBy('name')->get();
    }

    public function getAllActive()
    {
        return CareerCategory::active()->with('iconMedia')
            ->orderBy('sort_order')->get();
    }

    public function findById($id)
    {
        return CareerCategory::findOrFail($id);
    }

    public function create(array $data): CareerCategory
    {
        return CareerCategory::create($data);
    }

    public function update($id, array $data): CareerCategory
    {
        $cat = CareerCategory::findOrFail($id);
        $cat->update($data);
        return $cat;
    }

    public function delete($id): void
    {
        CareerCategory::findOrFail($id)->delete();
    }
}
