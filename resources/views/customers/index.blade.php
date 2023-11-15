@extends('layouts.app')
@section('content')
    <div class="container justify-content-center col-md-">
        <div class="m-2">
            <div class="p-2">
                <h2>Customers</h2>
            </div>
            <div class="p-2">
                <a class="btn btn-primary" href="{{ route('customers.create') }}">Create New Customer</a>
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
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th class="d-flex justify-content-center">Actions</th>
                </tr>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td class="d-flex justify-content-around">
                        <a class="btn btn-sm btn-secondary" href="{{ route('customers.edit', $customer->id) }}">Edit</a>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
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