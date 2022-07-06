<?php

require 'config/conexion.php';

  $query = mysqli_query($conexion, "DELETE FROM  tempory_appoinments")
  or die('error: ' . mysqli_error($conexion));
?>
<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Cita</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        body {
            letter-spacing: 0.7px;
            background-color: #eee;
        }

        .container {
            margin-top: 100px;
            margin-bottom: 100px;
        }

        p {
            font-size: 14px;
        }

        .btn-primary {
            background-color: #42A5F5 !important;
            border-color: #42A5F5 !important;
        }

        .cursor-pointer {
            cursor: pointer;
            color: #42A5F5;
        }

        .pic {
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .card-block {
            width: 200px;
            border: 1px solid lightgrey;
            border-radius: 5px !important;
            background-color: #FAFAFA;
            margin-bottom: 30px;
        }

        .card-body.show {
            display: block;
        }

        .card {
            padding-bottom: 20px;
            box-shadow: 2px 2px 6px 0px rgb(200, 167, 216);
        }

        .radio {
            display: inline-block;
            border-radius: 0;
            box-sizing: border-box;
            cursor: pointer;
            color: #000;
            font-weight: 500;
            -webkit-filter: grayscale(100%);
            -moz-filter: grayscale(100%);
            -o-filter: grayscale(100%);
            -ms-filter: grayscale(100%);
            filter: grayscale(100%);
        }


        .radio:hover {
            box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .radio.selected {
            box-shadow: 0px 8px 16px 0px #EEEEEE;
            -webkit-filter: grayscale(0%);
            -moz-filter: grayscale(0%);
            -o-filter: grayscale(0%);
            -ms-filter: grayscale(0%);
            filter: grayscale(0%);
        }

        .selected {
            background-color: #E0F2F1;
        }

        .a {
            justify-content: center !important;
        }


        .btn {
            border-radius: 0px;
        }

        .btn,
        .btn:focus,
        .btn:active {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
</head>

<body className='snippet-body'>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card text-center justify-content-center shaodw-lg  card-1 border-0 bg-white px-sm-2">
                    <div class="card-body show  ">
                        <div class="row">
                            <div class="col">
                                <h5><b>Bienvenido</b></h5>
                                <p> Que Servicio Desea Agendar ? <span class=" ml-1 cursor-pointer"> Seleccione </span> </p>
                            </div>
                        </div>
             <form id="form" name="login-form" method="POST" action="select_services.php">         
                        <div class="radio-group row justify-content-between px-3 text-center a">
                            <div class="col-auto mr-sm-2 mx-1 card-block  py-0 text-center radio selected ">
                                <div class="flex-row">
                                    <div class="col">
                                        <div class="pic"> <img class="irc_mut img-fluid" src="https://aprende.com/wp-content/uploads/2020/09/preparate-para-aumentar-tus-ingresos-salida-laboral-en-manicure--940x580.jpg" width="300" height="300"> </div>
                                        <p></p>
                                    </div>
                                    <input type="radio" name="radios" id="radio1" value='11' class="invisible-radio">
                                    <label for="radio1">
                                        Manicure
                                        <div class="styled-radio red" data-text="Logo 1"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto mr-sm-2 mx-1 card-block  py-0 text-center radio selected ">
                                <div class="flex-row">
                                    <div class="col">
                                        <div class="pic"> <img class="irc_mut img-fluid" src="https://diseñosuñas.com/wp-content/uploads/2021/03/pedicura-disenos-02.jpg" width="300" height="300"> </div>
                                        <p></p>
                                        <input type="radio" name="radios" id="radio2" value='12' class="invisible-radio">
                                        <label for="radio2">
                                            Pedicure
                                            <div class="styled-radio green" data-text="Logo 2"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mr-sm-2 mx-1 card-block  py-0 text-center radio selected ">
                                <div class="flex-row">
                                    <div class="col">
                                        <div class="pic"> <img class="irc_mut img-fluid" src="https://www.cimformacion.com/blog/wp-content/uploads/2017/01/limpieza-facial-min.jpg" width="300" height="300"> </div>
                                        <p></p>
                                        <input type="radio" name="radios" id="radio3" value='14' class="invisible-radio">
                                        <label for="radio3">
                                            Faciales
                                            <div class="styled-radio blue" data-text="Logo 3"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto ml-sm-2 mx-1 card-block  py-0 text-center radio  ">
                                <div class="flex-row">
                                    <div class="col">
                                        <div class="pic"> <img class="irc_mut img-fluid" src="https://belessaesthetic.com/wp-content/uploads/2019/10/masajes-en-zaragoza.jpg" width="300" height="300"> </div>
                                        <p></p>
                                        <input type="radio" name="radios" id="radio4" value='15' class="invisible-radio"  checked>
                                        <label for="radio4">
                                            Corporales
                                            <div class="styled-radio blue" data-text="Logo 3"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col">
                                <p class="text-muted"></p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto">
                               
                                <a href="http://www.espacioteodora.cl/" class="btn btn-outline-secondary" role="button"  aria-pressed="true">Home</a>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Continuar <span class="ml-2"><i class="fa fa-angle-right" aria-hidden="true"></i></span> </button>
                            </div>
                        </div>
            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            $('.radio-group .radio').click(function() {
                $('.selected .fa').removeClass('fa-check');
                $('.radio').removeClass('selected');
                $(this).addClass('selected');
            });
        });
    </script>
    <script type='text/javascript'>
        var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener('click', function(e) {
            e.preventDefault();
        });
    </script>

</body>

</html>