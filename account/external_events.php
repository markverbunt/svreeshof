<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');

$sql = "SELECT * FROM external_event_bookings INNER JOIN external_events ON external_events.external_event_id=external_event_bookings.external_event_id WHERE external_event_bookings.user_id='$id'";

$result = $mysqli->query($sql);

?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Evenementen</title>
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
                                Evenementen
                                <small>Bekijk alle evenementen</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="event-table table table-bordered table-striped table-hover dataTable js-exportable event-order-date">
                                <thead>
                                    <tr>
                                        <th>Datum</th>
                                        <th>Tijd</th>
                                        <th>Status</th>
                                        <th>Mogen partners mee?</th>
                                        <th>Aanwezig</th>
                                        <th>Bekijk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $external_event_id = $row['external_event_id'];
                                        $external_bookings_id = $row['external_bookings_id'];
                                        $external_event_time = $row['external_event_time'];
                                        $orgDate = $row['external_event_date'];
                                        $external_event_date = date("d-m-Y", strtotime($orgDate));
                                        $external_event_status = $row['external_event_status'];
                                        $external_event_partners = $row['external_event_partners'];
                                        $bookings_status = $row['bookings_status'];
                                        $with_partner = $row['with_partner'];
                                        if($external_event_status=="0") echo "<tr class='afgelast'>";
                                        else if($external_event_status=="1") echo "<tr class=''>";
                                        if(strtotime($external_event_date) < strtotime('now')) {
                                            echo "<td data-order='2030-00-00'>$external_event_date</td>";
                                        }
                                        else {
                                            echo "<td data-order='$orgDate'>$external_event_date</td>";
                                        }
                                            echo "<th scope='row'>$external_event_time</td>";
                                            if($external_event_status=="0") echo "<td><span class='label bg-red'>AFGELAST</span></td>";
                                            else if($external_event_status=="1") echo "<td><span class='label bg-green'>ACTIEF</soan></td>";
                                            if($external_event_partners=="0") echo "<td><span class='label bg-red'>NEE MOGEN NIET MEE</span></td>";
                                            else if($external_event_partners=="1") echo "<td><span class='label bg-green'>JA MOGEN MEE</span></td>";
                                            if($bookings_status=="0") echo "<td><span class='label bg-red'>NEE</span> & Partner <span class='label bg-red'>NEE</span></td>";
                                            else if($bookings_status=="1" && $with_partner=="0") echo "<td><span class='label bg-green'>JA</span> & Partner <span class='label bg-red'>NEE</span></td>";
                                            else if($bookings_status=="1" && $with_partner=="1") echo "<td><span class='label bg-green'>JA</span> & Partner <span class='label bg-green'>JA</span></td>";
                                            echo "<td><a href='/account/external_event.php?external_event_id=$external_event_id'><i class='material-icons'>visibility</i></a></td>";
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
                "order": [[ 0, "asc" ]]
            });
        });
    </script>
</body>

</html>