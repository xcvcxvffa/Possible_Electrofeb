@extends('admin.layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">
                {{ isset($department) ? 'Edit Department' : 'Add Department' }}
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <form action="{{ isset($department) ? route('admin.departments.update', $department->id) : route('admin.departments.store') }}" method="POST">
                        @csrf
                        @if(isset($department))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label class="form-label fw-medium">Department Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" style="border-radius: 8px; padding: 10px 15px;" 
                                value="{{ old('name', $department->name ?? '') }}" required>
                            @error('name') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Description</label>
                            <textarea name="description" class="form-control" rows="3" style="border-radius: 8px; padding: 10px 15px;">{{ old('description', $department->description ?? '') }}</textarea>
                            @error('description') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control" style="border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('sort_order', $department->sort_order ?? 0) }}" min="0">
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" 
                                        {{ old('status', $department->status ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="statusSwitch">Active Status</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 border-top pt-4">
                            <a href="{{ route('admin.departments.index') }}" class="btn btn-light" style="border-radius: 8px; padding: 10px 20px;">Cancel</a>
                            <button type="submit" class="btn btn-primary" style="background: var(--ins-primary); border: none; border-radius: 8px; padding: 10px 20px;">
                                {{ isset($department) ? 'Update Department' : 'Save Department' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
