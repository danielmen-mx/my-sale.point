@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h1>Sale description</h1>
                    <h4>ID: {{ $sale->id }}</h4>
                    <h4>Total: {{ $sale->total }}</h4>
                    <h4>Created at: {{ $sale->created_at }}</h4>
                </div>
            
                <table class="table">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="table-info">
                        @foreach ($sale->descriptions as $description)
                        <tr>
                            <td>{{ $description->product->name }}</td>
                            <td>{{ $description->product->brand }}</td>
                            <td>{{ $description->product->description }}</td>
                            <td>{{ $description->product->sale_price }}</td>
                            <td>{{ $description->quantity }}</td>
                            <td>{{ $description->subtotal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection