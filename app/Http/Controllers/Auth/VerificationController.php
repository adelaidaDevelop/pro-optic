<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\UrlGenerator;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //return NULL;
        if (!session()->has('seccion')) {
            $pos = strpos(url()->current(), 'puntoVenta');

            if ($pos === false) {
                session(['seccion' => 'ecommerce']);
            } else {
                session(['seccion' => 'puntoVenta']);
            }
        }
        if(session('seccion') == 'ecommerce')
        {
            $this->middleware('isCliente');
        }
        if(session('seccion') == 'puntoVenta')
        {
            $this->middleware('isEmpleado');
        }
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
        
    }
}
