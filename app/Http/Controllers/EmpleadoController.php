<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\User;
use App\Models\Sucursal;
use App\Models\SucursalEmpleado;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('isEmpleado');
        
    }

    public function index()
    {
        //return view('Empleado.index');
        //return view('Empleado.sesion1');
        //$datos['departamentos'] = Departamento::paginate();
        //return view('header2');//,$datos);
        // return view('Empleado.index2');//,$datos);
         return view('Empleado.index2');
       // return view('Empleado.index');//,$datos);
       
    }
    /*
    public function index2()
    {
        
        return view('Empleado.sesion1');//,$datos);

    }*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(array $data)
    {
        Empleado::create([
            'nombre' => 'Adelaida',
            'apellidos' => 'Molina Reyes',
            'claveE' => '123457',
            'telefono' => '9512274920',
            'cargo' => 'administrador',
            'curp' => 'DDFSD6SDF5DF4D',
            'domicilio' => 'Libertad 12',
            'usuario' => $data['name'],
            'contra' => $data['password'],
            'correo' => $data['email'],
            'status' =>'alta',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        //return 'si lo valida';
        $datosEmpleado = request()->except('_token','password_confirmation','username','password','email');//,'apellidos','contra2','correo');
        $dato = ['status','alta'];
        $datosEmpleado = Arr::add($datosEmpleado,'status','alta');
        //$datosEmpleado = Arr::add($datosEmpleado, 'price', 100);
        
        //$this->validator($request->all())->validate();
        $usuario = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'tipo' => 0,
        ]);

        //$user = User::latest('id')->first();
        $datosEmpleado = Arr::add($datosEmpleado,'idUsuario',$usuario->id);
        //$empleado = new Empleado;
        $empleado = Empleado::create($datosEmpleado);
        $SucursalEmpleado = new Sucursal_empleado;
        $SucursalEmpleado->idEmpleado = $datosEmpleado->id;
        $SucursalEmpleado->idSucursal = session('sucursal');
        $SucursalEmpleado->save();
        //Empleado::insert($datosEmpleado);
        return redirect('puntoVenta/empleado/'.$datosEmpleado->id.'/edit');
        
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
                'nombre' => ['required', 'string', 'max:30'],
                'apellidoPaterno' => ['required', 'string', 'max:30'],
                'apellidoMaterno' => ['required', 'string', 'max:30'],
                'domicilio' => ['required', 'string', 'max:50'],
                'curp' => ['required', 'string', 'max:18','unique:empleados'],
                'telefono' => ['required', 'string', 'max:10'],
                'claveE' => ['required', 'string', 'max:5','unique:empleados'],
                'username' => ['required', 'string', 'max:255','unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//Empleado $empleado)
    {
        //$datos['empleados'] = Departamento::paginate();
        if($id == 0)
        {
            $admin = User::findOrFail(1);
            $sucursal = Sucursal::findOrFail(session('sucursal'));
            return view('Empleado.index2',compact('admin','sucursal'));
        }
        else{
            $datosEmpleado = Empleado::findOrFail($id);
            $users = User::where('id','=',$datosEmpleado->idUsuario)->first();
            return view('Empleado.index2',compact('datosEmpleado','users'));
        }
        //return $users;//compact('datosEmpleado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->has('status'))
        {
            Empleado::where('id','=',$id)->update(['status' => $request->input('status')]);
            return redirect('puntoVenta/empleado/'.$id.'/edit');
        }
        if($request->has('passwordChange'))
        {
            
            $rules = [
                'passwordChange' => ['required', 'string', 'min:8'],
            ];
            $mesages = [
                'passwordChange.required' => 'Por favor escriba su contraseña',
                'passwordChange.min' => 'La contraseña debe tener al menos 8 caracteres',
                
            ];
            
            $validator = Validator::make($request->all(), $rules, $mesages);
            
            if($validator->fails())
                return $validator->errors()->first();
            //return 'Si entra';
            /*if($validator->fails()):
                return back()->withErrors($validator)->with('message','Se ha producido un error')->with(
                    'typealert','danger');
            endif;*/
            User::where('id','=',$id)->update(['password' => Hash::make($request->input('passwordChange'))]);
            return;
            //return redirect('puntoVenta/empleado/'.$id.'/edit');
        }
        else
        {
            $datos = []; //$request->all();
            $empleado = Empleado::findOrFail($id);
            $user = User::where('id','=',$empleado->idUsuario)->first();
            if($request->input('nombre') != $empleado->nombre)
                $datos = Arr::add($datos,'nombre',$request->input('nombre'));
            if($request->input('apellidos') != $empleado->apellidos)
                $datos = Arr::add($datos,'apellidos',$request->input('apellidos'));
            if($request->input('domicilio') != $empleado->domicilio)
                $datos = Arr::add($datos,'domicilio',$request->input('domicilio'));
            if($request->input('curp') != $empleado->curp)
                $datos = Arr::add($datos,'curp',$request->input('curp'));
            if($request->input('email') != $user->email)
                $datos = Arr::add($datos,'email',$request->input('email'));
            if($request->input('telefono') != $empleado->telefono)
                $datos = Arr::add($datos,'telefono',$request->input('telefono'));
            if($request->input('claveE') != $empleado->claveE)
                $datos = Arr::add($datos,'claveE',$request->input('claveE'));
            if($request->input('username') != $user->username)
                $datos = Arr::add($datos,'username',$request->input('username'));
            //return 'Si llega hasta aqui';
            //$this->validator($request->all())->validate();
            $validacion =  Validator::make($datos, [
                'nombre' => ['string', 'max:30','min:3'],
                'apellidos' => ['string', 'max:30','min:3'],
                'domicilio' => ['string', 'max:50','min:3'],
                'curp' => ['string','min:18' ,'max:18','unique:empleados'],
                'telefono' => ['string', 'max:10','min:7'],
                'claveE' => ['string', 'max:5','unique:empleados','min:5'],
                'username' => ['string', 'max:255','unique:users','min:3'],
                'email' => ['string', 'email', 'max:255', 'unique:users','min:5'],
            ]);
            if($validacion->fails()):
                return back()->withErrors($validacion)->with( ['cambios' => true] )->withInput($request->all());
            endif;
            $validacion->validate();
            $datosEmpleado = request()->except(['_token','_method','email','username']);
            $datosUser = request()->only(['email','username']);
            Empleado::where('id','=',$id)->update($datosEmpleado);
            User::where('id','=',$user->id)->update($datosUser);
            return redirect('puntoVenta/empleado/'.$id.'/edit');
            //return $datos;
        }
        //'password' => Hash::make($request['password'])
        
        return 'No lo reconoce';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Empleado::destroy($id);
        $dato = (['status'=>'baja']);;
        Empleado::where('id','=',$id)->update($dato);
        return redirect('puntoVenta/empleado');
    }

    public function buscadorEmpleado(Request $request)
    {
        $datosConsulta['empleados'] = Empleado::where("nombre",'like',$request->texto."%")->orderBy('nombre')->get();
        $admin = User::findOrFail(1);
        //where("status",'=','alta')->orderBy('nombre')->get();
        return view('Empleado.empleados',$datosConsulta,compact('admin'));
        //return $datosConsulta;
    }

    
}
