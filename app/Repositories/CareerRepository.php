<?php

namespace App\Repositories;

use App\Models\Career;

class CareerRepository
{
    protected function baseQuery()
    {
        return Career::with([
            'category', 'department', 'location', 'jobType',
            'bannerMedia', 'creator',
        ]);
    }

    public function getAllCareers(array $filters = [])
    {
        $query = $this->baseQuery();

        if (!empty($filters['status']) && $filters['status'] !== '') {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['career_category_id'])) {
            $query->where('career_category_id', $filters['career_category_id']);
        }
        if (!empty($filters['department_id'])) {
            $query->where('department_id', $filters['department_id']);
        }
        if (!empty($filters['job_location_id'])) {
            $query->where('job_location_id', $filters['job_location_id']);
        }
        if (!empty($filters['job_type_id'])) {
            $query->where('job_type_id', $filters['job_type_id']);
        }
        if (isset($filters['featured']) && $filters['featured'] !== '') {
            $query->where('featured', $filters['featured']);
        }
        if (isset($filters['urgent']) && $filters['urgent'] !== '') {
            $query->where('urgent', $filters['urgent']);
        }
        if (!empty($filters['expired'])) {
            $query->expired();
        }
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('job_code', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function getPublicCareers(array $filters = [])
    {
        $query = Career::with(['department', 'location', 'jobType'])
            ->active()
            ->notExpired();

        if (!empty($filters['department_id'])) {
            $query->where('department_id', $filters['department_id']);
        }
        if (!empty($filters['job_location_id'])) {
            $query->where('job_location_id', $filters['job_location_id']);
        }
        if (!empty($filters['job_type_id'])) {
            $query->where('job_type_id', $filters['job_type_id']);
        }
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        return $query->orderByDesc('featured')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function getCareerById($id)
    {
        return Career::with([
            'category', 'department', 'location', 'jobType',
            'bannerMedia', 'brochureMedia',
            'responsibilities', 'requirements', 'benefits',
            'skillItems.skill', 'faqs', 'documents.media',
            'relatedCareers.department', 'relatedCareers.location',
            'seo.ogImageMedia', 'slugHistory', 'creator',
        ])->findOrFail($id);
    }

    public function getCareerBySlug($slug)
    {
        return Career::with([
            'category', 'department', 'location', 'jobType',
            'bannerMedia', 'brochureMedia',
            'responsibilities', 'requirements', 'benefits',
            'skillItems.skill', 'faqs', 'documents.media',
            'relatedCareers.department', 'relatedCareers.location',
            'seo.ogImageMedia',
        ])->active()->notExpired()->where('slug', $slug)->firstOrFail();
    }

    public function getTrashedCareers()
    {
        return Career::onlyTrashed()->with(['department', 'location'])->latest('deleted_at')->get();
    }

    public function create(array $data): Career
    {
        return Career::create($data);
    }

    public function update($id, array $data): Career
    {
        $career = Career::findOrFail($id);
        $career->update($data);
        return $career;
    }

    public function delete($id): void
    {
        Career::findOrFail($id)->delete();
    }

    public function restore($id): void
    {
        Career::onlyTrashed()->findOrFail($id)->restore();
    }

    public function forceDelete($id): void
    {
        Career::onlyTrashed()->findOrFail($id)->forceDelete();
    }

    public function bulkDelete(array $ids): void
    {
        Career::whereIn('id', $ids)->delete();
    }

    public function bulkRestore(array $ids): void
    {
        Career::onlyTrashed()->whereIn('id', $ids)->restore();
    }

    public function getAnalytics(): array
    {
        return [
            'total'        => Career::count(),
            'active'       => Career::active()->count(),
            'draft'        => Career::where('status', false)->count(),
            'featured'     => Career::featured()->count(),
            'urgent'       => Career::urgent()->count(),
            'expired'      => Career::active()->expired()->count(),
            'total_views'  => Career::sum('views_count'),
        ];
    }
}
