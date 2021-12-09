@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 text-right">
                            <h1 class="header float-left">Sale description</h1>
                        </div>
                        <div class="col">
                            <a href="{{ $sale->id }}/linkCostumer" class="btn btn-md btn-primary float-right">Link</a>
                        </div>
                    </div>
                    <h4>ID: {{ $sale->id }}</h4>
                    <h4>Total: {{ $sale->total }}</h4>
                    <h4>Created at: {{ $sale->created_at }}</h4>
                    <h4>Customer: @if ($sale->costumerRelation != null)
                        {{ $sale->costumerRelation->first_name }}</h4>   <!-- lo que sucede aqui es que laravel llama al valor de la funcion que se encuentra en el modelo de sale para acceder a las propiedades que este incluye -->
                        @endif
                    <h4>User: @if ($sale->seller != null)
                    {{ $sale->seller->name }}</h4>
                        @endif
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
                <div class="col">
                    <a href="{{ route('sales.index') }}" class="btn btn-sm btn-warning my-2">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection