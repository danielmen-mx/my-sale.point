@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">
                    Articles
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-success float-right">
                        New
                    </a>
                </div>

                <div class="card-header">
                    <form action="">
                        <input type="text" name="searchProduct" style="width: 90%;" value="{{ $searchProduct }}">
                        <input type="submit" class="btn btn-sm btn-success float-lg-right">
                    </form>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead class="table-info">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Acquisition</th>
                                <th>Quantity available</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->acquisition_price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm">
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input 
                                            type="submit"
                                            value="Delete"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Are you sure?')"
                                            >
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection