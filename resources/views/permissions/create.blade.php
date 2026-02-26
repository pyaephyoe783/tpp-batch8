@extends('layouts.master')
@section('content')
<div class="container">
     <div class="card mt-5">
        <div class="card-header">
            <h4>Create New Permission</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('permission.store'), }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Permission Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter permission name" required>
                </div>
                <button type="submit" class="btn btn-success">Create Permission</button>
            </form>
        </div>
</div>
</div>

@endsection
