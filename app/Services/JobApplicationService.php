<?php

namespace App\Services;

use App\Repositories\JobApplicationRepository;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;

class JobApplicationService
{
    protected $repository;

    public function __construct(JobApplicationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createApplication(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Basic duplicate check (same email + same career in last 30 days)
            $isDuplicate = JobApplication::where('email', $data['email'])
                ->where('career_id', $data['career_id'])
                ->where('created_at', '>=', now()->subDays(30))
                ->exists();

            $data['duplicate_flag'] = $isDuplicate;
            $data['application_status'] = JobApplication::STATUS_APPLIED;
            
            $app = $this->repository->create($data);
            
            // Log initial status
            $app->statusHistory()->create([
                'to_status' => JobApplication::STATUS_APPLIED,
                'note' => 'Application submitted automatically via frontend.',
            ]);

            // Send email to candidate
            try {
                \Illuminate\Support\Facades\Mail::to($app->email)->send(new \App\Mail\ApplicationReceivedMail($app));
            } catch (\Exception $e) {
                // Log email failure but don't fail transaction
                \Illuminate\Support\Facades\Log::error('Failed to send application received email: ' . $e->getMessage());
            }

            return $app;
        });
    }

    public function updateStatus($id, $newStatus, $note = null)
    {
        return DB::transaction(function () use ($id, $newStatus, $note) {
            $app = $this->repository->getById($id);
            $oldStatus = $app->application_status;

            if ($oldStatus !== $newStatus) {
                $app->update(['application_status' => $newStatus]);
                
                $app->statusHistory()->create([
                    'from_status' => $oldStatus,
                    'to_status' => $newStatus,
                    'note' => $note,
                    'changed_by' => auth()->id(),
                ]);

                // Dispatch Event for status change emails
                try {
                    if ($newStatus == JobApplication::STATUS_SELECTED) {
                        \Illuminate\Support\Facades\Mail::to($app->email)->send(new \App\Mail\ApplicationSelectedMail($app));
                    } elseif ($newStatus == JobApplication::STATUS_REJECTED) {
                        \Illuminate\Support\Facades\Mail::to($app->email)->send(new \App\Mail\ApplicationRejectedMail($app));
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send status update email: ' . $e->getMessage());
                }
            }

            return $app;
        });
    }

    public function addHrNote($id, $note)
    {
        $app = $this->repository->getById($id);
        return $app->hrNotes()->create([
            'note' => $note,
            'created_by' => auth()->id(),
        ]);
    }

    public function scheduleInterview($id, array $data)
    {
        $app = $this->repository->getById($id);
        $data['created_by'] = auth()->id();
        $interview = $app->interviews()->create($data);
        
        try {
            \Illuminate\Support\Facades\Mail::to($app->email)->send(new \App\Mail\InterviewInviteMail($app, $interview));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send interview email: ' . $e->getMessage());
        }
        
        return $interview;
    }
}
