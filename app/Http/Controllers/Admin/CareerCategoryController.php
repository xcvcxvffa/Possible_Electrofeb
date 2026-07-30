<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CareerCategoryService;
use App\Http\Requests\Admin\StoreCareerCategoryRequest;
use App\Http\Requests\Admin\UpdateCareerCategoryRequest;

class CareerCategoryController extends Controller
{
    protected $service;

    public function __construct(CareerCategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->getAllCategories();
        return view('admin.careers.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->service->getAllCategories();
        return view('admin.careers.categories.create_edit', compact('categories'));
    }

    public function store(StoreCareerCategoryRequest $request)
    {
        $this->service->createCategory($request->validated());
        return redirect()->route('admin.career-categories.index')
                         ->with('success', 'Career category created successfully.');
    }

    public function edit($id)
    {
        $category = $this->service->getCategoryById($id);
        $categories = $this->service->getAllCategories();
        return view('admin.careers.categories.create_edit', compact('category', 'categories'));
    }

    public function update(UpdateCareerCategoryRequest $request, $id)
    {
        $this->service->updateCategory($id, $request->validated());
        return redirect()->route('admin.career-categories.index')
                         ->with('success', 'Career category updated successfully.');
    }

    public function destroy($id)
    {
        $this->service->deleteCategory($id);
        return redirect()->route('admin.career-categories.index')
                         ->with('success', 'Career category deleted successfully.');
    }
}
