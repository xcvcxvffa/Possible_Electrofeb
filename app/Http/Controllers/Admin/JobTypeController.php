<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\JobTypeService;
use App\Http\Requests\Admin\StoreJobTypeRequest;
use App\Http\Requests\Admin\UpdateJobTypeRequest;

class JobTypeController extends Controller
{
    protected $service;

    public function __construct(JobTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $jobTypes = $this->service->getAll();
        return view('admin.careers.job-types.index', compact('jobTypes'));
    }

    public function create()
    {
        return view('admin.careers.job-types.create_edit');
    }

    public function store(StoreJobTypeRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.job-types.index')
                         ->with('success', 'Job Type created successfully.');
    }

    public function edit($id)
    {
        $jobType = $this->service->getById($id);
        return view('admin.careers.job-types.create_edit', compact('jobType'));
    }

    public function update(UpdateJobTypeRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('admin.job-types.index')
                         ->with('success', 'Job Type updated successfully.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.job-types.index')
                         ->with('success', 'Job Type deleted successfully.');
    }
}
