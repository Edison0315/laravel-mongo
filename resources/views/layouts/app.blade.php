<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lara-notas') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script>
        $(document).ready(function() {

            if($('.datatable')){
                $('.datatable').DataTable();
            }
            
            if($("#form-alumno")){
                var url = $("#form-alumno").attr('action');
            }

            // $('.btn-delete').click(function(e){
            //     swal({
            //         title: "¿Estas seguro?",
            //         text: "¡El registro sera inactivado!",
            //         icon: "warning",
            //         buttons: true,
            //         dangerMode: true,
            //     })
            //     .then((willDelete) => {
            //         if (willDelete) {
            //             swal("Eliminando...");
            //             let form = $(this).siblings('form').find(".delete-form");
            //             form['prevObject'][0].submit();
            //         }
            //     });
            // });

            // **********************************
            // Modales de los CRUD de los UPDATES
            // **********************************

            $('.btn-alumno').click(function(e){
                
                $("#form-alumno").attr('action', url);
                $('#method').remove();
                $('#matricula').val('');
                $('#nombre').val('');
                $('#curso').val('');
                $('#asignatura').val('');
                $('#repite').val('');
                $('#nota').val('');

                $('#alumno-modal').modal('show');
            });

            // $('.update-alumno').click(function(e){

            //     $("#form-alumno").attr('action', url+"/"+$(this).parents("tr").find(".alumno_matricula").html());
            //     $('.method-content').html('<input type="hidden" name="_method" value="PUT" id="method"/>');
            //     $('#matricula').val($(this).parents("tr").find(".alumno_matricula").html());
            //     $('#nombre').val($(this).parents("tr").find(".alumno_nombre").html());
            //     $('#curso').val($(this).parents("tr").find(".alumno_curso").html());
            //     $('#asignatura').val($(this).parents("tr").find(".alumno_asignatura").html());
            //     $('#repite').val($(this).parents("tr").find(".alumno_repite").html());
            //     $('#nota').val($(this).parents("tr").find(".alumno_nota").html());

            //     $('#alumno-modal').modal('show');
            // }); 

        });

        function actualizar(id_matricula, url){

            let url_actual = window.location.href;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'JSON',
                success: function(data){
                    
                    // console.log(data);

                    let url_new = url_actual.replace("home", "alumnos/"+data.matricula+"");

                    $("#form-alumno").attr('action', url_new);
                    $('.method-content').html('<input type="hidden" name="_method" value="PUT" id="method"/>');
                    $('#matricula').val(data.matricula);
                    $('#nombre').val(data.nombre);
                    $('#curso').val(data.curso);
                    $('#asignatura').val(data.asignatura);
                    $('#repite').val(data.repite);
                    $('#nota').val(data.nota);

                    $('#alumno-modal').modal('show');


                },
                error: function(){
                    swal("Ocurrió un error", "Lo sentimos, vuelve a intentarlo", "error");
                }
            });

        }

        function eliminar(element){

            let arreglo = new Array();
            arreglo.push(element);

            let formulario = arreglo[0]['childNodes'][1];

            swal({
                title: "¿Estas seguro?",
                text: "¡El registro sera inactivado!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Eliminando...");
                    formulario.submit();
                }
            });

        }
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" @if(Auth::check()) @if(Auth::user()->rol == 'Administrador') style="background-color: #F7E3E3 !important;" @endif @endif>
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"> --}}
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
