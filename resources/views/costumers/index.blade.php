@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Costumers
                    <a href="{{ route('costumers.create') }}" class="btn btn-sm btn-success float-right">
                        Add New
                    </a>
                </div>

                <div class="card-header">
                    <h1>Search Costumer</h1>
                    <form action="">
                        <input type="text" name="searchCostumer" style="width: 90%;" value="{{ $searchCostumer }}">
                        <input type="submit" class="btn btn-sm btn-info float-lg-right" value="Search">
                    </form>
                </div>
                <div class="card">
                    <table class="table">
                        <thead class="table-info">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Birthday</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Options</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($costumers as $costumer)
                                <tr>
                                    <td>{{ $costumer->id }}</td>
                                    <td>{{ $costumer->first_name }}</td>
                                    <td>{{ $costumer->last_name }}</td>
                                    <td>{{ $costumer->birthday }}</td>
                                    <td>{{ $costumer->email }}</td>
                                    <td>{{ $costumer->phone }}</td>
                                    <td>
                                        <a href="{{ route('costumers.edit', $costumer) }}" class="btn btn-primary btn-sm">
                                        Edit
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('costumers.destroy', $costumer) }}" method="POST">
                                            {{-- {{ method_field('PUT')}}
                                            {{ csrf_field() }} --}}
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
                    {{ $costumers->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection