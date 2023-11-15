@extends('layouts.app')
@section('content')
<div class="card m-4">
  <div class="card-header">
    <h4>Edit Item</h4>
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
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row p-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-sm" name="name" value="{{ $item->name }}"/>
                </div>
                <div class="form-group">
                    <label for="unit">Currency</label>
                    <input type="text" class="form-control form-control-sm" name="unit" value="{{ $item->unit }}"/>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control form-control-sm" name="description" value="{{ $item->description }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sale_rate">Sale Rate</label>
                    <input type="text" class="form-control form-control-sm" name="sale_rate" value="{{ $item->sale_rate }}"/>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-secondary m-2">Submit</button>
    </form>
  </div>
</div>
@endsection