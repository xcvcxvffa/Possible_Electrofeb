<?php

namespace App\Services;

use App\Repositories\CareerCategoryRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CareerCategoryService
{
    protected $categoryRepository;

    public function __construct(CareerCategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->findById($id);
    }

    public function createCategory(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['slug'] = $this->generateSlug($data['name']);
            $data['created_by'] = auth()->id();
            return $this->categoryRepository->create($data);
        });
    }

    public function updateCategory($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $category = $this->categoryRepository->findById($id);
            if ($category->name !== $data['name']) {
                $data['slug'] = $this->generateSlug($data['name'], $id);
            }
            $data['updated_by'] = auth()->id();
            return $this->categoryRepository->update($id, $data);
        });
    }

    public function deleteCategory($id)
    {
        return DB::transaction(function () use ($id) {
            $category = $this->categoryRepository->findById($id);
            // Handle child categories if needed, or rely on FK constraints/logic
            $category->update(['deleted_by' => auth()->id()]);
            $this->categoryRepository->delete($id);
        });
    }

    protected function generateSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        $query = \App\Models\CareerCategory::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $query = \App\Models\CareerCategory::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
            $count++;
        }

        return $slug;
    }
}
