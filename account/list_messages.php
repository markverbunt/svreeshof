<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');
require('helpers/check_admin.php');

//$sql = "SELECT event_bookings.bookings_id, event_bookings.bookings_status, event_bookings.event_id, events.event_time, events.event_date, events.category, users.firstname, users.lastname, event_bookings.updated_at FROM event_bookings INNER JOIN users ON event_bookings.user_id=users.id INNER JOIN events ON event_bookings.event_id=events.event_id INNER JOIN email_logs ON users.user_id=email_logs.user_id";

$sql = "SELECT users.firstname, users.lastname, messages_logs.email_id, messages_logs.subject, messages_logs.message_read, messages_logs.body, messages_logs.type, messages_logs.send_mail, messages_logs.created_at FROM messages_logs INNER JOIN users ON messages_logs.user_id=users.id";

$result = $mysqli->query($sql);

?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Verzonden berichten</title>
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
                                Verzonden berichten
                                <small>Een overzicht van alle verzonden berichten</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="event-table table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Aan</th>
                                        <th>Onderwerp</th>
                                        <th>Type</th>
                                        <th>Verzonden op</th>
                                        <th>Verzonden per mail?</th>
                                        <th>Geopend?</th>
                                        <th>Bekijk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $email_id = $row['email_id'];
                                        $firstname = $row['firstname'];
                                        $lastname = $row['lastname'];
                                        $subject = $row['subject'];
                                        $message_read = $row['message_read'];
                                        $body = $row['body'];
                                        $body_clean = str_replace(array("\r", "\n"), '', $body);
                                        $type = $row['type'];
                                        $send_mail = $row['send_mail'];
                                        $orgDateTime = $row['created_at'];
                                        $created_at = date("d-m-Y H:i:s", strtotime($orgDateTime));
                                        echo "<tr>";
                                            echo "<td>$firstname $lastname</td>";
                                            echo "<td>$subject</td>";
                                            echo "<td>$type</td>";
                                            echo "<td>$created_at</td>";
                                            if($send_mail=="0") echo "<td>Nee</td>";
                                            else if($send_mail=="1") echo "<td>Ja</td>";
                                            if($message_read=="0") echo "<td>Nee</td>";
                                            else if($message_read=="1") echo "<td>Ja</td>";
                                            echo "<td><script>
                                            function ShowEmal$email_id() {
                                                swal({
                                                    title: 'Onderstaand bericht is verzonden',
                                                    text: '$body_clean',
                                                    showConfirmButton: false,
                                                    showCancelButton: true,
                                                    cancelButtonText: 'Sluiten',
                                                    closeOnCancel: false,
                                                    customClass: 'email-wide',
                                                    html: true
                                                });
                                            }
                                        </script><a href='javascript:void(0)' onclick='ShowEmal$email_id();'><i class='material-icons'>visibility</i></a></td>";
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

    <!-- SweetAlert Plugin Js -->
    <script src="/plugins/sweetalert/sweetalert.min.js"></script>

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
    <script>
        function MessageSend() {
            swal({
                title: "Bericht verzonden",
                text: "Alle berichten zijn succesvol verzonden naar de juiste spelers",
                type: "success",
                timer: 4000,
                showConfirmButton: false,
            });
        }
    </script>
    <?php
    if(isset($_GET['MessageSend'])){
        echo '<script>MessageSend();</script>';}
    ?>
</body>

</html>