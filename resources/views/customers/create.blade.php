@extends('layouts.app')
@section('content')
<div class="container justify-content-center col-md-8">
  <div class="card m-4 shadow mt-5">
    <div class="card-header">
      <h4>Create Customer</h4>
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
      <form method="post" action="{{ route('customers.store') }}">
          @csrf
          <div class="row p-2">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control form-control-sm" name="name"/>
                  </div>
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control form-control-sm" name="email"/>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control form-control-sm" name="phone"/>
                  </div>
                  <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control form-control-sm" name="address"/>
                  </div>
              </div>
          </div>
          <button type="submit" class="btn btn-sm btn-secondary m-2">Add Customer</button>
      </form>
    </div>
  </div>
</div>
@endsection