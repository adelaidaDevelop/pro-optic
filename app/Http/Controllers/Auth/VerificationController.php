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
        /*if (!session()->has('seccion')) {
            $pos = strpos(url()->previous(), 'puntoVenta');
            session(['urlSeccion' => url()->previous()]);
            if ($pos === false) {
                session(['seccion' => 'ecommerce']);
            } else {
                session(['seccion' => 'puntoVenta']);
            }
        }*/
        /*session(['urlVerified' => url()->current()]);
        if (!session()->has('seccion') && session()->has('urlSeccion')){
            $pos = strpos(session('urlSeccion'), 'puntoVenta');

            if ($pos === false) {
                $redirectTo = url('/loginCliente');
                session(['seccion' => 'ecommerce']);
            } else {
                $redirectTo = url('/puntoVentalogin');
                session(['seccion' => 'puntoVenta']);
            }
        }else
        {*/
        //$urlV = session('urlVerified');
        //$id = "";
        if (!session()->has('urlVerified'))
            session(['urlVerified' => url()->current()]);
        $pos1 = strpos(session('urlVerified'), 'verify/');
        //$pos = strpos(url()->current(), 'verify/');

        if ($pos1 === false) {
            
            //session(['seccion' => 'ecommerce']);
        } else {
            //$id = session('urlVerified')[$pos + 7];
            $pos1 = $pos1 + 7;
            $pos2 = strpos(session('urlVerified'), '/',$pos1);
            $pos1 = $pos1;
            $pos2 = $pos2 - 1;
            $id = substr(session('urlVerified'), $pos1,$pos2);
            //session()->forget('idS');
            //session(['idS' => $id]);
            Auth::logout();
            Auth::loginUsingId($id);
            //session(['seccion' => 'puntoVenta']);
        }

        //return 'urlV:'.$urlV.'  idUser:'.$id;
        /*}
        
        if (session('seccion') == 'ecommerce') {
            $this->middleware('isCliente');
        }
        if (session('seccion') == 'puntoVenta') {
            $this->middleware('isEmpleado');
        }*/
        //if(!Auth::check())
        //{
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
        //}

    }
}
