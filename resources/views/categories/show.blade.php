@extends('layouts.master')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Category Detail</h4>
                    </div>

                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $category->name }}</h5>

                        <div class="my-3">
                            <img src="{{ asset('categoriesImage/' . $category->image) }}"
                                class="img-fluid rounded shadow-sm"
                                alt="{{ $category->name }}"
                                style="max-width: 200px; height: auto;">
                        </div>

                        <a href="{{ route('categories.index') }}" class="btn btn-outline-primary mt-3">
                            Back to List
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>

@endsection
