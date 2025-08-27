@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Permission</h1>

        <div class="card">
            <div class="card-header">
                <h4>Edit Permission: {{ $permission->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Permission Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $permission->name }}" required>
                    </div>


                    <div class="mb-2">
                        <label for="role" class="form-label">Roles: </label>
                        @foreach ($assignRoles as $roleName)
                            <span
                                class="badge rounded-pill bg-light text-primary border border-primary px-3 py-1 shadow-sm">
                                {{ $roleName }}
                            </span>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">Update Permission</button>
                    <a href="{{ route('permission.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>

        </div>
    </div>
@endsection
