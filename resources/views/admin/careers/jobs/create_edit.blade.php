@extends('admin.layouts.app')

@section('content')
<style>
    .section-card { background: #fff; border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 24px; }
    .section-header { padding: 20px 24px; border-bottom: 1px solid #f1f5f9; }
    .section-title { font-size: 16px; font-weight: 600; color: var(--ins-heading-color); margin: 0; }
    .section-body { padding: 24px; }
    
    .form-label { font-weight: 500; font-size: 13px; color: #475569; }
    .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border-color: #e2e8f0; }
    .form-control:focus, .form-select:focus { border-color: var(--ins-primary); box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1); }
    
    .dynamic-list-item { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; margin-bottom: 12px; display: flex; align-items: center; gap: 12px; }
    .dynamic-list-item .form-control { flex-grow: 1; margin-bottom: 0; }
    .btn-remove-item { background: #fee2e2; color: #ef4444; border: none; border-radius: 6px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; }
</style>

<div class="container-fluid pb-5 pt-4">
    <div class="row mb-4">
        <div class="col-12 d-flex align-items-center">
            <a href="{{ route('admin.careers.index') }}" class="btn btn-light me-3" style="border-radius: 8px;"><i class="fa-solid fa-arrow-left me-2"></i>Back to Jobs</a>
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">
                {{ isset($career) ? 'Edit Job: ' . $career->title : 'Post New Job' }}
            </h4>
        </div>
    </div>

    <form action="{{ isset($career) ? route('admin.careers.update', $career->id) : route('admin.careers.store') }}" method="POST" id="career-form">
        @csrf
        @if(isset($career))
            @method('PUT')
        @endif

        <div class="row mt-3">
            <!-- Left Column (Main Info) -->
            <div class="col-lg-8">
                
                <!-- Basic Info -->
                <div class="section-card">
                    <div class="section-header"><h5 class="section-title">Basic Information</h5></div>
                    <div class="section-body">
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <label class="form-label">Job Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" required value="{{ old('title', $career->title ?? '') }}" placeholder="e.g. Senior Software Engineer">
                                @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Job Code</label>
                                <input type="text" name="job_code" class="form-control" value="{{ old('job_code', $career->job_code ?? '') }}" placeholder="e.g. ENG-2026">
                                @error('job_code') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" class="form-control" rows="2" placeholder="Brief summary for job cards...">{{ old('short_description', $career->short_description ?? '') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Main Content <span class="text-danger">*</span></label>
                            <x-admin.editor name="description" :value="$career->description ?? ''" id="jobContentEditor" placeholder="Write full job description content..." />
                            @error('description') <div class="invalid-feedback d-block mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Job Details -->
                <div class="section-card">
                    <div class="section-header"><h5 class="section-title">Job Details</h5></div>
                    <div class="section-body">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label class="form-label">Salary Type</label>
                                <select name="salary_type" class="form-select" id="salaryTypeSelect" onchange="toggleSalaryFields()">
                                    <option value="fixed" {{ old('salary_type', $career->salary_type ?? '') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    <option value="range" {{ old('salary_type', $career->salary_type ?? '') == 'range' ? 'selected' : '' }}>Range</option>
                                    <option value="negotiable" {{ old('salary_type', $career->salary_type ?? '') == 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                                    <option value="not_disclosed" {{ old('salary_type', $career->salary_type ?? '') == 'not_disclosed' ? 'selected' : '' }}>Not Disclosed</option>
                                </select>
                            </div>
                            <div class="col-md-3 salary-field">
                                <label class="form-label">Currency</label>
                                <input type="text" name="currency" class="form-control" value="{{ old('currency', $career->currency ?? '₹') }}" placeholder="₹ or USD">
                            </div>
                            <div class="col-md-3 salary-field min-salary-field">
                                <label class="form-label" id="salaryMinLabel">Amount (LPA)</label>
                                <input type="number" step="0.01" name="salary_min" class="form-control" value="{{ old('salary_min', $career->salary_min ?? '') }}">
                            </div>
                            <div class="col-md-3 salary-field max-salary-field">
                                <label class="form-label">Maximum (LPA)</label>
                                <input type="number" step="0.01" name="salary_max" class="form-control" value="{{ old('salary_max', $career->salary_max ?? '') }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Experience Required</label>
                                <input type="text" name="experience" class="form-control" value="{{ old('experience', $career->experience ?? '') }}" placeholder="e.g. 3-5 Years">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Education Required</label>
                                <input type="text" name="education" class="form-control" value="{{ old('education', $career->education ?? '') }}" placeholder="e.g. B.Tech / MCA">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">No. of Vacancies</label>
                                <input type="number" name="vacancies" class="form-control" value="{{ old('vacancies', $career->vacancies ?? '1') }}" min="1">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Lists (Responsibilities, Requirements, Benefits) -->
                <div class="section-card">
                    <div class="section-header"><h5 class="section-title">Requirements & Responsibilities</h5></div>
                    <div class="section-body">
                        
                        <!-- Responsibilities -->
                        <div class="mb-5">
                            <label class="form-label">Key Responsibilities</label>
                            <div id="responsibilitiesList">
                                @php
                                    $resps = old('responsibilities', isset($career) ? $career->responsibilities->pluck('item')->toArray() : ['']);
                                @endphp
                                @foreach($resps as $index => $resp)
                                    <div class="dynamic-list-item">
                                        <i class="fa-solid fa-bars text-muted" style="cursor: move;"></i>
                                        <input type="text" name="responsibilities[]" class="form-control" value="{{ $resp }}" placeholder="Enter responsibility...">
                                        <button type="button" class="btn-remove-item" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-light mt-2" onclick="addListItem('responsibilitiesList', 'responsibilities[]', 'Enter responsibility...')"><i class="fa-solid fa-plus me-1"></i> Add Responsibility</button>
                        </div>

                        <!-- Requirements -->
                        <div class="mb-5">
                            <label class="form-label">Job Requirements</label>
                            <div id="requirementsList">
                                @php
                                    $reqs = old('requirements', isset($career) ? $career->requirements->pluck('item')->toArray() : ['']);
                                @endphp
                                @foreach($reqs as $index => $req)
                                    <div class="dynamic-list-item">
                                        <i class="fa-solid fa-bars text-muted" style="cursor: move;"></i>
                                        <input type="text" name="requirements[]" class="form-control" value="{{ $req }}" placeholder="Enter requirement...">
                                        <button type="button" class="btn-remove-item" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-light mt-2" onclick="addListItem('requirementsList', 'requirements[]', 'Enter requirement...')"><i class="fa-solid fa-plus me-1"></i> Add Requirement</button>
                        </div>

                        <!-- Benefits -->
                        <div class="mb-3">
                            <label class="form-label">Perks & Benefits</label>
                            <div id="benefitsList">
                                @php
                                    $bens = old('benefits', isset($career) ? $career->benefits->pluck('item')->toArray() : ['']);
                                @endphp
                                @foreach($bens as $index => $ben)
                                    <div class="dynamic-list-item">
                                        <i class="fa-solid fa-bars text-muted" style="cursor: move;"></i>
                                        <input type="text" name="benefits[]" class="form-control" value="{{ $ben }}" placeholder="Enter perk/benefit...">
                                        <button type="button" class="btn-remove-item" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-light mt-2" onclick="addListItem('benefitsList', 'benefits[]', 'Enter perk/benefit...')"><i class="fa-solid fa-plus me-1"></i> Add Benefit</button>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Right Column (Sidebar Settings) -->
            <div class="col-lg-4">
                
                <!-- Publishing & Visibility -->
                <div class="section-card">
                    <div class="section-header"><h5 class="section-title">Publishing & Organization</h5></div>
                    <div class="section-body">
                        
                        <div class="mb-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select bg-light">
                                <option value="1" {{ old('status', $career->status ?? 1) == 1 ? 'selected' : '' }}>Published (Active)</option>
                                <option value="0" {{ old('status', $career->status ?? 1) == 0 ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>

                        <div class="mb-4 border rounded p-3 bg-light">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="featured" id="featuredSwitch" value="1" {{ old('featured', $career->featured ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="featuredSwitch">Featured Job</label>
                                <div class="text-muted small">Show prominently on careers page.</div>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="urgent" id="urgentSwitch" value="1" {{ old('urgent', $career->urgent ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium text-danger" for="urgentSwitch">Urgent Hiring</label>
                                <div class="text-muted small">Add "Urgent" badge.</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Application Deadline</label>
                            <input type="date" name="application_deadline" class="form-control" 
                                value="{{ old('application_deadline', isset($career->application_deadline) ? $career->application_deadline->format('Y-m-d') : '') }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Department</label>
                            <input type="text" name="department_name" class="form-control" placeholder="e.g. Engineering" value="{{ old('department_name', $career->department?->name ?? '') }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Job Location</label>
                            <input type="text" name="location_name" class="form-control" placeholder="e.g. Remote / New York" value="{{ old('location_name', $career->location?->city ?? '') }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Job Type</label>
                            <input type="text" name="job_type_name" class="form-control" placeholder="e.g. Full Time" value="{{ old('job_type_name', $career->jobType?->name ?? '') }}">
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Category (Optional)</label>
                            <input type="text" name="category_name" class="form-control" placeholder="e.g. Software" value="{{ old('category_name', $career->category?->name ?? '') }}">
                        </div>

                    </div>
                </div>

                <div class="section-card">
                    <div class="section-body p-4">
                        <button type="submit" class="btn w-100 py-3 mb-3" style="border-radius: 10px; font-weight: 600; font-size: 15px; background: var(--ins-primary); color: #fff; border: 1px solid var(--ins-primary); box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25); transition: all 0.2s;">
                            <i class="fa-regular fa-paper-plane me-2"></i>{{ isset($career) ? 'Save Changes' : 'Publish Job' }}
                        </button>
                        <a href="{{ route('admin.careers.index') }}" class="btn w-100 py-2" style="border-radius: 10px; background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-weight: 500; font-size: 14px; transition: all 0.2s;">
                            <i class="fa-solid fa-xmark me-2"></i>Cancel
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<!-- JS logic for salary fields and dynamic lists -->
<script>
    function toggleSalaryFields() {
        let type = document.getElementById('salaryTypeSelect').value;
        let fields = document.querySelectorAll('.salary-field');
        let maxField = document.querySelector('.max-salary-field');
        let minField = document.querySelector('.min-salary-field');
        let minLabel = document.getElementById('salaryMinLabel');
        
        if (type === 'not_disclosed' || type === 'negotiable') {
            fields.forEach(el => el.style.display = 'none');
        } else {
            fields.forEach(el => el.style.display = 'block');
            if (type === 'fixed') {
                maxField.style.display = 'none';
                minLabel.innerText = 'Amount (LPA)';
            } else if (type === 'range') {
                maxField.style.display = 'block';
                minLabel.innerText = 'Minimum (LPA)';
            }
        }
    }

    function addListItem(containerId, inputName, placeholder) {
        let container = document.getElementById(containerId);
        let div = document.createElement('div');
        div.className = 'dynamic-list-item';
        div.innerHTML = `
            <i class="fa-solid fa-bars text-muted" style="cursor: move;"></i>
            <input type="text" name="${inputName}" class="form-control" placeholder="${placeholder}">
            <button type="button" class="btn-remove-item" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></button>
        `;
        container.appendChild(div);
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleSalaryFields();
    });
</script>

@include('admin.partials.media-modal')
@endsection
