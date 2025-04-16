@php $lodge = $lodge ?? new \App\Models\Lodge(); @endphp

<div class="container py-4">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-white">
            <h5 class="mb-0">Lodge Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($lodge->id) ? route('lodges.update', $lodge) : route('lodges.store') }}" method="POST">
                @csrf
                @isset($lodge->id)
                    @method('PUT')
                @endisset

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $lodge->name) }}" class="form-control" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $lodge->location) }}" class="form-control" required>
                    @error('location') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $lodge->phone) }}" class="form-control" required>
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $lodge->email) }}" class="form-control" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $lodge->description) }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('lodges.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </form>
        </div>
    </div>
</div>
