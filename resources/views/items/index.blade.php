@extends('layouts.app')
@section('content')
    <div class="container justify-content-center">
        <div class="m-2">
            <div class="p-2">
                <h2>Items / Services</h2>
            </div>
            <div class="p-2">
                <a class="btn btn-primary" href="{{ route('items.create') }}">Create New Service</a>
            </div>
        </div>
    </div>
    <div class="container justify-content-center col-md-8">
    @if ($message = session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    </div>
    <div class=" container card shadow justify-content-center col-md-8">
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>Name</th>
                    <th>Currency</th>
                    <th>Description</th>
                    <th>Sale Rate</th>
                    <th class="d-flex justify-content-center">Actions</th>
                </tr>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->sale_rate }}</td>
                    <td class="d-flex justify-content-around">
                        <a class="btn btn-sm btn-secondary" href="{{ route('items.edit', $item->id) }}">Edit</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection