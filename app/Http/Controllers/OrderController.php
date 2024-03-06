<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function checkout()
    {

    //mengambil ID pengguna yang sedang login
        $user_id = Auth::id();

    //mencari semua entri dalam tabel carts yang memiliki user_id.
    //jika tidak ada barang di keranjang, akan mengarahkan pengguna kembali ke halaman sebelumnya
        $carts = Cart::where('user_id', $user_id)->get();
        if ($carts == null) {
            return Redirect::back();
        }

    //untuk membuat pesanan    
        $order = Order::create([
            'user_id' => $user_id
        ]);

    //mengurangi jumlah stok produk yang dipesan dari stok yang tersedia.
        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $product->update([
                'stock' => $product->stock - $cart->amount
            ]);

    //mencatat transaksi (transaction)
            Transaction::create([
                'amount' => $cart->amount,
                'order_id' => $order->id,
                'product_id' => $cart->product_id
            ]);

    //menghapus item dari keranjang belanja pengguna.
    //setelah transaksi dilakukan
            $cart->delete();
        }
    //mengarahkan pengguna ke halaman yang menampilkan daftar pesanan
        return Redirect::route('index_order');
    }


//menampilkan daftar pesanan
    public function index_order()
    {
    //memeriksa apakah pengguna admin atau user
        $user = Auth::user();
        $is_admin = $user->is_admin;
    //jika admin akan mengambil semua pesanan dari model Order.
        if ($is_admin) {
            $orders = Order::all();
    //jika user hanya mengambil pesanan yang terkait dengan pengguna.
        } else {
            $orders = Order::where('user_id', $user->id)->get();
        }
        $orders = Order::all();
        return view('index_order', compact('orders'));
    }

    

//Menampilkan show order/detail order
    public function show_order(Order $order)
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;

        if ($is_admin || $order->user_id == $user->id) {
            return view('show_order', compact('order'));
        }
        return view('show_order', compact('order'));
    }


 //mengunggah bukti pembayaran untuk sebuah pesanan   
    public function submit_payment_receipt(Order $order, Request $request)
    {

    //mengambil file bukti pembayaran dari request
        $file = $request->file('payment_receipt');
        $path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();
    //menyimpan file bukti pembayaran ke dalam penyimpanan lokal
        Storage::disk('local')->put(
            'public/' . $path,
            file_get_contents($file)
        );

    //memperbarui pesanan (order) dengan menyimpan path file bukti pembayaran yang baru.
        $order->update([
            'payment_receipt' => $path
        ]);

    
    return Redirect::back();
    }

//mengonfirmasi pembayaran untuk sebuah pesanan
    public function confirm_payment(Order $order)
    {
        $order->update([
            'is_paid' => true
        ]);
        return Redirect::back();
    }

//menampilkan nota transaksi untuk pesanan
    public function NotaTransaksi(Order $order)
    {
        return view('nota', compact('order'));
    }
}