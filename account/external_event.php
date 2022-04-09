<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');

$external_event_id=$_GET['external_event_id'];
//$sql = "SELECT * FROM events WHERE event_id='$event_id' LIMIT 1";
$sql = "SELECT * FROM external_event_bookings INNER JOIN external_events ON external_events.external_event_id=external_event_bookings.external_event_id WHERE external_event_bookings.user_id='$id' AND external_events.external_event_id='$external_event_id' LIMIT 1 ";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
} else {
  header("location: /account/list_external_events.php?noPlayersFound&external_event_id=$external_event_id");
}
$external_event_category = $row['external_event_category'];
$external_event_time = $row['external_event_time'];
$external_event_date = $row['external_event_date'];
$orgDate = $row['external_event_date'];
$external_event_date = date("d-m-Y", strtotime($orgDate));
$external_event_info = $row['external_event_info'];
$external_event_partners = $row['external_event_partners'];
$external_event_location = $row['external_event_location'];
$external_event_status = $row['external_event_status'];
$external_bookings_id = $row['external_bookings_id'];
$bookings_status = $row['bookings_status'];
$with_partner = $row['with_partner'];

$sql2 = "SELECT external_event_bookings.external_bookings_id, external_event_bookings.bookings_status, external_event_bookings.external_event_id, external_event_bookings.user_id, external_event_bookings.with_partner, users.firstname, users.lastname, users.profile_photo, users.player_type, external_event_bookings.updated_at FROM external_event_bookings INNER JOIN users ON external_event_bookings.user_id=users.id INNER JOIN external_events ON external_event_bookings.external_event_id=external_events.external_event_id WHERE external_event_bookings.external_event_id='$external_event_id' ORDER BY FIELD(external_event_bookings.bookings_status, '0', '1')";

$result2 = $mysqli->query($sql2);

foreach($mysqli->query("SELECT COUNT(*) FROM external_event_bookings WHERE external_event_id='$external_event_id' AND bookings_status='0'") as $totafmeldingen) {
    $afmeldingen  = "". $totafmeldingen['COUNT(*)'] ."";
}

foreach($mysqli->query("SELECT COUNT(*) FROM external_event_bookings WHERE external_event_id='$external_event_id' AND bookings_status='1'") as $totaanmeldingen) {
    $aanmeldingen  = "". $totaanmeldingen['COUNT(*)'] ."";
}

?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - <?php if($external_event_status=="0") echo "AFGELAST"; elseif($external_event_status=="1") echo "ACTIEF"; ?> <?php echo $external_event_category; ?> - <?php echo $external_event_date; ?> <?php echo $external_event_time; ?></title>
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
                            <strong><?php if($external_event_status=="0") echo "<span class='label bg-red'>AFGELAST</span>"; elseif($external_event_status=="1") echo "<span class='label bg-green'>ACTIEF</span>"; ?> <?php echo $external_event_category; ?></strong> - <?php echo $external_event_date; ?> <?php echo $external_event_time; ?>
                            </h2>
                            <?php if($is_admin) echo'<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="/account/edit_external_event.php?external_event_id=' . $external_event_id . '">Bewerken</a></li>
                                    </ul>
                                </li>
                            </ul>'; ?>
                        </div>
                        <div class="body">
                            <div class="pull-right">
                                <form action="helpers/modify_external_bookings.php" method="post">
                                    <input type='hidden' name='user_id' value="<?php echo $id; ?>">
                                    <input type='hidden' name='external_event_id' value="<?php echo $external_event_id; ?>">
                                    <input type='hidden' name='external_bookings_id' value="<?php echo $external_bookings_id; ?>">
                                    <?php
                                        if(strtotime($external_event_date) > strtotime('now+1day')) {
                                            if(!$booking_block_true) {
                                                if($bookings_status=="1" && $external_event_status=="1") {
                                                    echo "<input type='hidden' name='bookings_status' value='0'><button class='btn btn-danger waves-effect' type='submit' name='cancel'><i class='material-icons'>close</i><span>Ik wil me afmelden</span></button></form>";

                                                        if($external_event_partners=="1") {
                                                            echo"<form action='helpers/modify_external_bookings.php' method='post'>
                                                                <input type='hidden' name='user_id' value='$id'>
                                                                <input type='hidden' name='external_event_id' value='$external_event_id'>
                                                                <input type='hidden' name='external_bookings_id' value='$external_bookings_id'>
                                                                <input type='hidden' name='bookings_status' value='$bookings_status'>";
                                                            if($with_partner=="1") {
                                                                echo"<div class='switch m-r-10' style='display: inline-block'>
                                                                <p>Partner mee?</p>
                                                                <label>NEE<input type='checkbox' value='1' name='with_partner' checked><span class='lever switch-col-cyan'></span>JA</label>
                                                                </div>";
                                                            }
                                                            else if($with_partner=="0") {
                                                            echo"<div class='switch m-r-10' style='display: inline-block'>
                                                            <p>Partner mee?</p>
                                                            <label>NEE<input type='checkbox' value='1' name='with_partner'><span class='lever switch-col-cyan'></span>JA</label>
                                                            </div>";
                                                            }
                                                            echo"<button class='btn btn-primary btn-xs waves-effect' type='submit' name='cancel'><span>OPSLAAN</span></button>
                                                            </form>";
                                                        }
                                                    }


                                                else if($bookings_status=="0"  && $external_event_status=="1") {
                                                    echo "<input type='hidden' name='bookings_status' value='1'>";
                                                    if($external_event_partners=="1") {
                                                        if($with_partner=="1") {
                                                        echo"<div class='switch m-r-10' style='display: inline-block'>
                                                            <p>Partner mee?</p>
                                                            <label>NEE<input type='checkbox' value='1' name='with_partner' checked><span class='lever switch-col-cyan'></span>JA</label>
                                                        </div>";
                                                        }
                                                        else if($with_partner=="0") {
                                                        echo"<div class='switch m-r-10' style='display: inline-block'>
                                                            <p>Partner mee?</p>
                                                            <label>NEE<input type='checkbox' value='1' name='with_partner'><span class='lever switch-col-cyan'></span>JA</label>
                                                        </div>";
                                                        }
                                                    }
                                                    echo"<button class='btn btn-success waves-effect' type='submit' name='aanmelden'><i class='material-icons'>check</i><span>Ik wil me aanmelden</span></button>
                                                </form>";
                                                }
                                            }
                                            else {
                                                echo "<span class='label bg-red'>Aan/afmelden niet mogelijk door betalingsachterstand</span>";
                                            }
                                        }
                                    ?>
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
                                        <i class="material-icons">face</i> <?php if($external_event_category=="feest") {echo "AANMELDINGEN (". $aanmeldingen .")";} else {echo "AANMELDINGEN (". $aanmeldingen .")";} ?>
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
                                                <?php echo $external_event_time; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Datum</b>
                                            <div class="input-group">
                                                <?php echo $external_event_date; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Categorie</b>
                                            <div class="input-group">
                                                <?php echo $external_event_category; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Mogen de partners mee?</b>
                                            <div class="input-group">
                                                <?php if($external_event_partners=="0") echo "Nee"; else echo"Ja"; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <b>Locatie</b>
                                            <div class="form-group">
                                                <?php echo $external_event_location; ?>
                                            </div>
                                            <div style="width: 700px;position: relative;"><iframe width="700" height="440" src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=<?php echo preg_replace('/[[:space:]]+/', '', $external_event_location); ?>+(<?php echo $category; ?>)&amp;ie=UTF8&amp;t=k&amp;z=13&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><br />
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <b>Overige informatie</b>
                                            <div class="form-group">
                                                <?php echo $external_event_info; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="afmeldingen">
                                    <table class="event-table table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Naam</th>
                                                <th>Aanwezig <?php if($external_event_category=="feest" && strtotime($external_event_date) < strtotime('now')) {echo "geweest";} else if($external_event_category=="zaalvoetbal" && strtotime($external_event_date) < strtotime('now-1day')) {echo "geweest";}?></th>
                                                <?php if($external_event_partners=="1") :?>
                                                    <th>Partner mee?</th>
                                                <?php endif; ?>    
                                                <?php if($is_admin) : ?>
                                                    <th>Aan/Afmelden</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if ($result2->num_rows > 0) {
                                            while ($row = $result2->fetch_assoc()) {
                                                $firstname = $row['firstname'];
                                                $lastname = $row['lastname'];
                                                $profile_photo = $row['profile_photo'];
                                                $profile_photo_url = '/account/uploads/'. $row['profile_photo'];
                                                $bookings_status = $row['bookings_status'];
                                                $user_id = $row['user_id'];
                                                $external_event_id = $row['external_event_id'];
                                                $external_bookings_id = $row['external_bookings_id'];
                                                $with_partner = $row['with_partner'];
                                                if($bookings_status=="0") echo "<tr class='afgelast'>";
                                                else if($bookings_status=="1") echo "<tr class=''>";
                                                    if (isset($profile_photo)) { echo"
                                                        <td><img src='$profile_photo_url' alt='$firstname $lastname' width='20' height='20' class='profile-photo-list'> $firstname $lastname</td>";
                                                    }
                                                    else {
                                                        echo "<td>$firstname $lastname</td>";
                                                    }
                                                    if($bookings_status=="0") echo "<td><span class='label bg-red'>NEE</span></td>";
                                                    else if($bookings_status=="1") echo "<td><span class='label bg-green'>JA</span></td>";
                                                    if($external_event_partners=="1") {
                                                        if($with_partner=="0") echo "<td><span class='label bg-red'>NEE</span></td>";
                                                        else if($with_partner=="1") echo "<td><span class='label bg-green'>JA</span></td>";
                                                    }
                                                    if($is_admin) {
                                                        if($bookings_status=="1") {
                                                            echo "<td><form action='helpers/modify_external_bookings.php' method='post'>
                                                                    <input type='hidden' name='user_id' value='$user_id'>
                                                                    <input type='hidden' name='external_event_id' value='$external_event_id'>
                                                                    <input type='hidden' name='external_bookings_id' value='$external_bookings_id'>
                                                                    <input type='hidden' name='bookings_status' value='0'>
                                                                    <input type='hidden' name='with_partner' value='0'>
                                                                    <button class='btn btn-danger waves-effect' type='submit' name='cancel'><i class='material-icons'>close</i><span>Afmelden</span></button>
                                                                    </form>";
                                                                    if($external_event_partners=="1") {
                                                                        echo"<form action='helpers/modify_external_bookings.php' method='post'>
                                                                            <input type='hidden' name='user_id' value='$user_id'>
                                                                            <input type='hidden' name='external_event_id' value='$external_event_id'>
                                                                            <input type='hidden' name='external_bookings_id' value='$external_bookings_id'>
                                                                            <input type='hidden' name='bookings_status' value='$bookings_status'>
                                                                            <div class='switch m-t-5'>";
                                                                            if($with_partner=="1") {
                                                                                echo"<label>NEE<input type='checkbox' value='1' name='with_partner' checked><span class='lever switch-col-cyan'></span>JA</label>";
                                                                            }
                                                                            else if($with_partner=="0") {
                                                                            echo"<label>NEE<input type='checkbox' value='1' name='with_partner'><span class='lever switch-col-cyan'></span>JA</label>";
                                                                            }
                                                                        echo"<button class='btn btn-primary btn-xs waves-effect m-l-10' type='submit' name='cancel'><span>OPSLAAN</span></button></div>
                                                                        </form>";
                                                                    }
                                                                echo"</td>";
                                                            }
                                                        else if($bookings_status=="0") {
                                                            echo "<td><form action='helpers/modify_external_bookings.php' method='post'>
                                                                    <input type='hidden' name='user_id' value='$user_id'>
                                                                    <input type='hidden' name='external_event_id' value='$external_event_id'>
                                                                    <input type='hidden' name='external_bookings_id' value='$external_bookings_id'>
                                                                    <input type='hidden' name='bookings_status' value='1'>
                                                                    <button class='btn btn-success waves-effect' type='submit' name='aanmelden'><i class='material-icons'>check</i><span>Aanmelden</span></button>";
                                                                    if($external_event_partners=="1") {
                                                                        if($with_partner=="1") {
                                                                        echo"<div class='switch m-t-5'>
                                                                            <label>NEE<input type='checkbox' value='1' name='with_partner' checked><span class='lever switch-col-cyan'></span>JA</label>
                                                                        </div>";
                                                                        }
                                                                        else if($with_partner=="0") {
                                                                        echo"<div class='switch m-t-5'>
                                                                            <label>NEE<input type='checkbox' value='1' name='with_partner'><span class='lever switch-col-cyan'></span>JA</label>
                                                                        </div>";
                                                                        }
                                                                    }
                                                                echo"</form></td>";
                                                            }
                                                        }
                                                echo "</tr>";
                                            }
                                        } else {
                                          echo "<td>Geen afmeldingen gevonden</td>";
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