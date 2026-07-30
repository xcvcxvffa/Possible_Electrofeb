@extends('admin.layouts.app')

@section('content')
<style>
    .card-custom { border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 24px; background: #fff; }
    .card-header-custom { padding: 20px 24px; border-bottom: 1px solid #f1f5f9; background: #fff; border-radius: 12px 12px 0 0; }
    .card-title-custom { font-size: 16px; font-weight: 600; color: var(--ins-heading-color); margin: 0; }
    .card-body-custom { padding: 24px; }
    
    .info-label { font-size: 12px; color: #6c757d; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .info-value { font-size: 15px; color: #333; font-weight: 500; margin-bottom: 20px; word-break: break-word; }
    
    .timeline { position: relative; padding-left: 30px; margin-top: 20px; }
    .timeline::before { content: ''; position: absolute; left: 11px; top: 0; bottom: 0; width: 2px; background: #e2e8f0; }
    .timeline-item { position: relative; margin-bottom: 20px; }
    .timeline-item::before {
        content: ''; position: absolute; left: -24px; top: 4px; width: 10px; height: 10px;
        border-radius: 50%; background: var(--ins-primary); border: 2px solid #fff; box-shadow: 0 0 0 2px var(--ins-primary);
    }
    .timeline-date { font-size: 12px; color: #6c757d; margin-bottom: 4px; }
    .timeline-content { background: #f8fafc; padding: 12px 16px; border-radius: 8px; border: 1px solid #e2e8f0; }
</style>

<div class="container-fluid pb-5 pt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">Application Details</h4>
        </div>
        <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
            <a href="{{ route('admin.job-applications.index') }}" class="btn btn-light" style="border-radius: 8px;">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Left Column: Details -->
        <div class="col-lg-8">
            <div class="card-custom">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <h5 class="card-title-custom">Candidate Profile</h5>
                    <span class="badge" style="background-color: {{ $application->status_color }}20; color: {{ $application->status_color }}; padding: 6px 12px; border-radius: 20px;">
                        {{ $application->status_label }}
                    </span>
                </div>
                <div class="card-body-custom">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Full Name</div>
                            <div class="info-value">{{ $application->full_name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Applied For Job</div>
                            <div class="info-value">
                                <a href="{{ route('admin.careers.edit', $application->career_id) }}" target="_blank" class="text-decoration-none">
                                    {{ $application->career->title }} <i class="fa-solid fa-arrow-up-right-from-square ms-1 small"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Email Address</div>
                            <div class="info-value"><a href="mailto:{{ $application->email }}">{{ $application->email }}</a></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Phone Number</div>
                            <div class="info-value"><a href="tel:{{ $application->phone }}">{{ $application->phone }}</a></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Location</div>
                            <div class="info-value">{{ $application->city ?? '-' }}, {{ $application->country ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Applied On</div>
                            <div class="info-value">{{ $application->applied_at->format('d M, Y h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Details (if we expand form in future) -->
            @if($application->cover_letter || $application->linkedin_url || $application->portfolio_url)
                <div class="card-custom">
                    <div class="card-header-custom"><h5 class="card-title-custom">Professional Details</h5></div>
                    <div class="card-body-custom">
                        <div class="row">
                            @if($application->linkedin_url)
                                <div class="col-md-6">
                                    <div class="info-label">LinkedIn Profile</div>
                                    <div class="info-value"><a href="{{ $application->linkedin_url }}" target="_blank">{{ $application->linkedin_url }}</a></div>
                                </div>
                            @endif
                            @if($application->portfolio_url)
                                <div class="col-md-6">
                                    <div class="info-label">Portfolio URL</div>
                                    <div class="info-value"><a href="{{ $application->portfolio_url }}" target="_blank">{{ $application->portfolio_url }}</a></div>
                                </div>
                            @endif
                            @if($application->experience)
                                <div class="col-md-6">
                                    <div class="info-label">Total Experience</div>
                                    <div class="info-value">{{ $application->experience }}</div>
                                </div>
                            @endif
                            @if($application->current_company)
                                <div class="col-md-6">
                                    <div class="info-label">Current Company</div>
                                    <div class="info-value">{{ $application->current_company }}</div>
                                </div>
                            @endif
                        </div>
                        @if($application->cover_letter)
                            <div class="mt-3">
                                <div class="info-label">Cover Letter / Message</div>
                                <div class="p-3 bg-light rounded" style="font-size: 14px; white-space: pre-wrap;">{{ $application->cover_letter }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Internal HR Notes -->
            <div class="card-custom">
                <div class="card-header-custom"><h5 class="card-title-custom">HR Internal Notes</h5></div>
                <div class="card-body-custom">
                    <form action="{{ route('admin.job-applications.add_note', $application->id) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="form-group mb-2">
                            <textarea name="note" class="form-control" rows="2" placeholder="Add a note about this candidate..." required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-sm btn-primary">Add Note</button>
                        </div>
                    </form>

                    <div class="timeline mt-0">
                        @forelse($application->hrNotes as $note)
                            <div class="timeline-item">
                                <div class="timeline-date">{{ $note->created_at->format('d M, Y h:i A') }} &bull; <strong>{{ $note->creator?->name ?? 'Admin' }}</strong></div>
                                <div class="timeline-content">{{ $note->note }}</div>
                            </div>
                        @empty
                            <p class="text-muted small">No internal notes added yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Actions & Status -->
        <div class="col-lg-4">
            
            <!-- Resume Action -->
            <div class="card-custom">
                <div class="card-body-custom text-center">
                    @if($application->resumeMedia)
                        <i class="fa-regular fa-file-pdf fa-3x text-danger mb-3"></i>
                        <h6 class="mb-3">Resume Document</h6>
                        <a href="{{ $application->resumeMedia->url }}" target="_blank" class="btn btn-primary w-100" style="border-radius: 8px;">
                            <i class="fa-regular fa-eye me-2"></i> View Resume
                        </a>
                        <a href="{{ $application->resumeMedia->url }}" download class="btn btn-light w-100 mt-2" style="border-radius: 8px;">
                            <i class="fa-solid fa-download me-2"></i> Download
                        </a>
                    @else
                        <div class="text-muted py-4">
                            <i class="fa-regular fa-file-excel fa-2x mb-2"></i>
                            <p class="mb-0">No Resume Attached</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Status Update -->
            <div class="card-custom">
                <div class="card-header-custom"><h5 class="card-title-custom">Update Status</h5></div>
                <div class="card-body-custom">
                    <form action="{{ route('admin.job-applications.update_status', $application->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-medium small text-muted">Change Stage To:</label>
                            <select name="application_status" class="form-select">
                                @foreach($statuses as $key => $label)
                                    <option value="{{ $key }}" {{ $application->application_status == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium small text-muted">Note / Reason (Optional)</label>
                            <textarea name="note" class="form-control" rows="2" placeholder="Why are you changing status?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="border-radius: 8px;">Update Status</button>
                    </form>
                </div>
            </div>

            <!-- Status History Timeline -->
            <div class="card-custom">
                <div class="card-header-custom"><h5 class="card-title-custom">Application Timeline</h5></div>
                <div class="card-body-custom">
                    <div class="timeline mt-0">
                        @foreach($application->statusHistory as $history)
                            <div class="timeline-item">
                                <div class="timeline-date">{{ $history->changed_at->format('d M, Y h:i A') }}</div>
                                <div class="timeline-content" style="padding: 8px 12px;">
                                    <strong>{{ \App\Models\JobApplication::STATUSES[$history->to_status] ?? $history->to_status }}</strong>
                                    @if($history->note)
                                        <div class="small text-muted mt-1">{{ $history->note }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
