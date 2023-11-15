@extends('layouts.app')
@section('content')
<div class="container justify-content-center col-md-8">
  <div class="card m-4 shadow mt-5">
    <div class="card-header">
      <h4>Create Item / Service</h4>
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
      <form method="post" action="{{ route('items.store') }}">
          @csrf
          <div class="row p-2">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control form-control-sm" name="name"/>
                  </div>
                  <div class="form-group">
                      <label for="unit">Currency</label>
                      <input type="text" class="form-control form-control-sm" name="unit"/>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="sale_rate">Sale Rate</label>
                      <input type="text" class="form-control form-control-sm" name="sale_rate"/>
                  </div>
                  <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" class="form-control form-control-sm" name="description"/>
                  </div>
              </div>
          </div>
          <button type="submit" class="btn btn-sm btn-secondary m-2">Add Item</button>
      </form>
    </div>
  </div>
</div>
@endsection