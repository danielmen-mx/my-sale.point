@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Articles
                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success float-right">
                        New
                    </a>
                </div>

                <div class="card-header">
                    <form action="">
                        <input type="text" name="searchPost" style="width: 90%" value="{{ $searchPost }}">
                        <input type="submit" class="btn btn-sm btn-success float-right">
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
                                <th>Title</th>
                                <th colspan="2">Options</th>
                                <th colspan="2">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
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
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection