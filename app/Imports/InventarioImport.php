<?php

namespace App\Imports;

use App\Models\Producto;
use App\Models\Departamento;
use App\Models\Sucursal_producto;
//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\{Importable, ToModel, WithHeadingRow};//, WithValidation};
class InventarioImport implements ToModel, WithHeadingRow//, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $departamento = $row['departamento'];
        $departamento_base = Departamento::where('nombre','=',$departamento)->first();
        if(empty($departamento_base))
        {
            $depa['nombre'] = $departamento;
            $depa['ecommerce'] = 0;
            $departamento_base = Departamento::create($depa);
        }
        /*return new Producto([
            'codigoBarras' => $row['codigo'],
            'nombre' => $row['descripcion'],
            'imagen' => '',
            'descripcion' => $row['descripcion'],
            'receta' => 'NO',
            'idDepartamento' => (integer) $departamento_base->id,
        ]);*/
        $produc['codigoBarras'] = $row['codigo'];
            $produc['nombre'] = $row['descripcion'];
            $produc['imagen'] = '';
            $produc['descripcion'] = $row['descripcion'];
            $produc['receta'] = 'NO';
            $produc['idDepartamento'] = (integer) $departamento_base->id;
        $producto = Producto::create($produc);
        return new Sucursal_producto([
            'costo' => $row['precio_costo'],
            'precio' => $row['precio_venta'],
            'existencia' => $row['inventario'],
            'minimoStock' => 1,
            'status' => 1,
            'idSucursal' => (integer) session('sucursal'),
            'idProducto' => (integer) $producto->id,
        ]);

    }

    /*public function rules()
    {
        return [
            'registration_number' => 'regex:/[A-Z]{3}-[0-9]{3}/',
            'doors' => 'in:2,4,6',
            'years' => 'between:1998,2017'
        ];
    }*/

}
