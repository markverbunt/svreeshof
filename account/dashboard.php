<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');

foreach($mysqli->query("SELECT COUNT(*) FROM event_bookings INNER JOIN events ON events.event_id=event_bookings.event_id WHERE bookings_status='1' AND user_id='$id' AND category='wedstrijd'") as $totalcount_wedstrijden) {
    $count_wedstrijden  = "". $totalcount_wedstrijden['COUNT(*)'] ."";
}

foreach($mysqli->query("SELECT COUNT(*) FROM event_bookings INNER JOIN events ON events.event_id=event_bookings.event_id WHERE bookings_status='1' AND user_id='$id' AND category='training'") as $totalcount_trainingen) {
    $count_trainingen  = "". $totalcount_trainingen['COUNT(*)'] ."";
}

foreach($mysqli->query("SELECT COUNT(*) FROM users WHERE user_status='1' AND player_type='0'") as $totalcount_users) {
    $count_users  = "". $totalcount_users['COUNT(*)'] ."";
}

$sql = "SELECT * FROM event_bookings INNER JOIN events ON events.event_id=event_bookings.event_id WHERE event_bookings.user_id='$id' AND events.event_date >= CURDATE() ORDER BY events.event_date ASC LIMIT 2";

$result = $mysqli->query($sql);

?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Dashboard</title>
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
            <div class="block-header">
                <h1>Welkom <?php echo ''. $firstname . ' ' . $lastname . '' ; ?></h1>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">euro</i>
                        </div>
                        <div class="content">
                            <div class="text">OPENSTAAND BEDRAG</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $finance;?>" data-speed="1000" data-fresh-interval="5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">sports_soccer</i>
                        </div>
                        <div class="content">
                            <div class="text">AANWEZIG BIJ WEDSTRIJDEN</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $count_wedstrijden;?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">sports_soccer</i>
                        </div>
                        <div class="content">
                            <div class="text">AANWEZIG BIJ TRAININGEN</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $count_trainingen;?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text">AANTAL SPELENDE LEDEN</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $count_users;?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->   

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>AANKOMENDE WEDSTRIJD / TRAINING</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="/account/events_wedstrijd.php">Alle wedstrijden</a></li>
                                        <li><a href="/account/events_training.php">Alle trainingen</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Datum</th>
                                            <th>Categorie</th>
                                            <th>Wedstrijd info</th>
                                            <th>Aanwezig</th>
                                            <th>Bekijk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $event_id = $row['event_id'];
                                                $orgDate = $row['event_date'];
                                                $event_date = date("d-m-Y", strtotime($orgDate));
                                                $category = $row['category'];
                                                $gameinfo = $row['gameinfo'];
                                                $event_status = $row['event_status'];
                                                $bookings_status = $row['bookings_status'];
                                                if($event_status=="0") echo "<tr class='afgelast'>";
                                                else if($event_status=="1") echo "<tr class=''>";
                                                    if($event_status=="0") echo "<td><span class='label bg-red'>AFGELAST</span></td>";
                                                    else if($event_status=="1") echo "<td><span class='label bg-green'>ACTIEF</soan></td>";
                                                    echo "<td>$event_date</td>";
                                                    echo "<td>$category</td>";
                                                    echo "<td>$gameinfo</td>";
                                                    if($bookings_status=="0") echo "<td><span class='label bg-red'>NEE</span></td>";
                                                    else if($bookings_status=="1") echo "<td><span class='label bg-green'>JA</span></td>";
                                                    echo "<td><a href='/account/event.php?event_id=$event_id'><i class='material-icons'>visibility</i></a>";
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
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>SPONSORS</h2>
                        <div class="body">
                            <img class="img-responsive" src="/images/verhijko-logo.gif" alt="Verhijko BV" style="margin-bottom: 10px;">
                            <img class="img-responsive" src="/images/mm-webdesign-logo.png" alt="M&M Webdesign">
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
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

    <!-- Flot Charts Plugin Js -->
    <script src="/plugins/flot-charts/jquery.flot.js"></script>
    <script src="/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="/js/admin.js"></script>
    <script src="/js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="/js/demo.js"></script>
</body>

</html>