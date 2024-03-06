<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

//memastikan bahwa pengguna harus masuk untuk mengakses metode yang dijaga oleh middleware
public function __construct()
{
$this->middleware('auth');
}

//menampilkan profil pengguna yang sedang masuk ke sistem
public function show_profile()
{
$user = Auth::user();
return view('show_profile', compact('user'));
}

//untuk memungkinkan pengguna untuk mengedit profil mereka, termasuk mengubah nama dan kata sandi
public function edit_profile(Request $request)
{
$request->validate([
'name' => 'required',
'password' => 'required|min:8|confirmed'
]);
$user = Auth::user();
$user->update([
'name' => $request->name,
'password' => Hash::make($request->password)
]);
return Redirect::back();
}
}