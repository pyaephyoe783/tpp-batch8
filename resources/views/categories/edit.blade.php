@extends('layouts.master')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Edit</title>
           <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

        {{-- <h1>Category Edit</h1>
        <form action="{{ route('categories.update', [$category->id]) }}" method="POST">
            @csrf
            <input type="text" name="name" value="{{ $category->name }}"/>
            <button type="submit">
                Update
            </button>
            <a href="{{route('categories.index')}}">Back</a>
        </form> --}}

        <div class="container mt-5 border border-3 p-5 mx-auto flex justify-center" style="width:500px">
            <h1 class="mb-4">Category Edit</h1>

<form action="{{ route('categories.update', [$category->id]) }}" method="POST" class="w-50">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label mb-4">Category Name</label>
        <input type="text" name="name" id="name" class="form-control shadow-none mb-4"  value="{{ $category->name }}">
    </div>

    <div>
        <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </div>
</form>
        </div>


     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>


@endsection
