<?php

namespace App\Repositories;

use App\Models\ContactInquiry;

class ContactInquiryRepository
{
    public function getPaginated($perPage = 10, $filters = [])
    {
        $query = ContactInquiry::query()->with('product');

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Handle soft deletes filter
        if (isset($filters['trashed']) && $filters['trashed'] == 'only') {
            $query->onlyTrashed();
        } elseif (isset($filters['trashed']) && $filters['trashed'] == 'with') {
            $query->withTrashed();
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById($id)
    {
        return ContactInquiry::withTrashed()->with('product')->findOrFail($id);
    }

    public function create(array $data)
    {
        return ContactInquiry::create($data);
    }

    public function updateStatus($id, $status)
    {
        $inquiry = $this->findById($id);
        $inquiry->status = $status;
        $inquiry->save();
        return $inquiry;
    }

    public function delete($id)
    {
        $inquiry = $this->findById($id);
        return $inquiry->delete();
    }

    public function restore($id)
    {
        $inquiry = ContactInquiry::onlyTrashed()->findOrFail($id);
        return $inquiry->restore();
    }
}
