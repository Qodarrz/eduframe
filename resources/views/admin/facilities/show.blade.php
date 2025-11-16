@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Facility Details</h4>
                    <div>
                        <a href="{{ route('facilities.edit', $facility->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('facilities.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            @if($facility->image)
                                <img src="{{ $facility->image }}" 
                                     alt="{{ $facility->name }}" 
                                     class="img-fluid rounded">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                     style="height: 200px; width: 100%;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h2>{{ $facility->name }}</h2>
                            <p class="mb-2">
                                <strong>Status:</strong> 
                                <span class="badge {{ $facility->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($facility->status) }}
                                </span>
                            </p>
                            <p class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i>
                                Created: {{ $facility->created_at->format('M d, Y') }}
                            </p>
                            <p class="text-muted">
                                <i class="far fa-edit me-1"></i>
                                Last Updated: {{ $facility->updated_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Description</h5>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($facility->description ?: 'No description provided.')) !!}
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <form action="{{ route('facilities.destroy', $facility->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this facility? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete Facility
                                </button>
                            </form>
                        </div>
                        <a href="{{ route('facilities.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list"></i> View All Facilities
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
