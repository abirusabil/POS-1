@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>List Purchases</h1>
    </div>
    <div class="col-md-6" style="text-align: end;padding-right: 100px">
        
    </div>
</div>
@stop

@section('content')
{{-- <h1>List Produk</h1>--}}
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h3 class="card-title">List Purchases</h3>
            </div>
            <div class="col">
                <div class="row">
                    <form action="{{route('products.listpurchases','filter')}}" method="get" class="d-flex">
                        @csrf
                        <div class="col">Start</div>
                        <div class="col">
                            <input type="date" name="start" id="start">
                        </div>
                        <div class="col">end</div>
                        <div class="col">
                            <input type="date" name="end" id="end">
                        </div>
                        <div class="col">
                        <button class="btn btn-info" type="submit">filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th class="text-center" >
                        <span  class="info-box-icon text-center"><i class="far fa-image"></i></span>
                    </th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Price Modal</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                    <th>Date</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td align="center"><img src="{{ $purchase->image }}" width="50" height="50" ></td>
                    <td>{{ $purchase->name }}</td>
                    <td>{{ $purchase->size }}</td>
                    <td>$. {{ $purchase->price_modal }}</td>
                    <td>{{ $purchase->qty }}</td>
                    <td>$. {{ $purchase->total_price }}</td>
                    <td>{{ date('d-m-Y',strtotime($purchase->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')

<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
