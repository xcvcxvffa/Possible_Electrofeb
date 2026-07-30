<?php

namespace App\Repositories;

use App\Models\BlogCategory;

class BlogCategoryRepository
{
    public function getAllCategories()
    {
        return BlogCategory::with(['parent', 'imageMedia'])->orderBy('sort_order', 'asc')->get();
    }

    public function getCategoryById($id)
    {
        return BlogCategory::with(['parent', 'children', 'imageMedia'])->findOrFail($id);
    }

    public function createCategory(array $data)
    {
        return BlogCategory::create($data);
    }

    public function updateCategory($id, array $data)
    {
        $category = BlogCategory::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = BlogCategory::findOrFail($id);
        return $category->delete();
    }
}
