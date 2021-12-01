@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Article</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name*</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
                        </div>

                        <div class="form-group">
                            <label>Brand*</label>
                            <input type="text" name="brand" class="form-control" required value="{{ old('brand', $product->brand) }}">
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="file">
                        </div>

                        <div class="form-group">
                            <label>Description*</label>
                            <textarea name="description" rows="6" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}">
                        </div>

                        <div class="form-group">
                            <label>Acquisition Price</label>
                            <input type="text" name="acquisition_price" class="form-control" value="{{ old('acquisition_price', $product->acquisition_price) }}">
                        </div>

                        <div class="form-group">
                            <label>Quantity Available</label>
                            <input type="text" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}">
                        </div>

                        <div class="form-group">
                            @csrf
                            @method('PUT')
                            <input type="submit" value="Update" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection