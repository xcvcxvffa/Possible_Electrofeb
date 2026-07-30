<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CareerService;
use App\Repositories\CareerRepository;
use App\Services\CareerCategoryService;
use App\Services\DepartmentService;
use App\Services\JobLocationService;
use App\Services\JobTypeService;
use App\Repositories\SkillRepository;
use App\Http\Requests\Admin\StoreCareerRequest;
use App\Http\Requests\Admin\UpdateCareerRequest;

class CareerController extends Controller
{
    protected $service;
    protected $repository;
    protected $categoryService;
    protected $departmentService;
    protected $locationService;
    protected $jobTypeService;
    protected $skillRepository;

    public function __construct(
        CareerService $service,
        CareerRepository $repository,
        CareerCategoryService $categoryService,
        DepartmentService $departmentService,
        JobLocationService $locationService,
        JobTypeService $jobTypeService,
        SkillRepository $skillRepository
    ) {
        $this->service = $service;
        $this->repository = $repository;
        $this->categoryService = $categoryService;
        $this->departmentService = $departmentService;
        $this->locationService = $locationService;
        $this->jobTypeService = $jobTypeService;
        $this->skillRepository = $skillRepository;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['status', 'career_category_id', 'department_id', 'job_location_id', 'job_type_id', 'featured', 'urgent', 'expired', 'search']);
        $careers = $this->repository->getAllCareers($filters);
        $analytics = $this->repository->getAnalytics();
        
        $categories = $this->categoryService->getAllCategories();
        $departments = $this->departmentService->getAll();
        $locations = $this->locationService->getAll();
        $jobTypes = $this->jobTypeService->getAll();

        return view('admin.careers.jobs.index', compact('careers', 'analytics', 'categories', 'departments', 'locations', 'jobTypes', 'filters'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        $departments = $this->departmentService->getAllActive();
        $locations = $this->locationService->getAllActive();
        $jobTypes = $this->jobTypeService->getAllActive();
        $skills = $this->skillRepository->getAllActive();

        return view('admin.careers.jobs.create_edit', compact('categories', 'departments', 'locations', 'jobTypes', 'skills'));
    }

    public function store(StoreCareerRequest $request)
    {
        $this->service->createCareer($request->validated());
        return redirect()->route('admin.careers.index')->with('success', 'Career / Job created successfully.');
    }

    public function edit($id)
    {
        $career = $this->repository->getCareerById($id);
        
        $categories = $this->categoryService->getAllCategories();
        $departments = $this->departmentService->getAllActive();
        $locations = $this->locationService->getAllActive();
        $jobTypes = $this->jobTypeService->getAllActive();
        $skills = $this->skillRepository->getAllActive();

        return view('admin.careers.jobs.create_edit', compact('career', 'categories', 'departments', 'locations', 'jobTypes', 'skills'));
    }

    public function update(UpdateCareerRequest $request, $id)
    {
        $this->service->updateCareer($id, $request->validated());
        return redirect()->route('admin.careers.index')->with('success', 'Career / Job updated successfully.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.careers.index')->with('success', 'Career moved to trash.');
    }

    public function trash()
    {
        $careers = $this->repository->getTrashedCareers();
        return view('admin.careers.jobs.trash', compact('careers'));
    }

    public function restore($id)
    {
        $this->repository->restore($id);
        return redirect()->route('admin.careers.trash')->with('success', 'Career restored successfully.');
    }

    public function forceDelete($id)
    {
        $this->repository->forceDelete($id);
        return redirect()->route('admin.careers.trash')->with('success', 'Career permanently deleted.');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $ids = explode(',', $request->input('ids'));

        if (empty($ids) || $ids[0] === "") {
            return redirect()->back()->with('error', 'No items selected.');
        }

        if ($action === 'delete') {
            $this->service->bulkDelete($ids);
            return redirect()->back()->with('success', 'Selected careers moved to trash.');
        } elseif ($action === 'restore') {
            $this->repository->bulkRestore($ids);
            return redirect()->back()->with('success', 'Selected careers restored.');
        }

        return redirect()->back()->with('error', 'Invalid action.');
    }
}
