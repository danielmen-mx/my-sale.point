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
                        action="{{ route('posts.store') }}"
                        method="POST"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title *</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>File</label>
                            <input type="file" name="file">
                        </div>

                        <div class="form-group">
                            <label>Description *</label>
                            <textarea name="body" id="" rows="6" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Content enbed *</label>
                            <input type="text" name="iframe" class="form-control"></input>
                        </div>

                        <div class="form-group">
                            @csrf
                            <button action="{{ route('posts.index') }}" class="btn btn-sm btn-warning">Back</button>
                            <input type="submit" value="Enter" class="btn btn-sm btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection