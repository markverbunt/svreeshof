<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');
require('helpers/check_admin.php');

$external_event_id=$_GET['external_event_id'];
$sql2 = "SELECT * FROM external_events WHERE external_event_id='$external_event_id' LIMIT 1";
$result = $mysqli->query($sql2);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
} else {
  header("location: /account/list_external_events.php?noEventsFound");
}
$external_event_category = $row['external_event_category'];
$external_event_time = $row['external_event_time'];
$external_event_date = $row['external_event_date'];
$orgDate = $row['external_event_date'];
$external_event_date_title = date("d-m-Y", strtotime($orgDate));
$external_event_info = $row['external_event_info'];
$external_event_partners = $row['external_event_partners'];
$external_event_location = $row['external_event_location'];
$external_event_status = $row['external_event_status'];
$email_send = $row['email_send'];

foreach($mysqli->query("SELECT COUNT(*) FROM external_event_bookings WHERE external_event_id='$external_event_id'") as $totals) {
    $total  = "". $totals['COUNT(*)'] ."";
}

?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Evenement wijzigen</title>
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

    <section class="content" id="edit-event">
        <div class="container-fluid">

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <strong><?php echo $external_event_category; ?></strong> - <?php echo $external_event_date_title; ?> <?php echo $external_event_time; ?>
                                <small>Wijzig</small>
                            </h2>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#wijzigen" data-toggle="tab">
                                        <i class="material-icons">create</i> WIJZIGEN
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#instellingen" data-toggle="tab">
                                        <i class="material-icons">settings</i> INSTELLINGEN
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="wijzigen">
                                    <form action="helpers/modify_external_event.php" method="post">
                                        <input type='hidden' name='external_event_id' value="<?php echo $external_event_id; ?>">
                                        <div class="row clearfix">
                                            <div class="col-md-2">
                                                <b>Status *</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">subject</i>
                                                    </span>
                                                    <select class="form-control show-tick" name="external_event_status" required>
                                                        <option value="0" <?php if($external_event_status=="0") echo "selected"; ?>>Afgelast</option>
                                                        <option value="1" <?php if($external_event_status=="1") echo "selected"; ?>>Actief</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <b>Datum *</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">date_range</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" id="DateTimePicker" class="DateTimePicker form-control" name="external_event_date" placeholder="Kies een datum..." value="<?php echo $external_event_date; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 time_input">
                                                <b>Tijd *</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">access_time</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" name="external_event_time" class="form-control time24" placeholder="VB: 10:00" value="<?php echo $external_event_time; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <b>Categorie *</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">subject</i>
                                                    </span>
                                                    <select class="form-control show-tick" name="external_event_category" required>
                                                        <option value="feest" <?php if($external_event_category=="feest") echo "selected"; ?>>Feest</option>
                                                        <option value="zaalvoetbal" <?php if($external_event_category=="zaalvoetbal") echo "selected"; ?>>Zaalvoetbal</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <b>Mogen partners mee? *</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">person_add</i>
                                                    </span>
                                                    <div class="switch" style="padding-top: 6px;">
                                                        <label>NEE<input type="checkbox" value="1" name="external_event_partners" <?php if($external_event_partners=="1") echo "checked"; ?>><span class="lever switch-col-cyan"></span>JA</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-12">
                                                <b>Locatie *</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">location_on</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" name="external_event_location" class="form-control" placeholder="Locatie" value="<?php echo $external_event_location; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-12">
                                                <b>Overige informatie *</b>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <textarea rows="4" class="form-control no-resize" placeholder=" Overige informatie..." name="external_event_info" required><?php echo $external_event_info; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="WIJZIG">
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="instellingen">
                                    <?php
                                    if($total=="0") {
                                        echo "<h4>Koppel spelers</h4><p>Er zijn nog geen spelers gekoppeld. Dit betekent dat de spelers zich niet kunnen aan/afmelden. Klik op onderstaande knop om spelers te koppelen.</p>
                                    <form action='helpers/connect_external_players.php' method='post'>
                                        <input type='hidden' name='external_event_id' value='$external_event_id'>";
                                        if($external_event_category=="feest") echo "<input type='hidden' name='bookings_status' value='0'>";
                                        if($external_event_category=="zaalvoetbal") echo "<input type='hidden' name='bookings_status' value='0'>";
                                        echo "<input type='submit' class='btn btn-primary m-t-15 waves-effect' value='Koppel spelers'>
                                    </form>";
                                    }
                                    else {
                                        echo "<h4>Gekoppelde spelers</h4><p>Aantal gekoppelde spelers: " . $total ."</p>";
                                    }
                                    ?>
                                    <hr>
                                    <?php
                                        if($email_send=="0") {
                                            echo"<h4>Stuur email notificatie</h4>
                                            <form action='helpers/notify_event_created.php' method='post'>
                                                <input type='hidden' name='event_id' value='$event_id'>
                                                <input type='submit' class='btn btn-primary m-t-15 waves-effect' value='Stuur email notificatie'>
                                            </form>";
                                        }
                                        else {
                                            echo"<h4>Stuur wijzigingen per mail</h4>
                                            <form action='helpers/notify_event_changed.php' method='post'>
                                                <input type='hidden' name='event_id' value='$event_id'>
                                                <input type='submit' class='btn btn-primary m-t-15 waves-effect' value='Stuur wijzigingen per mail'>
                                            </form>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
        </div>
    </section>
    <?php $mysqli->close(); ?>

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

    <!-- SweetAlert Plugin Js -->
    <script src="/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="/js/admin.js"></script>
    <script src="/js/pages/forms/basic-form-elements.js"></script>
    <script src="/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Demo Js -->
    <script src="/js/demo.js"></script>
    <script type="text/javascript">
        $('input#DateTimePicker').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', minDate : new Date() });
        $(function () {
            var $time_input = $('.time_input');
            $time_input.find('.time24').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });
        });
    </script>


<script>
    function playersConnected() {
        swal({
            title: "Spelers succesvol gekoppeld",
            text: "Controleer aub op de tab instellingen en verzend eventueel een email notificatie",
            type: "success",
            timer: 4000,
            showConfirmButton: false,
        });
    }
    function EmailUpdateSend() {
        swal({
            title: "Email update verzonden",
            text: "Alle emails zijn succesvol verzonden naar de juiste spelers",
            type: "success",
            timer: 4000,
            showConfirmButton: false,
        });
    }
</script>
<?php
if(isset($_GET['playersConnected'])){
    echo '<script>playersConnected();</script>';}
if(isset($_GET['EmailUpdateSend'])){
    echo '<script>EmailUpdateSend();</script>';}
?>

</body>

</html>