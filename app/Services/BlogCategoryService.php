<?php

namespace App\Services;

use App\Repositories\BlogCategoryRepository;
use Illuminate\Support\Str;

class BlogCategoryService
{
    protected $blogCategoryRepository;

    public function __construct(BlogCategoryRepository $blogCategoryRepository)
    {
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    public function getAllCategories()
    {
        return $this->blogCategoryRepository->getAllCategories();
    }

    public function getCategoryById($id)
    {
        return $this->blogCategoryRepository->getCategoryById($id);
    }

    public function createCategory(array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->blogCategoryRepository->createCategory($data);
    }

    public function updateCategory($id, array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->blogCategoryRepository->updateCategory($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->blogCategoryRepository->deleteCategory($id);
    }
}
