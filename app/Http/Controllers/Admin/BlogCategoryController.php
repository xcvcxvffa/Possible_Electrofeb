<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BlogCategoryService;
use App\Http\Requests\Admin\StoreBlogCategoryRequest;
use App\Http\Requests\Admin\UpdateBlogCategoryRequest;

class BlogCategoryController extends Controller
{
    protected $categoryService;

    public function __construct(BlogCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = $this->categoryService->getAllCategories();
        return view('admin.blog-categories.create_edit', compact('parentCategories'));
    }

    public function store(StoreBlogCategoryRequest $request)
    {
        $this->categoryService->createCategory($request->validated());
        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog category created successfully.');
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $parentCategories = $this->categoryService->getAllCategories()->where('id', '!=', $id);
        return view('admin.blog-categories.create_edit', compact('category', 'parentCategories'));
    }

    public function update(UpdateBlogCategoryRequest $request, $id)
    {
        $this->categoryService->updateCategory($id, $request->validated());
        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog category updated successfully.');
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog category deleted successfully.');
    }
}
