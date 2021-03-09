<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Producto.oferta');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idSP = $request['producto']['idSucursalProducto'];
        $cantidad = $request['producto']['cantidad'];
        $oferta = Oferta::where('idSucursalProducto','=',$idSP);
        $of = $oferta->get()->first();
        
        //return $oferta;
        if(isset($of))
        {
            //return 'pasa algo 0';
            $suma = $oferta->get()->first()->existencia + $cantidad;
            $oferta->update(['existencia' => $suma]);
            //$oferta->save();
            return $suma;
        }
        else{
            //return 'pasa algo 1';
            Oferta::create([
                'idSucursalProducto' => $idSP,
                'existencia' => $cantidad
            ]);
            return true;
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function show(Oferta $oferta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function edit(Oferta $oferta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(isset($request['restar']))
        {
            $oferta = Oferta::where('idSucursalProducto','=',$id);//->update(['existencia'])
            $resta = $oferta->get()->first()->existencia - $request['restar'];
            $oferta->update(['existencia' => $resta]);
            return true;
        }
        return ':p';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oferta $oferta)
    {
        //
    }
}
