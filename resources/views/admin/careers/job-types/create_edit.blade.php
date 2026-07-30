@extends('admin.layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">
                {{ isset($jobType) ? 'Edit Job Type' : 'Add Job Type' }}
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card" style="border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <form action="{{ isset($jobType) ? route('admin.job-types.update', $jobType->id) : route('admin.job-types.store') }}" method="POST">
                        @csrf
                        @if(isset($jobType))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label class="form-label fw-medium">Job Type Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" style="border-radius: 8px; padding: 10px 15px;" 
                                value="{{ old('name', $jobType->name ?? '') }}" required placeholder="e.g. Full Time, Part Time">
                            @error('name') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Badge Color <span class="text-danger">*</span></label>
                            <input type="color" name="color" class="form-control form-control-color" style="border-radius: 8px; width: 100%; height: 50px;" 
                                value="{{ old('color', $jobType->color ?? '#3b82f6') }}" required>
                            @error('color') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" 
                                    {{ old('status', $jobType->status ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="statusSwitch">Active Status</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 border-top pt-4">
                            <a href="{{ route('admin.job-types.index') }}" class="btn btn-light" style="border-radius: 8px; padding: 10px 20px;">Cancel</a>
                            <button type="submit" class="btn btn-primary" style="background: var(--ins-primary); border: none; border-radius: 8px; padding: 10px 20px;">
                                {{ isset($jobType) ? 'Update Job Type' : 'Save Job Type' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
