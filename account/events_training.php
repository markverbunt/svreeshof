<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');

$sql = "SELECT * FROM event_bookings INNER JOIN events ON events.event_id=event_bookings.event_id WHERE event_bookings.user_id='$id' AND events.category='training'";

$result = $mysqli->query($sql);

?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Trainingen</title>
    <!-- Favicon-->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-svreeshof">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <?php include 'components/navigation-top.php'; ?>
    <?php include 'components/navigation-left-right.php'; ?>

    <section class="content">
        <div class="container-fluid">
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Trainingen
                                <small>Bekijk een training of meld je snel aan</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="event-table table table-bordered table-striped table-hover dataTable event-order-date js-exportable">
                                <thead>
                                    <tr>
                                        <th>Datum</th>
                                        <th>Tijd</th>
                                        <th>Status</th>
                                        <th>Aanwezig</th>
                                        <th>Bekijk</th>
                                        <th>Snel aan/afmelden</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $event_id = $row['event_id'];
                                        $bookings_id = $row['bookings_id'];
                                        $event_time = $row['event_time'];
                                        $orgDate = $row['event_date'];
                                        $event_date = date("d-m-Y", strtotime($orgDate));
                                        $info = $row['info'];
                                        $event_status = $row['event_status'];
                                        $bookings_status = $row['bookings_status'];
                                        if($event_status=="0") echo "<tr class='afgelast'>";
                                        else if($event_status=="1") echo "<tr class=''>";
                                            echo "<td data-order='$orgDate'>$event_date</td>";
                                            echo "<th scope='row'>$event_time</td>";
                                            if($event_status=="0") echo "<td><span class='label bg-red'>AFGELAST</span></td>";
                                            else if($event_status=="1") echo "<td><span class='label bg-green'>ACTIEF</soan></td>";
                                            if($bookings_status=="0") echo "<td><span class='label bg-red'>NEE</span></td>";
                                            else if($bookings_status=="1") echo "<td><span class='label bg-green'>JA</span></td>";
                                            echo "<td><a href='/account/event.php?event_id=$event_id'><i class='material-icons'>visibility</i></a>";
                                            echo "<td><form method=post action=helpers/modify_bookings.php>
                                            <input type='hidden' name='user_id' value='$id'>
                                            <input type='hidden' name='event_id' value='$event_id'>
                                            <input type='hidden' name='bookings_id' value='$bookings_id'>";
                                            if(strtotime($event_date) > strtotime('now-1day')) {
                                                if($bookings_status=="1" && $event_status=="1") echo "<input type='hidden' name='bookings_status' value='0'><button class='btn btn-danger waves-effect' type='submit' name='cancel'><i class='material-icons'>close</i><span>Afmelden</span></button>";
                                                else if($bookings_status=="0"  && $event_status=="1") echo "<input type='hidden' name='bookings_status' value='1'><button class='btn btn-success waves-effect' type='submit' name='aanmelden'><i class='material-icons'>check</i><span>Aanmelden</span></button>";
                                            }
                                            echo "</form>
                                            </td>";
                                        echo "</tr>";
                                    }
                                } else {}                                   
                                    $mysqli->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Table -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="/plugins/raphael/raphael.min.js"></script>
    <script src="/plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="/js/admin.js"></script>
    <script src="/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="/js/demo.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.event-order-date').DataTable( {
                destroy: true,
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "order": [[ 0, "desc" ]]
            });
        });
    </script>
</body>

</html>