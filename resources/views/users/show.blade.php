<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>{{ $user->name }}</h3>
                    </div>
                    <div class="card-body text-center">
                        @if($user->image)
                            <img src="{{ asset('UsersImage/' . $user->image) }}" alt="{{ $user->name }}" class="rounded-circle mb-3" style="width:120px; height:120px; object-fit:cover;">
                        @else
                            <div class="rounded-circle bg-secondary mb-3 d-flex align-items-center justify-content-center" style="width:120px; height:120px; color:white; font-size:24px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif

                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                            <li class="list-group-item"><strong>Address:</strong> {{ $user->address }}</li>
                            <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone }}</li>
                            <li class="list-group-item"><strong>Gender:</strong> {{ ucfirst($user->gender) }}</li>
                            <li class="list-group-item">
                                <strong>Status:</strong>
                                @if($user->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Suspend</span>
                                @endif
                            </li>
                        </ul>

                        <div class="mt-3">
                            <a href="{{ route('users.index',) }}" class="btn btn-outline-primary">Back to Users</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
