@extends('layouts.app')
@section('content')
<div class="container justify-content-center col-md-8">
    <div class="card m-4 shadow mt-5">
    <div class="card-header">
        <h4>Create Invoice</h4>
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
        <form method="post" action="{{ route('invoices.store') }}" class="prevent-multi" enctype="multipart/form-data">
            @csrf
            <div class="row p-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select class="form-select form-select-sm" name="customer_id">
                            <option value="">Select customer:</option>
                            @foreach (App\Models\Customer::all() as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_date">Date</label>
                        <input type="date" class="form-control form-control-sm" name="invoice_date" placeholder="YYYY-MM-DD"/>
                    </div>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" rows="3" col="4" class="form-control form-control-sm" name="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="dynamic_rows">
                <div class="row p-2">
                    <div class="col-md-3">
                        <label for="item_id[]" class="form-label">Item</label>
                        <select class="form-select form-select-sm change" name="item_id[]">
                            <option value="">Select item:</option>
                            @foreach (App\Models\Item::all() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="quantity[]" class="form-label">Quantity</label>
                        <input type="text" class="form-control form-control-sm quantity qblur" name="quantity[]"/>
                    </div>
                    <div class="col-md-2">
                        <label for="rate[]" class="form-label">Rate</label>
                        <input type="text" class="form-control form-control-sm rate" name="rate[]" readonly/>
                    </div>
                    <div class="col-md-2">
                        <label for="amount[]" class="form-label">Amount</label>
                        <input type="text" class="form-control form-control-sm amount" name="amount[]" readonly/>
                    </div>
                    <div class="col-md-3">
                        <label for="image" class="form-label">Logo</label>
                        <input type="file" class="form-control form-control-sm image" name="image" id="image">
                    </div>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-md-3">
                    <button class="btn btn-sm btn-secondary add_row">Add Row</button>
                    <button type="submit" class="btn btn-sm btn-primary m-2 prevent-multi-submit">Enter Invoice</button>
                </div>
            </div>
        </form>
        <script>
            $(document).ready(function() {
                html = '<div class="row p-2">';
                html+= '<div class="col-md-3"><select class="form-select form-select-sm change" name="item_id[]">';
                html+= '<option value="">Select item:</option>';
                html+= '@foreach (App\Models\Item::all() as $item)';
                html+= '<option value="{{$item->id}}">{{$item->name}}</option>';
                html+= '@endforeach<select></div>';
                html+= '<div class="col-md-2"><input type="text" class="form-control form-control-sm quantity qblur" name="quantity[]"/></div>';
                html+= '<div class="col-md-2"><input type="text" class="form-control form-control-sm rate" name="rate[]" readonly/></div>';
                html+= '<div class="col-md-3"><input type="text" class="form-control form-control-sm amount" name="amount[]" readonly/></div>';
                html+= '<div class="col-md-2"><a href="#" class="btn btn-sm btn-danger remove_row">X</a></div></div>';
                $('.add_row').click(function(e){
                    e.preventDefault();
                    $('.dynamic_rows').append(html);
                })
                $('.dynamic_rows').on("click",".remove_row", function(e){
                    e.preventDefault();
                    $(this).parent('div').parent('div').remove();
                })
                $('.dynamic_rows').on('change','.change',function(){
                    var cached = $(this).parent('div').parent('div');
                    $.get("/rate", {id:$(this).val()}, function(r){
                        cached.find('input.rate').val(r);
                        total(cached);
                    })
                })
                $('.dynamic_rows').on('blur','.qblur',function(){
                    var cached = $(this).parent('div').parent('div');
                    total(cached);
                })
                function total(c){
                    var quantity = c.find('input.quantity').val();
                    var rate = c.find('input.rate').val();
                    var amount;
                    if(quantity && rate){
                        amount = quantity * rate
                    }
                    c.find('input.amount').val(amount);
                }
                $(document).on("keydown", ":input:not(textarea):not(:submit)", function(event) {
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                    }
                })
                $('.prevent-multi').on('submit', function(){
                    $('.prevent-multi-submit').attr('disabled','true');
                    return true;
                })
            });
        </script>
    </div>
    </div>
</div>
@endsection