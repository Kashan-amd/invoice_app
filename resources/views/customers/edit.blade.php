@extends('layouts.app')
@section('content')
<div class="card m-4">
  <div class="card-header">
    <h4>Edit Customer</h4>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif
    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row p-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-sm" name="name" value="{{ $customer->name }}"/>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control form-control-sm" name="email" value="{{ $customer->email }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control form-control-sm" name="phone" value="{{ $customer->phone }}"/>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control form-control-sm" name="address" value="{{ $customer->address }}"/>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-secondary m-2">Submit</button>
    </form>
  </div>
</div>
@endsection