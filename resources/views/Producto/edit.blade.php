
    <form method="post" action="{{url('/producto/'.$producto->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{method_field('PATCH')}}
                @include('Producto.form', ['Modo' => 'editar'])
    </form>
