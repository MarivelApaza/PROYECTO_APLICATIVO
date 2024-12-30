@extends('layouts.app')



@section('content')
<div class="container">
    <br><bR>
        <h1>Luminous Kirei</h1>

        <!-- Incluir la vista parcial de resumen -->
        @include('layouts._partials.resumen')

        <div class="text-center" style="margin-top: 50px;">
        <img src="{{ asset('assets/img/cosmetic.png') }}" alt="Imagen de Luminous Kirei"  class="img-fluid" style="max-width: 500px; height: auto;">
    </div>
    </div>
@endsection


