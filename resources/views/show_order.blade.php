@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"class="btn mt-2" style="background-color: #DBBAD9;">{{ __('Order Detail') }}</div>
                <div class="card-header">
                @php
                $total_price = 0;
                @endphp
                <div class="card-body">
                    <h5 class="card-title">Order ID {{ $order->id }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">By {{ $order->user->name }}</h6>
                    @if ($order->is_paid == true)
                    <p class="card-text">Paid</p>
                    @else
                    <p class="card-text">Unpaid</p>
                    @endif
                    <hr>
                    @foreach ($order->transactions as $transaction)
                    <p>{{ $transaction->product->name }} - {{ $transaction->amount }} pcs</p>
                    @php
                    $total_price += $transaction->product->price *
                    $transaction->amount;
                    @endphp
                    @endforeach
                    <hr>
                    <p>Total: Rp{{ $total_price }}</p>
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
                
                        <p>Total_harga: Rp{{$total_price}}</p>
                        <p>Besaran Diskon : {{ $disc }}</p>
                        <p>Diskon : Rp{{ $discount }}</p>
                        <p>Total harga: Rp{{ $total_bayar }}</p>
                    </div>

                    


                    @if ($order->is_paid == false && $order->payment_receipt == 
                    null && !Auth::user()->is_admin)
                    <form action="{{ route('submit_payment_receipt', $order) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Upload your payment receipt</label>
                            <input type="file" name="payment_receipt" class="form-control">
                        </div>                                                                                           
                        <button type="submit" class="btn btn-primary mt-3">Submit payment</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection