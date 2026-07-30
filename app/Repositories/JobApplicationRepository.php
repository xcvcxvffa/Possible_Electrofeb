<?php

namespace App\Repositories;

use App\Models\JobApplication;

class JobApplicationRepository
{
    public function baseQuery()
    {
        return JobApplication::with(['career.department', 'career.location', 'resumeMedia']);
    }

    public function getAllApplications(array $filters = [])
    {
        $query = $this->baseQuery();

        if (!empty($filters['status'])) {
            $query->byStatus($filters['status']);
        }
        if (!empty($filters['career_id'])) {
            $query->where('career_id', $filters['career_id']);
        }
        if (isset($filters['duplicate_flag']) && $filters['duplicate_flag'] !== '') {
            $query->where('duplicate_flag', $filters['duplicate_flag']);
        }
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return $query->latest('applied_at')->paginate(20);
    }

    public function getById($id)
    {
        return JobApplication::with([
            'career.department', 'career.location', 'resumeMedia',
            'statusHistory.changedBy', 'interviews.creator', 'hrNotes.creator'
        ])->findOrFail($id);
    }

    public function create(array $data): JobApplication
    {
        return JobApplication::create($data);
    }

    public function update($id, array $data): JobApplication
    {
        $app = JobApplication::findOrFail($id);
        $app->update($data);
        return $app;
    }

    public function delete($id): void
    {
        JobApplication::findOrFail($id)->delete();
    }

    public function getAnalytics(): array
    {
        return [
            'total'               => JobApplication::count(),
            'applied'             => JobApplication::byStatus(JobApplication::STATUS_APPLIED)->count(),
            'shortlisted'         => JobApplication::byStatus(JobApplication::STATUS_SHORTLISTED)->count(),
            'interview_scheduled' => JobApplication::byStatus(JobApplication::STATUS_INTERVIEW_SCHEDULED)->count(),
            'selected'            => JobApplication::byStatus(JobApplication::STATUS_SELECTED)->count(),
            'rejected'            => JobApplication::byStatus(JobApplication::STATUS_REJECTED)->count(),
        ];
    }
}
