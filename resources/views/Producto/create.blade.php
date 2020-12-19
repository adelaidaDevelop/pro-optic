
    <form method="post" action="{{url('producto')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
                @include('Producto.form', ['Modo' => 'crear'])
          
    </form>
