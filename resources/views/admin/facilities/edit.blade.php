@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Facility: {{ $facility->name }}</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Facility Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $facility->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                     id="description" name="description" rows="3">{{ old('description', $facility->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Facility Image</label>
                            @if($facility->image)
                                <div class="mb-2">
                                    <img src="{{ $facility->image }}" 
                                         alt="{{ $facility->name }}" 
                                         class="img-thumbnail" 
                                         style="max-height: 150px;">
                                    <div class="form-text">Current image</div>
                                </div>
                            @endif
                            <input class="form-control @error('image') is-invalid @enderror" 
                                   type="file" id="image" name="image" accept="image/*">
                            <div class="form-text">Leave empty to keep current image. Max file size: 2MB. Allowed formats: jpeg, png, jpg, gif</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="status_active" value="active" 
                                       {{ old('status', $facility->status) === 'active' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="status_active">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="status_inactive" value="inactive"
                                       {{ old('status', $facility->status) === 'inactive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_inactive">
                                    Inactive
                                </label>
                            </div>
                            @error('status')
                                <div class="text-danger" style="font-size: .875em">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('facilities.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Facility
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
