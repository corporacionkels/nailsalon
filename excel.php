<?php
session_start();

//Check If user is already logged in

//Page Title
$pageTitle = 'Dashboard';

//Includes
include 'connect.php';


?>
<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Agendamientos - Export Excel</title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='#' rel='stylesheet'>
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
            background-color: #f9f9fa
        }

        .flex {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto
        }

        @media (max-width:991.98px) {
            .padding {
                padding: 1.5rem
            }
        }

        @media (max-width:767.98px) {
            .padding {
                padding: 1rem
            }
        }

        .padding {
            padding: 5rem
        }

        .card {
            box-shadow: none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            -ms-box-shadow: none
        }

        .pl-3,
        .px-3 {
            padding-left: 1rem !important
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #d2d2dc;
            border-radius: 0
        }

        .card .card-title {
            color: #000000;
            margin-bottom: 0.625rem;
            text-transform: capitalize;
            font-size: 0.875rem;
            font-weight: 500
        }

        .card .card-description {
            margin-bottom: .875rem;
            font-weight: 400;
            color: #76838f
        }

        p {
            font-size: 0.875rem;
            margin-bottom: .5rem;
            line-height: .2rem
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar
        }

        .table,
        .jsgrid .jsgrid-table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent
        }

        .table thead th,
        .jsgrid .jsgrid-table thead th {
            border-top: 0;
            border-bottom-width: 1px;
            font-weight: 500;
            font-size: .875rem;
            text-transform: uppercase
        }

        .table td,
        .jsgrid .jsgrid-table td {
            font-size: 0.875rem;
            padding: .875rem 0.9375rem
        }

        .badge {
            border-radius: 0;
            font-size: 12px;
            line-height: 1;
            padding: .375rem .5625rem;
            font-weight: normal
        }

        .btn {
            border-radius: 0
        }
    </style>
</head>

<body className='snippet-body'>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.table2excel.min.js"></script>
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="card-title">Agendamientos</h4>
                                    <p class="card-description"> Datos para exportar a Excel </p>
                                </div>
                                <div class="col-md-4 text-right"> <button id="exporttable" class="btn btn-primary">Exportar Excel</button> </div>
                            </div>
                            <div class="table-responsive">
                                <table id="htmltable" class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Hora de Inicio
                                            </th>
                                            <th>
                                                Servicios Reservados
                                            </th>
                                            <th>
                                                Hora de Finalizacion Prevista
                                            </th>
                                            <th>
                                                Cliente
                                            </th>
                                            <th>
                                                Profesional
                                            </th>
                                            <th>
                                                Total Servicio
                                            </th>
                                       
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $con->prepare("SELECT * , d.first_name as nomcli , d.last_name as apecli , e.first_name as nomemp , e.last_name as apeemp FROM services_booked as a inner join services as b on a.service_id=b.service_id inner join appointments as c on a.appointment_id=c.appointment_id inner join clients as d on c.client_id=d.client_id inner join employees as e on c.employee_id=e.employee_id WHERE 1 ORDER BY `c`.`end_time_expected` DESC;
                                                    ");
                                        $stmt->execute();
                                        $rows = $stmt->fetchAll();
                                        $count = $stmt->rowCount();
                                        foreach($rows as $row)
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['start_time']; ?></td>
                                            <td><?php echo $row['service_name']; ?></td>
                                            <td><?php echo $row['end_time_expected']; ?></td>
                                            <td><?php  echo $row['nomcli']." ".$row['apecli']; ?></td>
                                            <td><?php  echo $row['nomemp']." ".$row['apeemp']; ?></td>
                                            <td><?php echo $row['service_price']; ?></td>
                                           
                                        </tr>
                                        <?php
                                         }
                                        ?>
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
        $(function() {
            $("#exporttable").click(function(e) {
                var table = $("#htmltable");
                if (table && table.length) {
                    $(table).table2excel({
                        exclude: ".noExl",
                        name: "Excel Document Name",
                        filename: "EspacioTeodora" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                        fileext: ".xls",
                        exclude_img: true,
                        exclude_links: true,
                        exclude_inputs: true,
                        preserveColors: false
                    });
                }
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