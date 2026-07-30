<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DepartmentService;
use App\Http\Requests\Admin\StoreDepartmentRequest;
use App\Http\Requests\Admin\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    protected $service;

    public function __construct(DepartmentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $departments = $this->service->getAll();
        return view('admin.careers.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.careers.departments.create_edit');
    }

    public function store(StoreDepartmentRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department created successfully.');
    }

    public function edit($id)
    {
        $department = $this->service->getById($id);
        return view('admin.careers.departments.create_edit', compact('department'));
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department updated successfully.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.departments.index')
                         ->with('success', 'Department deleted successfully.');
    }
}
