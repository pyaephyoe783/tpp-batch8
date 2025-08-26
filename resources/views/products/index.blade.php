@extends('layouts.master')
@section('content')



<div class="container">
    <h1 class="mb-4">Product List</h1>
  <div class="d-flex justify-content-between align-items-center mb-3 container mt-5 mx-auto">
                <a href="{{ route('products.create') }}" class="btn btn-success">+ Create</a>
    </div>

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th style="width: 220px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->description }}</td>
                    <td>${{ $data->price  }}</td>
                    <td>{{ $data->category->name ?? 'No Category' }}</td>
                            <th>
                            {{-- @if ($data->status === 1)
                                <span class="text-success">Active</span>
                            @else
                                <span class="text-danger">Suspend</span>
                            @endif --}}
                            <form action="{{ route('products.status', ['id' => $data->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $data->status === 1 ? "btn-success" : "btn-danger" }}">
                                    {{ $data->status === 1 ? "Active" : "Suspened"  }}
                                </button>
                            </form>
                        </th>
                    <td>
                        <img src="{{ asset('ProductsImage/' . $data->image ) }}" alt=" {{ $data->image }} " style="width:50px; height: auto;">
                    </td>
                    <td>
                        @can('productList')
                            <a href="{{ route('products.show', $data->id) }}" class="btn btn-info btn-sm">Show</a>
                        @endcan
                        @can('productUpdate')
                            <a href="{{ route('products.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endcan
                        @can('productDelete')
                            <form action="{{ route('products.delete', $data->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure to delete this product?')">
                                Delete
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>





@endsection
