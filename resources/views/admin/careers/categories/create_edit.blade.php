@extends('admin.layouts.app')

@section('content')
<div class="container-fluid pt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0" style="font-size: 20px; font-weight: 600; color: var(--ins-heading-color);">
                {{ isset($category) ? 'Edit Career Category' : 'Add Career Category' }}
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="card-body p-4">
                    <form action="{{ isset($category) ? route('admin.career-categories.update', $category->id) : route('admin.career-categories.store') }}" method="POST">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" style="border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('name', $category->name ?? '') }}" required>
                                @error('name') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Parent Category</label>
                                <select name="parent_id" class="form-select" style="border-radius: 8px; padding: 10px 15px;">
                                    <option value="">None (Root Category)</option>
                                    @foreach($categories as $cat)
                                        @if(!isset($category) || $cat->id !== $category->id)
                                            <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id ?? '') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('parent_id') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Description</label>
                            <textarea name="description" class="form-control" rows="3" style="border-radius: 8px; padding: 10px 15px;">{{ old('description', $category->description ?? '') }}</textarea>
                            @error('description') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Icon (Media Library)</label>
                                <!-- Using existing media picker logic - we'll implement a simple text input for ID for now, 
                                     assuming the admin panel uses a global media picker JS that populates this field -->
                                <div class="input-group">
                                    <input type="text" name="icon_media_id" class="form-control" placeholder="Media ID" value="{{ old('icon_media_id', $category->icon_media_id ?? '') }}">
                                    <button class="btn btn-outline-secondary" type="button" onclick="alert('Media picker to be integrated')">Select Media</button>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" 
                                        {{ old('status', $category->status ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="statusSwitch">Active Status</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 border-top pt-4">
                            <a href="{{ route('admin.career-categories.index') }}" class="btn btn-light" style="border-radius: 8px; padding: 10px 20px;">Cancel</a>
                            <button type="submit" class="btn btn-primary" style="background: var(--ins-primary); border: none; border-radius: 8px; padding: 10px 20px;">
                                {{ isset($category) ? 'Update Category' : 'Save Category' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
