@extends('layouts.app')

@section('content')
<div class="container mt-3 ">
    <div class="row justify-content-center mb-3">
    
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    {{ __('A web based application for easy invoice generation.') }}
                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-center">

        <div class="col-md-2 mb-3">
            <div class="card shadow">
                <div class="card-header">{{ __('Total Customers') }}</div>

                <div class="card-body">
                    {{ $customers->count('id') }} customers
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card shadow">
                <div class="card-header">{{ __('Total Items/Services') }}</div>

                <div class="card-body">
                    {{ $items->count('id') }} items / services
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card shadow">
                <div class="card-header">{{ __('Total Invoices') }}</div>

                <div class="card-body">
                    {{ $invoice->count('id') }} invoices
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
