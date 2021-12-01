@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form
                        action="{{ route('products.store') }}"
                        method="POST"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Brand *</label>
                            <input type="text" name="brand" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="file">
                        </div>

                        <div class="form-group">
                            <label>Description *</label>
                            <textarea name="description" id="" rows="6" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Price *</label>
                            <input type="text" name="sale_price" class="form-control" required></input>
                        </div>

                        <div class="form-group">
                            <label>Acquisition</label>
                            <input type="text" name="acquisition_price" class="form-control" required></input>
                        </div>

                        <div class="form-group">
                            <label>Quantity Available</label>
                            <input type="number" name="quantity" class="form-control" value="0" required></input>
                        </div>

                        <div class="form-group">
                            @csrf
                            <button action="{{ route('products.index') }}" class="btn btn-sm btn-warning">Back</button>
                            <input type="submit" value="Enter" class="btn btn-sm btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection