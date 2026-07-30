<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ProductCategoryService;
use App\Http\Requests\Admin\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    protected $categoryService;

    public function __construct(ProductCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.products.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = $this->categoryService->getParentCategories();
        return view('admin.products.categories.create_edit', compact('parentCategories'));
    }

    public function store(ProductCategoryRequest $request)
    {
        $this->categoryService->createCategory($request->validated());
        return redirect()->route('admin.product-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $parentCategories = $this->categoryService->getParentCategories();
        return view('admin.products.categories.create_edit', compact('category', 'parentCategories'));
    }

    public function update(ProductCategoryRequest $request, $id)
    {
        $this->categoryService->updateCategory($id, $request->validated());
        return redirect()->route('admin.product-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('admin.product-categories.index')->with('success', 'Category deleted successfully.');
    }
}
