<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */

//menentukan URL yang akan digunakan untuk mengarahkan pengguna setelah proses konfirmasi kata sandi selesai.
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

//semua aksi dalam kontroler ini hanya dapat diakses oleh pengguna yang telah terotentikasi.
    public function __construct()
    {
        $this->middleware('auth');
    }
}
