@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h1>Sales</h1>
                </div>

                <table class="table">
                    <thead class="table-info">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Total</th>
                            <th scope="col">Date</th>
                            <th scope="col">Options</th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>${{ $sale->total }}</td>
                                <td>{{ $sale->created_at }}</td>
                                <td>{{ $sale->updated_at }}</td>
                                <td>
                                    <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-primary btn-sm">
                                        Show
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('sales.destroy', $sale) }}" method="POST">
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
                {{ $sales->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@endsection