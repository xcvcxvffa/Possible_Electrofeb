<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Services\ContactInquiryService;
use App\Http\Requests\UpdateContactInquiryStatusRequest;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    protected $inquiryService;

    public function __construct(ContactInquiryService $inquiryService)
    {
        $this->inquiryService = $inquiryService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status', 'trashed']);
        $inquiries = $this->inquiryService->getPaginatedInquiries(15, $filters);
        
        $statuses = [
            'New' => 'New',
            'Contacted' => 'Contacted',
            'Closed' => 'Closed',
        ];

        return view('admin.contact-inquiries.index', compact('inquiries', 'statuses'));
    }

    public function show($id)
    {
        $inquiry = $this->inquiryService->getInquiryById($id);
        return view('admin.contact-inquiries.show', compact('inquiry'));
    }

    public function updateStatus(UpdateContactInquiryStatusRequest $request, $id)
    {
        $this->inquiryService->updateInquiryStatus($id, $request->status);
        return redirect()->route('admin.contact-inquiries.show', $id)
            ->with('success', 'Inquiry status updated successfully.');
    }

    public function destroy($id)
    {
        $this->inquiryService->deleteInquiry($id);
        return redirect()->route('admin.contact-inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }

    public function restore($id)
    {
        $this->inquiryService->restoreInquiry($id);
        return redirect()->route('admin.contact-inquiries.index', ['trashed' => 'with'])
            ->with('success', 'Inquiry restored successfully.');
    }
}
