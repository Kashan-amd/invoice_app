@extends('layouts.app')
@section('content')
    <div class="container justify-content-center">
        <div class="m-2">
            <div class="p-2">
                <h2>Invoices</h2>
            </div>
            <div class="p-2">
                <a class="btn btn-primary" href="{{ route('invoices.create') }}">Create New Invoice</a>
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
    <div class="container card shadow justify-content-center col-md-8">
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>Date</th>
                    <th>Invoice Ref.</th>
                    <th>Customer</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th class="d-flex justify-content-center">Actions</th>
                </tr>
                @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F d, Y')}}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->customer->name }}</td>
                    <td>{{ $invoice->description }}</td>
                    <td>{{ $invoice->amount }}</td>
                    <td class="d-flex justify-content-around">
                        <a class="btn btn-sm btn-secondary" href="{{ route('pdf', $invoice->id) }}">PDF</a>
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST">
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