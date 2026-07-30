<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Services\BlogCategoryService;

use App\Models\User;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;

class BlogController extends Controller
{
    protected $blogService;
    protected $categoryService;

    public function __construct(BlogService $blogService, BlogCategoryService $categoryService)
    {
        $this->blogService = $blogService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['status', 'category_id', 'author_id', 'featured', 'search']);
        $blogs = $this->blogService->getAllBlogs($filters);
        $categories = $this->categoryService->getAllCategories();
        $authors = User::all();

        return view('admin.blogs.index', compact('blogs', 'categories', 'authors', 'filters'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        $authors = User::all();
        $allBlogs = $this->blogService->getAllBlogs();

        return view('admin.blogs.create_edit', compact('categories', 'authors', 'allBlogs'));
    }

    public function store(StoreBlogRequest $request)
    {
        $this->blogService->createBlog($request->validated());
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit($id)
    {
        $blog = $this->blogService->getBlogById($id);
        $categories = $this->categoryService->getAllCategories();
        $authors = User::all();
        $allBlogs = $this->blogService->getAllBlogs()->where('id', '!=', $id);

        return view('admin.blogs.create_edit', compact('blog', 'categories', 'authors', 'allBlogs'));
    }

    public function update(UpdateBlogRequest $request, $id)
    {
        $this->blogService->updateBlog($id, $request->validated());
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy($id)
    {
        $this->blogService->deleteBlog($id);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog moved to trash.');
    }

    public function trash()
    {
        $trashedBlogs = $this->blogService->getTrashedBlogs();
        return view('admin.blogs.trash', compact('trashedBlogs'));
    }

    public function restore($id)
    {
        $this->blogService->restoreBlog($id);
        return redirect()->route('admin.blogs.trash')->with('success', 'Blog restored successfully.');
    }

    public function forceDelete($id)
    {
        $this->blogService->forceDeleteBlog($id);
        return redirect()->route('admin.blogs.trash')->with('success', 'Blog permanently deleted.');
    }

    public function bulkAction(Request $request)
    {
        $ids = $request->input('ids', []);
        $action = $request->input('action');

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No items selected.');
        }

        if ($action === 'delete') {
            $this->blogService->bulkDelete($ids);
            return redirect()->back()->with('success', 'Selected blogs deleted successfully.');
        } elseif ($action === 'restore') {
            $this->blogService->bulkRestore($ids);
            return redirect()->back()->with('success', 'Selected blogs restored successfully.');
        }

        return redirect()->back()->with('error', 'Invalid action.');
    }
}
