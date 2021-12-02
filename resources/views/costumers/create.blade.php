@extends('layouts.app');

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create Costumer</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form 
                        action="{{ route('costumers.store') }}"
                        method="POST"
                        enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label>First Name *</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Last Name *</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Birthday</label>
                            <input type="date" name="birthday" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <div class="form-group">
                            @csrf
                            <button action="{{ route('costumers.index') }}" class="btn btn-sm btn-warning">Back</button>
                            <input type="submit" value="Enter" class="btn btn-sm btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection