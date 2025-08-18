<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container border border-primary p-5 w-[200px]" >
        <h1 class="mb-3">Category List</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary mb-5">+Create</a>
        {{-- @foreach ($categories as $data)
            <p>{{ $data['id'] }} : {{ $data['name'] }}</p>
            <a href="{{ route('categories.edit', ['id' => $data->id]) }}">edit</a>
            <form action="{{ route('categories.delete', ['id' => $data->id]) }}" method="POST">
                @csrf
                <button type="submit">Delete</button>
            </form>
        @endforeach --}}

            <table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->name }}</td>
            <td>
                <a href="{{ route('categories.edit', ['id' => $data->id]) }}" class="btn btn-sm btn-primary">Edit</a>

                <form action="{{ route('categories.delete', ['id' => $data->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
