@extends('layouts.app')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
  <div class="card-header"class="btn mt-2" style="background-color: #DBBAD9;"> {{ __('Cart') }}</div>
                    <div class="card-body">

                      
<div class="card-header">
<div class="card-body ">
@if ($errors->any())
@foreach ($errors->all() as $error)
<p>{{ $error }}</p>
@endforeach
@endif
@php
$total_price = 0;
@endphp
<div class="card-group m-auto">
@foreach ($carts as $cart)
<div class="card m-3" style="width: 14rem;">
<img class="card-img-top" src="{{ url('storage/' . $cart->product->image) }}">
<div class="card-body">
<h5 class="card-title">{{ $cart->product->name }}</h5>
<form action="{{ route('update_cart', $cart) }}" method="post">
@method('patch')
@csrf
<div class="input-group mb-3">
<input type="number" class="form-control" aria-describedby="basic-addon2" name="amount" value={{ $cart->amount }}>
<div class="input-group-append">
<button class="btn btn-outline-secondary" type="submit">Update amount</button>
</div>
</div>
</form>
<form action="{{ route('delete_cart', $cart) }}" method="post">
@method('delete')
@csrf
<button type="submit" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
  </svg> Delete</button>
</form>
</div>
</div>
@php
$total_price += $cart->product->price * $cart->amount;
@endphp
@endforeach
</div>
<div class="d-flex flex-column justify-content-end align-items-end">
<p>Total: Rp. {{ $total_price }}</p>
<div>
        @if ($total_price >= 300000)
        @php
        $discount = 0.1 * $total_price;
        $disc = '10%';
        @endphp
        @else
        $discount = 0;
        $disc = '0';
        @endphp
        @endif
        @php
            $total_bayar = $total_price - $discount;
        @endphp

        <p>Total_harga: Rp. {{$total_price}}</p>
        <p>Besaran Diskon : {{ $disc }}</p>
        <p>Diskon : Rp. {{ $discount }}</p>
        <p>Total harga: Rp. {{ $total_bayar }}</p>
    </div>
<form action="{{ route('checkout') }}" method="post">
@csrf
<button type="submit" class="btn btn-primary"
@if ($carts->isEmpty()) disabled
@endif><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5"/>
    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
  </svg> Checkout</button>
</form>
</div>

</div>
</div>
</div>
</div>
@endsection