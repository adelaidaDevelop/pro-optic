<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\User;
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
        return $this->validator($request->all())->validate();

        /*$datosEmpleado = request()->except('_token','password_confirmation','username','password','email');//,'apellidos','contra2','correo');
        $dato = ['status','alta'];
        $datosEmpleado = Arr::add($datosEmpleado,'status','alta');
        //$datosEmpleado = Arr::add($datosEmpleado, 'price', 100);
        
        $this->validator($request->all())->validate();

        
        //return $datosEmpleado;

        User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $user = User::latest('id')->first();
        $datosEmpleado = Arr::add($datosEmpleado,'idUsuario',$user->id);
        Empleado::insert($datosEmpleado);
        return redirect('puntoVenta/empleado');*/
        
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:30'],
            'apellidos' => ['required', 'string', 'max:30'],
            'domicilio' => ['required', 'string', 'max:50'],
            'curp' => ['required', 'string', 'max:18','unique:empleados'],
            'telefono' => ['required', 'string', 'max:10'],
            'cargo' => ['required', 'string', 'max:30'],
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
        $datosEmpleado = Empleado::findOrFail($id);
        $users = User::where('id','=',$datosEmpleado->idUsuario)->first();
        return view('Empleado.index2',compact('datosEmpleado','users'));
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
            $rules = [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ];
            $mesages = [
                'password.required' => 'Por favor escriba su contrseña',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres',
                
            ];

                $validator = Validator::make($request->all(), $rules, $mesages);
            return $validator->fails();
            /*if($validator->fails()):
                return back()->withErrors($validator)->with('message','Se ha producido un error')->with(
                    'typealert','danger');
            endif;
            Empleado::where('id','=',$id)->update(['status' => $request->input('status')]);
            return redirect('puntoVenta/empleado/'.$id.'/edit');*/
        }
        if($request->has('passwordChange'))
        {
            Empleado::where('id','=',$id)->update(['password' => Hash::make($request->input('passwordChange'))]);
            return redirect('puntoVenta/empleado/'.$id.'/edit');
        }
        else
        {
            
            $datosEmpleado = request()->except(['_token','_method','email','username']);
            Empleado::where('id','=',$id)->update($datosEmpleado);
            return redirect('puntoVenta/empleado/'.$id.'/edit');
        }
        {

        }
        //'password' => Hash::make($request['password'])
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
        //where("status",'=','alta')->orderBy('nombre')->get();
        return view('Empleado.empleados',$datosConsulta);
        //return $datosConsulta;
    }

    
}
