@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Permissions List</h1>

        <a href="{{ route('permission.create') }}" class="btn btn-primary btn-sm">+Create</a>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Permission Name</th>
                    {{-- <th>Role Access</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        {{-- <td>
                            @if ($permission->roles)
                                @foreach ($permission->roles as $role)
                                    <span class="badge bg-secondary">{{ $role->name }}</span>
                                @endforeach

                            @endif
                        </td> --}}
                        <td>
                            <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-sm btn-primary">Edit</a>

                            <form action="{{ route('permission.destroy', $permission->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
