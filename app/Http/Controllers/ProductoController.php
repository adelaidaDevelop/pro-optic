<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Departamento;
use Illuminate\Http\Request;
//para poder borrar informacion de los registros de la carpeta uploads de storage
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosProd['producto'] = Producto::paginate();
        $depas['d']= Departamento::paginate();
        $datosP= Producto::all();
        $depa= Departamento::all();
          return view('Producto.index',$depas, compact('depa', 'datosP'));
      
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto['producto']= Producto::paginate();
        $departamento= Departamento::all();
        return view('Producto.create', compact('departamento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosProducto = request()->all();
        $datosProducto = request()->except('_token');
        $datosProducto['existencia']=0;
        $datosProducto['costo']=0;
        $datosProducto['precio']=0;
        if($request->hasFile('Imagen')){
            $datosProducto['Imagen']=$request->file('Imagen')->store('uploads','public');
        }
        Producto::insert($datosProducto);

       // return response()->json($datosProducto);
        return redirect('producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }
    public function show2($id)
    {
        //
        $producto= Producto::findOrFail($id);
        return view('Producto.edit', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $departamento= Departamento::all();
        $producto= Producto::findOrFail($id);
        return view('Producto.edit', compact('producto', 'departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
      //  $departamento= Departamento::all();
        $datosProducto=request()->except(['_token', '_method']);

        if($request->hasFile('Imagen')){
            $producto=Producto::findOrFail($id);
            //borrar fotografia antigua
            Storage::delete('public/'.$producto->imagen);
            $datosProducto['Imagen']=$request->file('Imagen')->store('uploads','public');
        }

        Producto::where('id', '=',$id)->update($datosProducto);

       // $producto=Producto::findOrFail($id);
       // return view('producto.edit', compact('producto', 'departamento'));
        return redirect('producto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Producto $producto)
    public function destroy($id)
    {
        //buscaar todos los datos que corresponden a este id
        $producto= Producto::findOrFail($id);

        if( Storage::delete('public/'.$producto->imagen)){
            Producto::destroy($id);
        }
        return redirect('producto');
    }

    public function buscarProducto(Request $request)
    {
        $productosB['productos'] = Producto::where("id",'=',$request->texto)->get();
        return view('Producto.producto',$productosB);//compact('productoB'));
        //return compact('productoB');

    }
    public function buscador(Request $request)
    {
        $datosConsulta['departamentosB'] = Producto::where("nombre",'like',$request->texto."%")->get();
        return view('Departamento.form',$datosConsulta);
        //return $datosConsulta;
    }
}
