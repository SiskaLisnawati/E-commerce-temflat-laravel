@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" >
                <div class="card-header"class="btn mt-2" style="background-color: #DBBAD9;">{{ __('Products') }}</div>
                <div class="d-flex justify-content-between card-header ">
                <div>
                    @if (Auth::check() && Auth::user()->is_admin)
                        <form action="{{ route('create_product') }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary" data-mdb-ripple-init><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                              </svg> Tambah Produk</button>
                        </form>
                        @endif
                    </div>
                </div>
                <style>
                    .btn-ika{
                        background: #aa819d;
                    }
                    .btn-iko{
                        background: #EED3D9;
                    }
                    .btn-iki{
                        background: #aa819d;
                    }
                    .btn-iku{
                        background: #436850;
                    }
                </style>
                <div class="card-group m-auto">
                    @foreach ($products as $product)
                    <div class="col-md">
                    <div class="card m-3" style="width: 10rem;">
                    <img class="card-img-top" src="{{ url('storage/' . $product->image) }}" alt="Card image cap">
                    

                    
                    <form action="{{ route('show_product', $product) }}" method="get">
                        <button type="submit" class="btn btn-outline-secondary btn-center "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                          </svg> View Options .......</button>
                    </form>
                    <div class="card-body">
                        <p class="card-text">{{ $product->name }}</p>
                        <p class="card-text">Rp. {{ $product->price }}</p>

                        @if (Auth::check() && Auth::user()->is_admin)
                        <form action="{{ route('delete_product', $product) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                              </svg> Delete</button>
                        </form>
                        @endif
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
@endsection