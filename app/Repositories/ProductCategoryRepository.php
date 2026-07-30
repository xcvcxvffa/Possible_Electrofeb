<?php

namespace App\Repositories;

use App\Models\ProductCategory;

class ProductCategoryRepository
{
    public function getAllCategories()
    {
        return ProductCategory::orderBy('sort_order', 'asc')->get();
    }

    public function getCategoryById($id)
    {
        return ProductCategory::findOrFail($id);
    }

    public function getCategoryBySlug($slug)
    {
        return ProductCategory::where('slug', $slug)->firstOrFail();
    }

    public function getParentCategories()
    {
        return ProductCategory::whereNull('parent_id')->orderBy('sort_order', 'asc')->get();
    }

    public function createCategory(array $data)
    {
        return ProductCategory::create($data);
    }

    public function updateCategory($id, array $data)
    {
        $category = $this->getCategoryById($id);
        $category->update($data);
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = $this->getCategoryById($id);
        return $category->delete();
    }
}
