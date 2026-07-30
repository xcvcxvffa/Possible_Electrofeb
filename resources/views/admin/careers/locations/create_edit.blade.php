@extends('admin.layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">
                {{ isset($location) ? 'Edit Job Location' : 'Add Job Location' }}
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <form action="{{ isset($location) ? route('admin.job-locations.update', $location->id) : route('admin.job-locations.store') }}" method="POST">
                        @csrf
                        @if(isset($location))
                            @method('PUT')
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" class="form-control" style="border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('city', $location->city ?? '') }}" required>
                                @error('city') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">State / Region</label>
                                <input type="text" name="state" class="form-control" style="border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('state', $location->state ?? '') }}">
                                @error('state') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Country</label>
                                <input type="text" name="country" class="form-control" style="border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('country', $location->country ?? 'India') }}">
                                @error('country') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Office Name (Optional)</label>
                                <input type="text" name="office_name" class="form-control" style="border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('office_name', $location->office_name ?? '') }}">
                                @error('office_name') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Full Address</label>
                            <textarea name="address" class="form-control" rows="3" style="border-radius: 8px; padding: 10px 15px;">{{ old('address', $location->address ?? '') }}</textarea>
                            @error('address') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" 
                                    {{ old('status', $location->status ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="statusSwitch">Active Status</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 border-top pt-4">
                            <a href="{{ route('admin.job-locations.index') }}" class="btn btn-light" style="border-radius: 8px; padding: 10px 20px;">Cancel</a>
                            <button type="submit" class="btn btn-primary" style="background: var(--ins-primary); border: none; border-radius: 8px; padding: 10px 20px;">
                                {{ isset($location) ? 'Update Location' : 'Save Location' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
