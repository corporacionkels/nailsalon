<?php

require 'config/conexion.php';

$query = mysqli_query($conexion, "DELETE FROM  tempory_appoinments")
    or die('error: ' . mysqli_error($conexion));

$query = mysqli_query($conexion, "DELETE FROM tempory_complementary")
    or die('error: ' . mysqli_error($conexion));

$appointment_date = date('Y-m-d');
//echo $appointment_date;
$id = $_GET["id"];
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
                        
                        <form id="form" name="login-form" method="POST" action="loading_services.php">
                            <div class="radio-group row justify-content-between px-3 text-center a" style="display:none;">
                                <div class="col-auto mr-sm-2 mx-1 card-block  py-0 text-center radio selected ">
                                    <div class="flex-row">
                                        <div class="col">
                                            <div class="pic"> <img class="irc_mut img-fluid" src="https://c8.alamy.com/compes/2c31twd/persona-que-escribe-en-el-teclado-portatil-con-pantalla-mostrando-declino-mensaje-en-solicitud-de-credito-2c31twd.jpg" width="600" height="600"> </div>
                                            <p></p>
                                        </div>

                                    </div>
                                </div>


                            </div>
                            <div class="text-center">
                                <img src="https://ventas.t-asegura.cl/wp-content/uploads/2021/01/FRACASADO.jpg" class="rounded" alt="..." width="600" height="600">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col">
                                    <p class="text-muted"></p>
                                </div>
                            </div>
                            <div class="d-grid">
                                <a href="confirm_page.php?id=<?php echo $id ?>" class="btn btn-primary btn-block">Retornar</a>
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