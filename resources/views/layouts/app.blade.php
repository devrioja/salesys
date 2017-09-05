<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>


</head>
<body>
    <div><img src="img/bg.jpg" id="bg" alt="">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <!--<a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>-->

                    <!-- -->

                            <a  href="{{ url('/') }}">
                                <img src="img/logo_effron.png" alt="effron"/>
                            </a>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link href="../../../public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '< Ant',
                nextText: 'Sig >',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);
            $( "#datepicker" ).datepicker({
                appendText: "(dd-mm-yyyy)",

            });
            $( "#datepicker2" ).datepicker({
                appendText: "(dd-mm-yyyy)",

            });

        });
    </script>

    <script type="text/javascript">
        function getArticle(){

            var consulta;

                //obtenemos el texto introducido en el campo de búsqueda
                consulta = $("#articleName").val();

                //hace la búsqueda

                $.ajax({
                            data: {"_token":"<?php echo csrf_token() ?>","parametro1" : consulta},
                            type: "GET",
                            dataType: "json",
                            url: "/salessystem/public/querydb",
                        })
                        .done(function( data, textStatus, jqXHR ) {
                            if ( console && console.log ) {
                                for(var i=0;i<data.length;i++) {
                                    var textnode = document.createTextNode(data[i].nombre+' - '+data[i].nombrem);
                                    var othertextnode = document.createTextNode("Delete");

                                    var result = document.createElement("DIV");
                                    var buttom = document.createElement("BUTTON");
                                    var cajaTexto = document.createElement("INPUT");
                                    var idArticulosSeleccionados = document.createElement("INPUT");


                                    idArticulosSeleccionados.setAttribute("type","hidden");
                                    idArticulosSeleccionados.setAttribute("name","articles[]");
                                    idArticulosSeleccionados.setAttribute("value",data[i].id);

                                    cajaTexto.setAttribute("id","it"+data[i].id);
                                    cajaTexto.setAttribute("name","cantidad[]");
                                    cajaTexto.setAttribute("class", "form-control ");
                                    cajaTexto.setAttribute("required", "required");
                                    cajaTexto.setAttribute("placeholder", "Ingrese Cantidad del Articulo");

                                    buttom.setAttribute("type", "button");
                                    buttom.setAttribute("onClick","deleteArticle(this.id);");
                                    buttom.setAttribute("class", "btn btn-primary btn-xs");
                                    buttom.setAttribute("id","bt"+data[i].id);
                                    buttom.appendChild(othertextnode);

                                    result.setAttribute("class", "alert alert-success");
                                    result.setAttribute("id", "id" + data[i].id);
                                    result.appendChild(textnode);
                                    result.appendChild(cajaTexto);
                                    result.appendChild(idArticulosSeleccionados);
                                    result.appendChild(buttom);

                                    //document.getElementById("listarArticulos").setAttribute("class","container");
                                    document.getElementById("listaArticulos").appendChild(result);
                                }



                            }
                        })
                        .fail(function( jqXHR, textStatus, errorThrown ) {
                            if ( console && console.log ) {
                                console.log( "La solicitud a fallado: " +  textStatus);
                            }
                        });

                 }


    </script>
    <script type="text/javascript">
        $( "#deleteArticles" ).click(function() {
            $( "#listaArticulos" ).empty();
        });

        $(document).ready(function() {
            $('#btnSearch').keydown(function(event){
                if((event.keyCode == 13)) {
                    event.preventDefault();
                    return false;
                }
            });
        });


       function deleteArticle(id_value){

            var idvalue=id_value.split('bt');
           $('#id'+idvalue[1]).remove();
       }
    </script>
    </div>
    <img src="{{URL::asset('img/effron.png')}}" alt="EFFRON" class="logo-login-pie">
    <!--<div class="logo-login-pie"><img src="../img/effron.png" alt="effron"/></div>-->
    
</body>
</html>
