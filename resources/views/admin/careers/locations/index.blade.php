@extends('admin.layouts.app')

@section('content')
<style>
    .custom-table-wrapper {
        background: var(--ins-secondary-bg, #ffffff);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        padding: 24px;
        font-family: 'Inter', sans-serif;
    }
    .btn-new {
        background: var(--ins-primary);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        transition: background 0.2s;
    }
    .btn-new:hover { filter: brightness(0.9); color: white; }
</style>

<div class="container-fluid pt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">Job Locations</h4>
        </div>
        <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
            <a href="{{ route('admin.job-locations.create') }}" class="btn-new">
                <i class="fa-regular fa-plus me-1"></i> Add Location
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="custom-table-wrapper">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="locations-table">
                <thead class="bg-light">
                    <tr>
                        <th>City</th>
                        <th>State / Region</th>
                        <th>Country</th>
                        <th>Office Name</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locations as $location)
                        <tr>
                            <td><strong style="color: var(--ins-heading-color);">{{ $location->city }}</strong></td>
                            <td>{{ $location->state }}</td>
                            <td>{{ $location->country }}</td>
                            <td><span class="text-muted">{{ $location->office_name ?? '-' }}</span></td>
                            <td>
                                @if($location->status)
                                    <span class="badge bg-success" style="padding: 6px 12px; border-radius: 20px;">Active</span>
                                @else
                                    <span class="badge bg-danger" style="padding: 6px 12px; border-radius: 20px;">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.job-locations.edit', $location->id) }}" class="btn btn-sm btn-soft-primary me-2" style="border-radius: 6px; padding: 6px 12px;">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-soft-danger" style="border-radius: 6px; padding: 6px 12px;" 
                                    onclick="showConfirm('Are you sure you want to delete this location?', function() { document.getElementById('delete-form-{{ $location->id }}').submit(); })">
                                    <i class="fa-regular fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $location->id }}" action="{{ route('admin.job-locations.destroy', $location->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No locations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
