<?php

namespace App\Http\Controllers;

use App\Models\Subproducto;
use App\Models\Producto;
use App\Models\Sucursal_empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Models\Sucursal_producto;

class SubproductoController extends Controller
{
    public function index()
    {
        $usuarios = ['verProducto', 'crearProducto', 'eliminarProducto', 'modificarProducto', 'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $subproductos = Subproducto::all();
        $idSucursal = session('sucursal');
        $sucursalProd = Sucursal_producto::where('idSucursal', $idSucursal)->get();
        $productos = Producto::all();
        return view('Subproducto.index', compact('subproductos', 'productos', 'sucursalProd'));
        /*
          $datosProd['producto'] = Producto::paginate();
          $departamentos['d']= Departamento::paginate();
          $departamento= Departamento::all();
              return view('Producto.index',$datosProd,$departamentos, compact('departamento'));
   */
    }

    public function create(Request $request)
    {
        $usuarios = ['crearProducto', 'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $idProd = $request->input('id');
        $datosP = Producto::all();
        $subproducto2['subproducto'] = SubProducto::paginate();
        $producto = Producto::all();
        $depas = Departamento::all();
        $idSucursal = session('sucursal');
        $productosSucursal = Sucursal_producto::where('idSucursal', '=', $idSucursal)->get();
        return view('Subproducto.agregar', compact('producto', 'datosP', 'productosSucursal', 'depas', 'idProd'));
    }

    public function existeEnSubproducto(Request $request)
    {
        $idProd = $request->input('id');
        $producto = Producto::all();
        $subproducto = Subproducto::all();
        $idSucursal = session('sucursal');
        $productosSucursal = Sucursal_producto::where('idSucursal', '=', $idSucursal)->where('idProducto', $idProd)->get();
        // $productosSucursal = Sucursal_producto::where('idSucursal', '=',$idSucursal)->get();
        return compact('producto',  'productosSucursal', 'idProd', 'subproducto');
    }
    public function actExistencia(Request $request)
    {
        $id = $request->input('idSucProd');
        $subproducto = Subproducto::where('idSucursal', '=', $id);
        $suc_prod = Sucursal_producto::findOrFail($id);
        $existencia1['existencia'] = $suc_prod->existencia - 1;
        $suc_prod->update($existencia1);
        $existencia['existencia'] = $subproducto['piezas'] + $subproducto['existencia'];
        $subproducto->update($existencia);
        return redirect('/puntoVenta/producto');
    }
    public function store(Request $request)
    {
        $usuarios = ['crearProducto', 'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        // $datosSubproducto = request()->except('_token');
        $datosSubproducto = $request->except('_token');
        //  $idSP = $datosSubproducto['idSucursalProducto'];
        //  $sucProd = Sucursal_producto::findOrFail($idSP);
        // $idProducto = $sucProd['idProducto'];
        // $actualizarProducto = Sucursal_producto::where('idSucursal','=',session('sucursal'))
        //  ->where('idProducto', '=', $idProducto)->get()->first();
        // $exisAct = $actualizarProducto->existencia;
        // if ($exisAct > 1 ) {
        Subproducto::create($datosSubproducto);
        // $existenciaNuevo['existencia'] = $actualizarProducto->existencia - 1;
        //  $actualizarProducto->update($existenciaNuevo);
        return redirect('/puntoVenta/producto');
    }

    public function subProdExisStock($id)
    {
        //   $datosSubproducto = $request->except('_token');
        // $idSP = $datosSubproducto['idSucursalProducto'];
        //return false;
        $sucProd = Sucursal_producto::findOrFail($id);
        //  $idProducto = $sucProd['idProducto'];
        //  $actualizarProducto = Sucursal_producto::where('idSucursal','=',session('sucursal'))
        // ->where('idProducto', '=', $idProducto)->get()->first();
        $exisAct = $sucProd->existencia;
        if ($exisAct >= 1) {
            $subproducto = Subproducto::where('idSucursalProducto', '=', $id); //->first();
            // $piezas['existencia'] = $subproducto->first()->piezas;
            $piezas['existencia'] = $subproducto->first()->existencia + $subproducto->first()->piezas;
            $subproducto->update($piezas);
            $existenciaNuevo['existencia'] = $sucProd->existencia - 1;
            $sucProd->update($existenciaNuevo);
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
    public function subProdExisNuevo(Request $request, $id)
    {
        $subproducto = Subproducto::where('idSucursalProducto', '=', $id); //->first();
        $exisNuevo['existencia'] = $request->input('cantidad');  //$subproducto->first()->existencia + $request->input('cantidad');
        $subproducto->update($exisNuevo);
        return redirect('/puntoVenta/producto');
    }
    public function show($producto) //Subproducto $subproducto)
    {
        /*
        $productos = Producto::where("nombre",'like',$producto."%")->get(['id', 'codigoBarras', 'nombre', 'idDepartamento']);//paginate(30,
            //['id', 'codigoBarras', 'nombre', 'idDepartamento'])->all();
        $productosBusqueda = [];
        //return $productos;
        for($i=0;$i< count($productos);$i++)
        {
            $sP = Sucursal_producto::where('idProducto', '=', $productos[$i]->id)
            ->where('idSucursal','=',session('sucursal'))->where('status','=',1)
                ->first(['id','existencia','costo','precio']);
            if(isset($sP))
            {
                //return $sP;
                $ss = Subproducto::where('idSucursalProducto', '=', $sP->id)
                ->first(['existencia','precio']);
                if(isset($ss))
                {
                    $productos[$i]->existencia = $ss->existencia;
                    //$productos[$i]->costo = $ss->costo;
                    $productos[$i]->precio = $ss->precio;
                    array_push($productosBusqueda,$productos[$i]);
                }
            }
            if(count($productosBusqueda) >= 30)
                return $productosBusqueda;
        }
        return $productosBusqueda;
*/
        $subproductos = Subproducto::all();
        $productosS = [];
        foreach ($subproductos as $pO) {
            $idSP = $pO->idSucursalProducto;
            $sucursalProducto = Sucursal_producto::findOrFail($idSP); // where('idSucursal', '=',$idS)->get();
            if ($sucursalProducto->idSucursal == session('sucursal')) //$idS )
            {
                $producto1 = Producto::where("nombre", 'like', $producto . "%")
                    ->where('id', '=', $sucursalProducto->idProducto)->get(['id', 'codigoBarras', 'nombre', 'idDepartamento'])->first();
                $pO->id = $sucursalProducto->idProducto;
                $pO->nombre = $producto1->nombre;
                $pO->codigoBarras = $producto1->codigoBarras;
                $pO->idDepartamento = $producto1->idDepartamento;
                array_push($productosS, $pO);
            }
        }
        return $productosS;
    }
    public function update(Request $request, $idSucProd)
    {
        $datos['piezas']      = $request->input('piezas');
        $datos['precio']      = $request->input('precio');
        $datos['observacion'] = $request->input('observacion');
        Subproducto::where('idSucursalProducto', '=', $idSucProd)->update($datos);
        return 'El producto ha sido actualizado';
    }
    public function eliminar($id)
    {
        Subproducto::where('idSucursalProducto', '=', $id)->delete();
        return redirect('/puntoVenta/producto');
    }
}
