<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;

use App\Models\Empleado;
use App\Models\Sucursal_empleado;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    

    /**
     * Where to redirect users after login.
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
        //$this->middleware('guest')->except('logout');
        //$this->middleware('isEmpleado');
    }

    public function login()
    {
        if(session()->has('idUsuario'))
        {
            if(Auth::check())
            {
                if(Auth::user()->tipo == 0)
                {
                    if(Auth::user()->id == 1)
                    {
                        /*session(['sucursal' => session('sucursal')]);
                        session(['idSucursalEmpleado' => $sucursalEmpleado->id]);

                        session(['idEmpleado' => $empleado->id]);
                        //session(['idUsuario' => Auth::user()->id]);
                        //session(['sucursal' => $request->input('opcionSucursal')]);
                        //session(['idSucursalEmpleado' => $sucursalEmpleado->id]);
                        $sucursal = Sucursal::findOrFail(session('susucrsal'))->direccion;
                        session(['sucursalNombre' => $sucursal]);*/
                        return redirect('/puntoVenta/home');
                    }
                        $id = Auth::user()->id;
                        $empleado = Empleado::where('idUsuario','=',$id)->get()->first();
                        $sucursalEmpleado = Sucursal_empleado::where('idSucursal','=',session('sucursal'))
                        ->where('idEmpleado','=',$empleado->id)->get()->first();
                        
                        if(!empty($sucursalEmpleado) && $sucursalEmpleado->status == 'alta')
                        {
        //                    return redirect('/puntoVenta/home');
                        //$request->session()->regenerate();
                    //    session(['idUsuario' => Auth::user()->id]);
                        session(['sucursal' => session('sucursal')]);
                        session(['idSucursalEmpleado' => $sucursalEmpleado->id]);

                        session(['idEmpleado' => $empleado->id]);
                        //session(['idUsuario' => Auth::user()->id]);
                        //session(['sucursal' => $request->input('opcionSucursal')]);
                        //session(['idSucursalEmpleado' => $sucursalEmpleado->id]);
                        //$sucursal = Sucursal::findOrFail(session('susucrsal'))->direccion;
                        //session(['sucursalNombre' => $sucursal]);
                        //$sucursal = Sucursal::findOrFail($request->input('opcionSucursal'))->direccion;
                        //session(['sucursalNombre' => $sucursal]);
                
                        return redirect('/puntoVenta/venta');//->intended('/');
                        }
                    /*$id = Auth::user()->id;
                    $empleado = Empleado::where('idUsuario','=',$id)->get()->first();
                    $sucursalEmpleado = Sucursal_empleado::where('idSucursal','=',session('sucursal'))
                    ->where('idEmpleado','=',$empleado->id)->get()->first();
                    if($sucursalEmpleado->count() && $sucursalEmpleado->status == 'alta')
                        return redirect('/puntoVenta/home');*/
                    
                }
                Auth::logout();
            }
            $idUsuario = session('idUsuario');
            Auth::loginUsingId($idUsuario);
            return redirect('/puntoVenta/home');
            
        }
        $sucursales = Sucursal::all(['id','direccion']);     
        return view('auth.login',compact('sucursales'));
        //
        //return 'Si entra aqui';
    }
    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->tipo == 0)
            {
                /*if(Auth::user()->id == 1)
                {
                    $request->session()->regenerate();
                    session(['idUsuario' => Auth::user()->id]);
                    session(['sucursal' => $request->input('opcionSucursal')]);
                    $sucursal = Sucursal::findOrFail($request->input('opcionSucursal'))->direccion;
                    session(['sucursalNombre' => $sucursal]);
                
                    return redirect('/puntoVenta/venta');
                }*/
                $id = Auth::user()->id;
                $empleado = Empleado::where('idUsuario','=',$id)->get()->first();
                //return $id;
                $sucursalEmpleado = Sucursal_empleado::where('idSucursal','=',$request->input('opcionSucursal'))
                ->where('idEmpleado','=',$empleado->id)->get()->first();
                //return $sucursalEmpleado;
                if(!empty($sucursalEmpleado) && $sucursalEmpleado->status == 'alta')
                {
//                    
                $request->session()->regenerate();
                session(['idEmpleado' => $empleado->id]);
                session(['idUsuario' => Auth::user()->id]);
                session(['sucursal' => $request->input('opcionSucursal')]);
                session(['idSucursalEmpleado' => $sucursalEmpleado->id]);
                $sucursal = Sucursal::findOrFail($request->input('opcionSucursal'))->direccion;
                session(['sucursalNombre' => $sucursal]);
                return redirect('/puntoVenta/home');//redirect('/puntoVenta/venta');//->intended('/');
                }
            }
            Auth::logout();
        }

        return redirect('puntoVenta/login')->withErrors([
            'email' => 'El email y/o la contraseña son incorrectos',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        /*$idCliente = NULL;
        if(session()->has('idCliente'))
        {
            $idCliente = session('idCliente');
        }*/
        //$request->session()->invalidate();
        $request->session()->regenerate();

        $request->session()->regenerateToken();
        /*if($idCliente != NULL)
        {
            session(['idCliente'])
        }*/
        session()->forget('idUsuario');
        session()->forget('idEmpleado');
        session()->forget('idSucursalEmpleado');
        session()->forget('sucursal');
        session()->forget('sucursalNombre');
        return redirect('puntoVenta/login');
        //return 'Tambien entra a esta funcion';
    }
}