<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

//Di dalam konstruktor, middleware 'auth' ditetapkan, 
//yang berarti setiap kali request diarahkan ke method dalam controller ini, 
//Laravel akan memeriksa apakah pengguna sudah terotentikasi atau belum. 
//Jika belum, pengguna akan diarahkan ke halaman login. 
     public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

//mengembalikan view dengan nama 'home'
    public function index()
    {
        return view('home');
    }
}
