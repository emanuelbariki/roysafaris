<form action="{{ isset($role) ? route('roles.update', $role) : route('roles.store') }}" method="POST">
        @csrf
        @if(isset($role)) @method('PUT') @endif

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $role->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Permissions</label>
            @foreach($permissions as $perm)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="permissions[]"
                           value="{{ $perm->name }}"
                           {{ isset($role) && $role->permissions->contains($perm) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $perm->name }}</label>
                </div>
            @endforeach
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>