<?php

namespace App\Services;

use App\Repositories\ProductCategoryRepository;
use Illuminate\Support\Str;

class ProductCategoryService
{
    protected $categoryRepository;

    public function __construct(ProductCategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }
    
    public function getParentCategories()
    {
        return $this->categoryRepository->getParentCategories();
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    public function createCategory(array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        
        return $this->categoryRepository->createCategory($data);
    }

    public function updateCategory($id, array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        
        return $this->categoryRepository->updateCategory($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }
}
