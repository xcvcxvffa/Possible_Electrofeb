<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\JobLocationService;
use App\Http\Requests\Admin\StoreJobLocationRequest;
use App\Http\Requests\Admin\UpdateJobLocationRequest;

class JobLocationController extends Controller
{
    protected $service;

    public function __construct(JobLocationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $locations = $this->service->getAll();
        return view('admin.careers.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.careers.locations.create_edit');
    }

    public function store(StoreJobLocationRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.job-locations.index')
                         ->with('success', 'Location created successfully.');
    }

    public function edit($id)
    {
        $location = $this->service->getById($id);
        return view('admin.careers.locations.create_edit', compact('location'));
    }

    public function update(UpdateJobLocationRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->route('admin.job-locations.index')
                         ->with('success', 'Location updated successfully.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.job-locations.index')
                         ->with('success', 'Location deleted successfully.');
    }
}
