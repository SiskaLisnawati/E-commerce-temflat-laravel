<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //untuk menambah product ke keranjang
    public function add_to_cart(Product $product, Request $request)
    

   //untuk memvalidasi data yang diterima dari request.
   //Memvalidasi bahwa jumlah barang yang diminta (amount) harus ada, 
   //Mengambil ID pengguna yang saat ini sedang login menggunakan Auth::id()
   //mengambil ID produk dari objek $product yang diteruskan ke dalam method sebagai parameter.
   {
        $request->validate([
            'amount' => 'required|gte:1|lte:' . $product->stock
        ]);
        $user_id = Auth::id();
        $product_id = $product->id;

    //mencari apakah ada entri dalam tabel carts yang memiliki product_id dan user_id yang sesuai dengan produk dan pengguna yang bersangkutan. 
    //Jika tidak ada, variabel $existing_cart akan bernilai null.
        $existing_cart = Cart::where('product_id', $product_id)->where('user_id', $user_id)->first();
        if($existing_cart == null)
        {


    //memvalidasi jumlah barang yang diminta apakah tidak melebihi stok yang tersedia.  
    //Jika validasi berhasil, membuat entri baru di tabel carts dengan informasi pengguna, ID produk, dan jumlah barang yang diminta.      
            $request->validate([
            'amount' => 'required|gte:1|lte:' . $product->stock
        ]);
        Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'amount' => $request->amount
        ]);
    }

    //memvalidasi jumlah barang yang diminta apakah tidak melebihi stok yang tersedia. 
    //Jika validasi berhasil, akan memperbarui jumlah barang di keranjang yang ada dengan menambahkan jumlah yang diminta ke jumlah yang ada di keranjang.
    
    else
    {
        $request->validate([
            'amount' => 'required|gte:1|lte:' . ($product->stock -
            $existing_cart->amount)
        ]);
        $existing_cart->update([
            'amount' => $existing_cart->amount + $request->amount
        ]);
    }

    //mengarahkan pengguna ke halaman Cart belanja 
    return Redirect::route('show_cart');
        
    //menambahkan produk ke keranjang
        Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'amount' => $request->amount
        ]);
    //mengarahkan pengguna ke halaman index product
        return Redirect::route('index_product');
    }

    
    public function __construct()
    {
        $this->middleware('auth');
    }

    // untuk menampilkan isi keranjang
    public function show_cart()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();
        return view('show_cart', compact('carts'));
    }

    // untuk mengupdate isi product yang ada di keranjang
    public function update_cart(Cart $cart, Request $request)
    {
        $request->validate([
            'amount' => 'required|gte:1|lte:' . $cart->product->stock
        ]);
        $cart->update([
            'amount' => $request->amount
        ]);
        return Redirect::route('show_cart');
    }

    // untuk menghapus product yang ada di keranjang
    public function delete_cart(Cart $cart)
    {
        $cart->delete();
        return Redirect::route('index_product');
    }
}