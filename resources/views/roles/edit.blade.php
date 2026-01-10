@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('roles.update', $role) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Role Name</label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control"
                                       value="{{ old('name', $role->name) }}"
                                       placeholder="e.g., Admin"
                                       required>
                                @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label d-block">Quick Actions</label>
                                <button type="button" class="btn btn-sm btn-primary me-2"
                                        onclick="selectAllPermissions()">
                                    Select All Permissions
                                </button>
                                <button type="button" class="btn btn-sm btn-secondary"
                                        onclick="clearAllPermissions()">
                                    Clear All Permissions
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description"
                                      id="description"
                                      class="form-control"
                                      rows="2"
                                      placeholder="Optional description">{{ old('description', $role->description) }}</textarea>
                            @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr/>

                        <h4>Permissions</h4>
                        <p class="text-muted">Select permissions for this role. You can select individual permissions or
                            entire modules.</p>

                        @foreach($modules as $module)
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">
                                        <i class="fas fa-folder"></i>
                                        {{ Str::title(str_replace('_', ' ', $module->slug)) }}
                                    </h5>
                                    <button type="button"
                                            class="btn btn-sm btn-primary"
                                            onclick="toggleModule({{ $module->id }})">
                                        Select {{ Str::title(str_replace('_', ' ', $module->slug)) }} Module
                                    </button>
                                </div>
                                <div class="card-body">
                                    @if($module->permissions->count() > 0)
                                        <div class="row">
                                            @foreach($module->permissions->sortBy('ability') as $permission)
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check">
                                                        <input type="checkbox"
                                                               name="permissions[]"
                                                               value="{{ $permission->id }}"
                                                               id="permission_{{ $permission->id }}"
                                                               class="form-check-input module-{{ $module->id }}"
                                                            {{ in_array($permission->id, $rolePermissionIds) ? 'checked' : '' }}
                                                            {{ old('permissions') && in_array($permission->id, old('permissions')) ? 'checked' : '' }}>
                                                        <label for="permission_{{ $permission->id }}"
                                                               class="form-check-label">
                                                            <strong>{{ $permission->ability }}</strong>
                                                            <small
                                                                class="text-muted d-block">{{ $permission->description ?? '' }}</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">No permissions in this module.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @if($modules->count() === 0)
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                No permissions available. Please create permissions first.
                                <a href="{{ route('permissions.create') }}" class="alert-link">Create Permissions</a>
                            </div>
                        @endif

                        <div class="d-flex justify-content-end mt-4">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    Update Role
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function selectAllPermissions() {
            document.querySelectorAll('input[name="permissions[]"]').forEach(function (checkbox) {
                checkbox.checked = true;
            });
        }

        function clearAllPermissions() {
            document.querySelectorAll('input[name="permissions[]"]').forEach(function (checkbox) {
                checkbox.checked = false;
            });
        }

        function toggleModule(moduleId) {
            const checkboxes = document.querySelectorAll('.module-' + moduleId);
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);

            checkboxes.forEach(function (checkbox) {
                checkbox.checked = !allChecked;
            });
        }
    </script>
@endpush
