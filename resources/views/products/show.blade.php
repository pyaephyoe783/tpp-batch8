@extends('layouts.master')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Show</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 justify-center" style="width: fit-content">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-3">About {{ $product['name'] }} </h3>

                    <p class="card-text">
                        <strong>Description:</strong> {{ $product['description'] }}
                    </p>

                    <p class="card-text">
                        <strong>Price:</strong> ${{ $product['price'] }}
                    </p>

                    <div>
                         <img src="{{ asset('ProductsImage/' . $product->image ) }}"
                         class="card-img-top"
                         alt="{{ $product->name }}"
                         style="width: 150px;height: auto;">
                    </div>

                    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Back</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</body>
</html>


@endsection
