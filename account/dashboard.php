<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');

foreach($mysqli->query("SELECT COUNT(*) FROM event_bookings INNER JOIN events ON events.event_id=event_bookings.event_id WHERE bookings_status='1' AND user_id='$id' AND category='wedstrijd'") as $totalcount_wedstrijden) {
    $count_wedstrijden  = "". $totalcount_wedstrijden['COUNT(*)'] ."";
}

foreach($mysqli->query("SELECT COUNT(*) FROM event_bookings INNER JOIN events ON events.event_id=event_bookings.event_id WHERE bookings_status='1' AND user_id='$id' AND category='training'") as $totalcount_trainingen) {
    $count_trainingen  = "". $totalcount_trainingen['COUNT(*)'] ."";
}

foreach($mysqli->query("SELECT COUNT(*) FROM users WHERE user_status='1' AND player_type='0'") as $totalcount_users_play) {
    $count_users_play  = "". $totalcount_users_play['COUNT(*)'] ."";
}

$sql = "SELECT * FROM event_bookings INNER JOIN events ON events.event_id=event_bookings.event_id WHERE event_bookings.user_id='$id' AND events.event_date >= CURDATE() ORDER BY events.event_date ASC LIMIT 2";

$result = $mysqli->query($sql);

$sql2 = "SELECT *, SUM(event_scorers.goals) FROM event_scorers INNER JOIN users ON users.id=event_scorers.user_id GROUP BY users.firstname ORDER BY SUM(event_scorers.goals) DESC LIMIT 3";

$result2 = $mysqli->query($sql2);

$sql3 = "SELECT * FROM external_event_bookings INNER JOIN external_events ON external_events.external_event_id=external_event_bookings.external_event_id WHERE external_event_bookings.user_id='$id' AND external_events.external_event_date >= CURDATE() ORDER BY external_events.external_event_date ASC LIMIT 2";

$result3 = $mysqli->query($sql3);

foreach($mysqli->query("SELECT COUNT(*) FROM event_bookings WHERE event_id='$lasteventid' AND bookings_status='0'") as $totafmeldingen) {
    $afmeldingen  = "". $totafmeldingen['COUNT(*)'] ."";
}
foreach($mysqli->query("SELECT COUNT(*) FROM event_bookings WHERE event_id='$lasteventid' AND bookings_status='1'") as $totaanmeldingen) {
    $aanmeldingen  = "". $totaanmeldingen['COUNT(*)'] ."";
}
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
            <div class="block-header">
                <h1>Welkom <?php echo ''. $firstname . ' ' . $lastname . '' ; ?></h1>
            </div>

            <!-- Widgets -->
            <?php if($is_admin) echo '
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="/account/event.php?event_id=' . $lasteventid . '" style="cursor: pointer; text-decoration: none;">
                        <div class="info-box bg-orange hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="content">
                                <div class="text">AFMELDINGEN DEZE WEEK</div>
                                <div class="number count-to" data-from="0" data-to="' . $afmeldingen . '" data-speed="1000" data-fresh-interval="20">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="/account/users_play.php" style="cursor: pointer; text-decoration: none;">
                        <div class="info-box bg-orange hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="content">
                                <div class="text">AANWEZIG DEZE WEEK</div>
                                <div class="number count-to" data-from="0" data-to="' . $aanmeldingen . '" data-speed="1000" data-fresh-interval="20">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="/account/users_rest.php" style="cursor: pointer; text-decoration: none;">
                        <div class="info-box bg-orange hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="content">
                                <div class="text">TOTAAL AANTAL SPELERS</div>
                                <div class="number count-to" data-from="0" data-to="' . $count_users_play . '" data-speed="1000" data-fresh-interval="20">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>';?>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="/account/finance.php" style="cursor: pointer; text-decoration: none;">
                        <div class="info-box bg-pink hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">euro</i>
                            </div>
                            <div class="content">
                                <div class="text">OPENSTAAND BEDRAG</div>
                                <div class="number count-to" data-from="0" data-to="<?php echo $finance;?>" data-speed="1000" data-fresh-interval="5"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="/account/events_wedstrijd.php" style="cursor: pointer; text-decoration: none;">
                        <div class="info-box bg-cyan hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">sports_soccer</i>
                            </div>
                            <div class="content">
                                <div class="text">GESPEELDE WEDSTRIJDEN</div>
                                <div class="number count-to" data-from="0" data-to="<?php echo $count_wedstrijden;?>" data-speed="1000" data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="/account/events_training.php" style="cursor: pointer; text-decoration: none;">
                        <div class="info-box bg-light-green hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">sports_soccer</i>
                            </div>
                            <div class="content">
                                <div class="text">DEELNAME TRAININGEN</div>
                                <div class="number count-to" data-from="0" data-to="<?php echo $count_trainingen;?>" data-speed="1000" data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </a>
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
                                            <th>Tijd</th>
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
                                                $event_time = $row['event_time'];
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
                                                    echo "<td>$event_time</td>";
                                                    echo "<td>$category</td>";
                                                    echo "<td>$gameinfo</td>";
                                                    if($bookings_status=="0") echo "<td><span class='label bg-red'>NEE</span></td>";
                                                    else if($bookings_status=="1") echo "<td><span class='label bg-green'>JA</span></td>";
                                                    echo "<td><a href='/account/event.php?event_id=$event_id'><i class='material-icons'>visibility</i></a>";
                                                echo "</tr>";
                                                }
                                            } else {}
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>AANKOMENDE EVENEMENTEN</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="/account/events_wedstrijd.php">Alle evenementen</a></li>
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
                                            <th>Tijd</th>
                                            <th>Categorie</th>
                                            <th>Aanwezig</th>
                                            <th>Partner?</th>
                                            <th>Bekijk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if ($result3->num_rows > 0) {
                                            while ($row = $result3->fetch_assoc()) {
                                                $external_event_id = $row['external_event_id'];
                                                $orgDate = $row['external_event_date'];
                                                $external_event_time = $row['external_event_time'];
                                                $external_event_date = date("d-m-Y", strtotime($orgDate));
                                                $external_event_category = $row['external_event_category'];
                                                $external_event_status = $row['external_event_status'];
                                                $bookings_status = $row['bookings_status'];
                                                $with_partner = $row['with_partner'];
                                                if($external_event_status=="0") echo "<tr class='afgelast'>";
                                                else if($external_event_status=="1") echo "<tr class=''>";
                                                    if($external_event_status=="0") echo "<td><span class='label bg-red'>AFGELAST</span></td>";
                                                    else if($event_status=="1") echo "<td><span class='label bg-green'>ACTIEF</soan></td>";
                                                    echo "<td>$external_event_date</td>";
                                                    echo "<td>$external_event_time</td>";
                                                    echo "<td>$external_event_category</td>";
                                                    if($bookings_status=="0") echo "<td><span class='label bg-red'>NEE</span></td>";
                                                    else if($bookings_status=="1") echo "<td><span class='label bg-green'>JA</span></td>";
                                                    if($with_partner=="0") echo "<td><span class='label bg-red'>NEE</span></td>";
                                                    else if($with_partner=="1") echo "<td><span class='label bg-green'>JA</span></td>";
                                                    echo "<td><a href='/account/external_event.php?external_event_id=$external_event_id'><i class='material-icons'>visibility</i></a>";
                                                echo "</tr>";
                                                }
                                            } else {}
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
                            <h2>TOP SCORERS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="/account/top_scorers.php">Alle topscorers</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Naam</th>
                                            <th>Aantal doelpunten</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if ($result2->num_rows > 0) {
                                            $ni = 0;
                                            while ($row = $result2->fetch_assoc()) {;
                                                $firstname = $row['firstname'];
                                                $goals = $row['SUM(event_scorers.goals)'];
                                                if($event_status=="0") echo "<tr class='afgelast'>";
                                                else if($event_status=="1") echo "<tr class=''>";
                                                    echo "<td>" . ++$ni . "</td>";
                                                    echo "<td>$firstname</td>";
                                                    echo "<td>$goals</td>";
                                                    echo "<td>$total_played</td>";
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
                <!-- #END# Browser Usage -->
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>SPONSORS</h2>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-2">
                                    <img class="img-responsive" src="/images/verhijko-logo.gif" alt="Verhijko BV">
                                </div>
                                <div class="col-sm-2">
                                    <img class="img-responsive" src="/images/mm-webdesign-logo.png" alt="M&M Webdesign">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

    <!-- SweetAlert Plugin Js -->
    <script src="/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="/js/admin.js"></script>
    <script src="/js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="/js/demo.js"></script>

    <script>
        function financeNotification() {
        swal({
            title: "Er staat nog een bedrag open!",
            text: "Volgens onze administratie staat er nog € <?php echo $finance; ?> open?",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#4CAF50",
            cancelButtonText: "Nee nu niet",
            confirmButtonText: "Ik ga nu betalen",
            closeOnConfirm: true
        }, function () {
            window.location.href = '/account/finance.php';
        });
    }
    </script>
    <?php
        if($finance_popup_true && $finance>=$finance_threshold_amount && !$finance==0) {
            echo '<script>financeNotification();</script>';
        }
    ?>
</body>

</html>