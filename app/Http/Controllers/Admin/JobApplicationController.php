<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JobApplicationService;
use App\Repositories\JobApplicationRepository;
use App\Repositories\CareerRepository;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    protected $service;
    protected $repository;
    protected $careerRepository;

    public function __construct(
        JobApplicationService $service,
        JobApplicationRepository $repository,
        CareerRepository $careerRepository
    ) {
        $this->service = $service;
        $this->repository = $repository;
        $this->careerRepository = $careerRepository;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['status', 'career_id', 'duplicate_flag', 'search']);
        $applications = $this->repository->getAllApplications($filters);
        $analytics = $this->repository->getAnalytics();
        
        $careers = $this->careerRepository->getAllCareers(); // For the filter dropdown

        $statuses = JobApplication::STATUSES;
        $statusColors = JobApplication::STATUS_COLORS;

        return view('admin.careers.applications.index', compact('applications', 'analytics', 'careers', 'filters', 'statuses', 'statusColors'));
    }

    public function show($id)
    {
        $application = $this->repository->getById($id);
        $statuses = JobApplication::STATUSES;
        return view('admin.careers.applications.show', compact('application', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'application_status' => 'required|string|in:' . implode(',', array_keys(JobApplication::STATUSES)),
            'note' => 'nullable|string'
        ]);

        $this->service->updateStatus($id, $request->input('application_status'), $request->input('note'));
        return redirect()->back()->with('success', 'Application status updated successfully.');
    }

    public function addNote(Request $request, $id)
    {
        $request->validate(['note' => 'required|string']);
        $this->service->addHrNote($id, $request->input('note'));
        return redirect()->back()->with('success', 'Internal note added.');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.job-applications.index')->with('success', 'Application deleted permanently.');
    }
}
