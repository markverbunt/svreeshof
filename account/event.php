<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');

$event_id=$_GET['event_id'];
//$sql = "SELECT * FROM events WHERE event_id='$event_id' LIMIT 1";
$sql = "SELECT * FROM event_bookings INNER JOIN events ON events.event_id=event_bookings.event_id WHERE event_bookings.user_id='$id' AND events.event_id='$event_id' LIMIT 1 ";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
} else {
  header("location: /account/list_events.php?noPlayersFound&event_id=$event_id");
}
$category = $row['category'];
$event_time = $row['event_time'];
$event_date = $row['event_date'];
$orgDate = $row['event_date'];
$event_date = date("d-m-Y", strtotime($orgDate));
$info = $row['info'];
$gameinfo = $row['gameinfo'];
$location = $row['location'];
$event_status = $row['event_status'];
$bookings_id = $row['bookings_id'];
$bookings_status = $row['bookings_status'];

$sql2 = "SELECT event_bookings.bookings_id, event_bookings.bookings_status, event_bookings.event_id, users.firstname, users.lastname, users.player_type, event_bookings.updated_at FROM event_bookings INNER JOIN users ON event_bookings.user_id=users.id INNER JOIN events ON event_bookings.event_id=events.event_id WHERE event_bookings.event_id='$event_id' ORDER BY FIELD(event_bookings.bookings_status, '0', '1')";

$result2 = $mysqli->query($sql2);

foreach($mysqli->query("SELECT COUNT(*) FROM event_bookings WHERE event_id='$event_id' AND bookings_status='0'") as $totafmeldingen) {
    $afmeldingen  = "". $totafmeldingen['COUNT(*)'] ."";
}

foreach($mysqli->query("SELECT COUNT(*) FROM event_bookings WHERE event_id='$event_id' AND bookings_status='1'") as $totaanmeldingen) {
    $aanmeldingen  = "". $totaanmeldingen['COUNT(*)'] ."";
}

?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - <?php if($event_status=="0") echo "AFGELAST"; elseif($event_status=="1") echo "ACTIEF"; ?> <?php echo $category; ?> - <?php echo $event_date; ?> <?php echo $event_time; ?></title>
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

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

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

    <section class="content" id="show-event">
        <div class="container-fluid">

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            <strong><?php if($event_status=="0") echo "<span class='label bg-red'>AFGELAST</span>"; elseif($event_status=="1") echo "<span class='label bg-green'>ACTIEF</span>"; ?> <?php echo $category; ?></strong> - <?php echo $event_date; ?> <?php echo $event_time; ?>
                            </h2>
                            <?php if($is_admin) echo'<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="/account/edit_event.php?event_id=' . $event_id . '">Bewerken</a></li>
                                    </ul>
                                </li>
                            </ul>'; ?>
                        </div>
                        <div class="body">
                            <div class="pull-right">
                                <form action="helpers/modify_bookings.php" method="post">
                                    <input type='hidden' name='user_id' value="<?php echo $id; ?>">
                                    <input type='hidden' name='event_id' value="<?php echo $event_id; ?>">
                                    <input type='hidden' name='bookings_id' value="<?php echo $bookings_id; ?>">
                                    <?php
                                        if($category=="wedstrijd" && strtotime($event_date) > strtotime('now')) {
                                            if(!$booking_block) {
                                                if($bookings_status=="1" && $event_status=="1") echo "<input type='hidden' name='bookings_status' value='0'><button class='btn btn-danger waves-effect' type='submit' name='cancel'><i class='material-icons'>close</i><span>Ik wil me afmelden</span></button>";
                                                else if($bookings_status=="0"  && $event_status=="1") echo "<input type='hidden' name='bookings_status' value='1'><button class='btn btn-success waves-effect' type='submit' name='aanmelden'><i class='material-icons'>check</i><span>Ik wil me toch weer aanmelden</span></button>";
                                            }
                                            else {
                                                echo "<span class='label bg-red'>Aan/afmelden niet mogelijk door betalingsachterstand</span>";
                                            }
                                        }
                                        else if($category=="training" && strtotime($event_date) > strtotime('now-1day')) {
                                            if($bookings_status=="1" && $event_status=="1") echo "<input type='hidden' name='bookings_status' value='0'><button class='btn btn-danger waves-effect' type='submit' name='cancel'><i class='material-icons'>close</i><span>Ik wil me afmelden</span></button>";
                                            else if($bookings_status=="0"  && $event_status=="1") echo "<input type='hidden' name='bookings_status' value='1'><button class='btn btn-success waves-effect' type='submit' name='aanmelden'><i class='material-icons'>check</i><span>Ik wil me toch weer aanmelden</span></button>";
                                        }
                                    ?>
                                </form>
                            </div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#overzicht" data-toggle="tab">
                                        <i class="material-icons">home</i> OVERZICHT
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#afmeldingen" data-toggle="tab">
                                        <i class="material-icons">face</i><?php if($category=="wedstrijd") {echo "AFMELDINGEN (". $afmeldingen .")";} else {echo "AANMELDINGEN (". $aanmeldingen .")";} ?>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="overzicht">
                                    <div class="row clearfix">
                                        <div class="col-md-3">
                                            <b>Tijd</b>
                                            <div class="input-group">
                                                <?php echo $event_time; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Datum</b>
                                            <div class="input-group">
                                                <?php echo $event_date; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Categorie</b>
                                            <div class="input-group">
                                                <?php echo $category; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Wedstrijd info</b>
                                            <div class="input-group">
                                                <?php echo $gameinfo; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <b>Locatie</b>
                                            <div class="form-group">
                                                <?php echo $location; ?>
                                            </div>
                                            <div style="width: 700px;position: relative;"><iframe width="700" height="440" src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=<?php echo preg_replace('/[[:space:]]+/', '', $location); ?>+(<?php echo $category; ?>)&amp;ie=UTF8&amp;t=k&amp;z=13&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><br />
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <b>Overige informatie</b>
                                            <div class="form-group">
                                                <?php echo $info; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="afmeldingen">
                                    <table class="event-table table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Naam</th>
                                                <th>Aanwezig <?php if($category=="wedstrijd" && strtotime($event_date) < strtotime('now')) {echo "geweest";} else if($category=="training" && strtotime($event_date) < strtotime('now-1day')) {echo "geweest";}?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if ($result2->num_rows > 0) {
                                            while ($row = $result2->fetch_assoc()) {
                                                $firstname = $row['firstname'];
                                                $lastname = $row['lastname'];
                                                $player_type = $row['player_type'];
                                                $bookings_status = $row['bookings_status'];
                                                if($player_type=="1") echo "<tr class='noplayer'>";
                                                else if($bookings_status=="0") echo "<tr class='afgelast'>";
                                                else if($bookings_status=="1") echo "<tr class=''>";
                                                    echo "<td>$firstname $lastname</td>";
                                                    if($player_type=="1") echo "<td><span class='label bg-yellow'>RUSTEND LID</span></td>";
                                                    if($bookings_status=="0" && $player_type=="0") echo "<td><span class='label bg-red'>NEE</span></td>";
                                                    else if($bookings_status=="1" && $player_type=="0") echo "<td><span class='label bg-green'>JA</span></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                          echo "<td>Geen afmeldingen gevonden</td>";
                                        }                                   
                                            $mysqli->close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
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

    <!-- Autosize Plugin Js -->
    <script src="/plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="/plugins/momentjs/moment.js"></script>
    <script src="/plugins/momentjs/nl.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="/js/admin.js"></script>
    <script src="/js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="/js/demo.js"></script>
    <script type="text/javascript">
        $('input#DateTimePicker').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', minDate : new Date() });
    </script>
</body>

</html>