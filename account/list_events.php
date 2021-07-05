<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');
require('helpers/check_admin.php');

$sql = "SELECT * FROM events";
$result = $mysqli->query($sql);

$error_event=$_GET['event_id'];
$event_category=$_GET['event_category'];
?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Alle Wedstrijden / Trainingen</title>
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

    <!-- Sweetalert Css -->
    <link href="/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

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
                                Wedstrijden & Trainingen
                                <small>Klik op het potlood om event te wijzigen</small>
                            </h2>
                            <?php if($is_admin) echo'<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="/account/add_event.php">Voeg een wedstrijd / training toe</a></li>
                                    </ul>
                                </li>
                            </ul>'; ?>
                        </div>
                        <div class="body table-responsive">
                            <table class="event-table table table-bordered table-striped table-hover dataTable event-order-date js-exportable">
                                <thead>
                                    <tr>
                                        <th>Datum</th>
                                        <th>Week</th>
                                        <th>Categorie</th>
                                        <th>Wedstrijd info</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $event_id = $row['event_id'];
                                        $week = $row['week'];
                                        $orgDate = $row['event_date'];
                                        $event_date = date("d-m-Y", strtotime($orgDate));
                                        $category = $row['category'];
                                        $gameinfo = $row['gameinfo'];
                                        $event_status = $row['event_status'];
                                        if($event_status=="0") echo "<tr class='afgelast'>";
                                        else if($event_status=="1") echo "<tr class=''>";
                                            echo "<td data-order='$orgDate'>$event_date</td>";
                                            echo "<th scope='row'>$week</td>";
                                            echo "<td>$category</td>";
                                            echo "<td>$gameinfo</td>";
                                            if($event_status=="0") echo "<td><span class='label bg-red'>AFGELAST</span></td>";
                                            else if($event_status=="1") echo "<td><span class='label bg-green'>ACTIEF</span></td>";
                                            echo "<td><a href='/account/event.php?event_id=$event_id'><i class='material-icons'>visibility</i></a> &nbsp; <a href='/account/edit_event.php?event_id=$event_id'><i class='material-icons'>create</i></a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                  echo "Geen event gevonden";
                                }                                   
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
    
    <!-- SweetAlert Plugin Js -->
    <script src="/plugins/sweetalert/sweetalert.min.js"></script>
    
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

<script>
    function noPlayersFound() {
        swal({
            title: "Geen spelers gevonden!",
            text: "Wil je ze aanmaken in de instellingen tab?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#4CAF50",
            cancelButtonText: "Nee nu niet",
            confirmButtonText: "Ja maak ze aan",
            closeOnConfirm: false
        }, function () {
            window.location.href = '/account/edit_event.php?event_id=<?php echo $error_event; ?>';
        });
    }
    
    function noEventsFound() {
        swal({
            title: "Geen event gevonden!",
            text: "Kies een event uit de lijst",
            type: "error",
            timer: 4000,
            showConfirmButton: false,
        });
    }

    function eventSuccess() {
        swal({
            title: "Event aangemaakt!",
            text: "Vergeet niet spelers te koppelen",
            type: "success",
            timer: 4000,
            showConfirmButton: false,
        });
    }

    function eventSuccessUpdated() {
        swal({
            title: "<?php echo $event_category; ?>",
            text: "Is succesvol geupdate! Verstuurd eventueel een email notificate van de wijziging",
            type: "success",
            timer: 4000,
            showConfirmButton: false,
        });
    }
</script>
<?php
if(isset($_GET['noPlayersFound'])){
    echo '<script>noPlayersFound();</script>';}
if(isset($_GET['noEventsFound'])){
    echo '<script>noEventsFound();</script>';}
if(isset($_GET['eventSuccess'])){
    echo '<script>eventSuccess();</script>';}
if(isset($_GET['eventSuccessUpdated'])){
    echo '<script>eventSuccessUpdated();</script>';}
?>


</body>

</html>