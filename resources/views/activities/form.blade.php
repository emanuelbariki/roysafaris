@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ isset($activity) ? 'Edit Activity' : 'Create Activity' }}</h5>
                </div>

                <div class="card-body">
                    <form action="{{ isset($activity) ? route('activities.update', $activity) : route('activities.store') }}"
                          method="POST">
                        @csrf
                        @if (isset($activity))
                            @method('PUT')
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="activity_code" class="form-label">Activity Code</label>
                                <input type="text" class="form-control" id="activity_code" name="activity_code"
                                       value="{{ old('activity_code', $activity->activity_code ?? '') }}" required>
                                @error('activity_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="form-label">Activity Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name', $activity->name ?? '') }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                          required>{{ old('description', $activity->description ?? '') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                       value="{{ old('price', $activity->price ?? '') }}" required>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                       value="{{ old('location', $activity->location ?? '') }}" required>
                                @error('location')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                       value="{{ old('start_date', $activity->start_date ?? '') }}" required>
                                @error('start_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                       value="{{ old('end_date', $activity->end_date ?? '') }}" required>
                                @error('end_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mt-4">

                            <div class="col-sm-12 text-right">
                                        <button class="btn btn-primary px-4" type="submit">
                                            {{ isset($activity) ? 'Update Activity' : 'Create Activity' }}
                                        </button>
                                    </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
