<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{

//mengembalikan view dengan nama 'create_product'
    public function create_product()
    {
        return view('create_product');
    }

//menyimpan informasi produk yang baru dibuat ke dalam data base
    public function store_product(Request $request)
    {

    //memvalidasi data yang diterima dari request
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

    //mengambil file gambar dari request
        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

    //menyimpan file gambar ke dalam penyimpanan lokal (Storage)
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

    //membuat data baru dalam tabel product
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path
        ]);

    //mengarahkan pengguna kembali ke halaman indeks produk
        return Redirect::route('index_product');
    }

//menampilkan daftar produk
    public function index_product()
    {
        $products = Product::all();
        return view('index_product', compact('products'));
    }

//menampilkan detail produk tertentu
    public function show_product(Product $product)
    {
        return view('show_product', compact('product'));
    }

//menampilkan form pengeditan produk tertentu
    public function edit_product(Product $product)
    {
        return view('edit_product', compact('product'));
    }

//memperbarui detail produk yang ada dalam sistem berdasarkan data yang dikirimkan
    public function update_product(Product $product, Request $request)
    {
    //untuk memastikan bahwa semua kolom yang diperlukan
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);
    //mengambil file gambar baru dari request    
        $file = $request->file('image');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

    //menyimpan file gambar baru ke dalam penyimpanan lokal Storage
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));
    
    //memperbarui/update detail produk yang ada dalam database
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $path
        ]);
    //mengarahkan pengguna kembali ke halaman indeks produk     
        return Redirect::route('index_product', $product);
    }

//menghapus produk dari database
    public function delete_product(Product $product)
    {
        $product->delete();
        return Redirect::route('index_product');
    }
}