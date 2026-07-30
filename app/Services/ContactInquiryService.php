<?php

namespace App\Services;

use App\Repositories\ContactInquiryRepository;

class ContactInquiryService
{
    protected $inquiryRepository;

    public function __construct(ContactInquiryRepository $inquiryRepository)
    {
        $this->inquiryRepository = $inquiryRepository;
    }

    public function getPaginatedInquiries($perPage = 10, $filters = [])
    {
        return $this->inquiryRepository->getPaginated($perPage, $filters);
    }

    public function getInquiryById($id)
    {
        return $this->inquiryRepository->findById($id);
    }

    public function createInquiry(array $data)
    {
        // Add any specific formatting or logic before creating
        return $this->inquiryRepository->create($data);
    }

    public function updateInquiryStatus($id, $status)
    {
        return $this->inquiryRepository->updateStatus($id, $status);
    }

    public function deleteInquiry($id)
    {
        return $this->inquiryRepository->delete($id);
    }

    public function restoreInquiry($id)
    {
        return $this->inquiryRepository->restore($id);
    }
}
