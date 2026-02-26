@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Role</h1>

    <div class="card">
        <div class="card-header">
            <h4>Edit Role: {{ $role->name }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

        
                <div class="mb-3">
                    <label for="name" class="form-label">Role Name</label>
                    <input type="text" name="name" id="name"
                           class="form-control"
                           value="{{ $role->name }}" required>
                </div>


                <div class="mb-3">
                    <label class="form-label">Assign Permissions</label>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           name="permissions[]"
                                           value="{{ $permission->id }}"
                                           id="perm{{ $permission->id }}"
                                           {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Role</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
