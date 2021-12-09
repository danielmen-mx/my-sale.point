@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Costumer</h2>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('costumers.update', $costumer) }}"
                                method="POST"
                                enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label>First Name *</label>
                                <input type="text" name="first_name" class="form-control" required value="{{ old('first_name', $costumer->first_name) }}">
                            </div>

                            <div class="form-group">
                                <label>Last Name *</label>
                                <input type="text" name="last_name" class="form-control" required value="{{ old('last_name', $costumer->last_name) }}">
                            </div>

                            <div class="form-group">
                                <label>Birthday</label>
                                <input type="text" name="birthday" class="form-control" value="{{ old('birthday', $costumer->birthday) }}">
                            </div>

                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $costumer->email) }}">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $costumer->phone) }}">
                            </div>

                            <div class="form-group">
                                @csrf
                                @method('PUT')
                                <input type="submit" value="Update" class="btn btn-sm btn-success">
                            </div>
                            <a href="{{ route('costumers.index') }}" class="btn btn-sm btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection