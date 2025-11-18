@extends('layouts1.landing')

@section('title','Servicios')
@section('content')

    <h1>SERVICIOS ESPECIALES</h1>
    @component('_components.card')
        @slot('title','service 1')
        @slot('content', 'Loremp insum dolor')
    
    @endcomponent

    @component('_components.card')
        @slot('title','service 2')
        @slot('content', 'Loremp insum dolor')
     @endcomponent

     @component('_components.card')
        @slot('title','service 3')
        @slot('content', 'Loremp insum dolor')
     @endcomponent
<!--para codigo html@component('_components.card')l@slot('title','Service 2')l@slot('contenido')
            <h3>Ejemplos</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque eius totam ipsa vitae. Est, consectetur? Repudiandae aliquid unde nulla corporis odit excepturi. Tempore minus iusto laudantium sed dolores culpa aperiam?--l@endslot-->
    
@endsection


<!-- para cargar un estilo que solo necesita esta vista-->
@section('styles')
<link rel="stylesheet" href="styles11.css"


@endsection