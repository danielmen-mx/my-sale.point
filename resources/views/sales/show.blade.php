@extends('layouts.app')

@section('content')
    <div class="card shadow">
        <h1>Sale description</h1>
        <h4>ID: {{ $sale->id }}</h4>
        <h4>Total: {{ $sale->total }}</h4>
        <h4>Created at: {{ $sale->created_at }}</h4>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Brand</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Subtotal</th>
            </tr>
        </thead>
        <tbody>
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
@endsection