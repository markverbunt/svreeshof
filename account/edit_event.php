<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');
require('helpers/check_admin.php');

$event_id=$_GET['event_id'];
$sql2 = "SELECT * FROM events WHERE event_id='$event_id' LIMIT 1";
$result = $mysqli->query($sql2);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
} else {
  header("location: /account/list_events.php?noEventsFound");
}
$category = $row['category'];
$week = $row['week'];
$event_date = $row['event_date'];
$orgDate = $row['event_date'];
$event_date_title = date("d-m-Y", strtotime($orgDate));
$info = $row['info'];
$gameinfo = $row['gameinfo'];
$location = $row['location'];
$event_status = $row['event_status'];
$email_send = $row['email_send'];

foreach($mysqli->query("SELECT COUNT(*) FROM event_bookings WHERE event_id='$event_id'") as $totals) {
    $total  = "". $totals['COUNT(*)'] ."";
}

$mysqli->close();

?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Wedstrijd / Training wijzigen</title>
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
                                <strong><?php echo $category; ?></strong> - Week: <?php echo $week; ?> - <?php echo $event_date_title; ?>
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
                                    <form action="helpers/modify_event.php" method="post">
                                        <input type='hidden' name='event_id' value="<?php echo $event_id; ?>">
                                        <div class="row clearfix">
                                            <div class="col-md-2">
                                                <b>Status *</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">subject</i>
                                                    </span>
                                                    <select class="form-control show-tick" name="event_status" required>
                                                        <option value="0" <?php if($event_status=="0") echo "selected"; ?>>Afgelast</option>
                                                        <option value="1" <?php if($event_status=="1") echo "selected"; ?>>Actief</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <b>Week *</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">calendar_today</i>
                                                    </span>
                                                    <select class="form-control show-tick" name="week" required>
                                                        <!--<option value="">-- Selecteer --</option>-->
                                                        <option value="40" <?php if($week=="40") echo "selected"; ?>>40</option>
                                                        <option value="41" <?php if($week=="41") echo "selected"; ?>>41</option>
                                                        <option value="42" <?php if($week=="42") echo "selected"; ?>>42</option>
                                                        <option value="43" <?php if($week=="43") echo "selected"; ?>>43</option>
                                                        <option value="44" <?php if($week=="44") echo "selected"; ?>>44</option>
                                                        <option value="45" <?php if($week=="45") echo "selected"; ?>>45</option>
                                                        <option value="46" <?php if($week=="46") echo "selected"; ?>>46</option>
                                                        <option value="47" <?php if($week=="47") echo "selected"; ?>>47</option>
                                                        <option value="48" <?php if($week=="48") echo "selected"; ?>>48</option>
                                                        <option value="49" <?php if($week=="49") echo "selected"; ?>>49</option>
                                                        <option value="50" <?php if($week=="50") echo "selected"; ?>>50</option>
                                                        <option value="51" <?php if($week=="51") echo "selected"; ?>>51</option>
                                                        <option value="52" <?php if($week=="52") echo "selected"; ?>>52</option>
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
                                                        <input type="text" id="DateTimePicker" class="DateTimePicker form-control" name="event_date" placeholder="Kies een datum..." value="<?php echo $event_date; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <b>Categorie *</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">subject</i>
                                                    </span>
                                                    <select class="form-control show-tick" name="category" required>
                                                        <option value="training" <?php if($category=="training") echo "selected"; ?>>Training</option>
                                                        <option value="wedstrijd" <?php if($category=="wedstrijd") echo "selected"; ?>>Wedstrijd</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <b>Wedstrijd info *</b>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">assignment</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" name="gameinfo" class="form-control" placeholder="Wedstrijd info" value="<?php echo $gameinfo; ?>" required>
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
                                                        <input type="text" name="location" class="form-control" placeholder="Locatie" value="<?php echo $location; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-12">
                                                <b>Overige informatie *</b>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <textarea rows="4" class="form-control no-resize" placeholder=" Overige informatie..." name="info" required><?php echo $info; ?></textarea>
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
                                    <form action='helpers/connect_players.php' method='post'>
                                        <input type='hidden' name='event_id' value='$event_id'>";
                                        if($category=="wedstrijd") echo "<input type='hidden' name='bookings_status' value='1'>";
                                        if($category=="training") echo "<input type='hidden' name='bookings_status' value='0'>";
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

    <!-- Demo Js -->
    <script src="/js/demo.js"></script>
    <script type="text/javascript">
        $('input#DateTimePicker').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', minDate : new Date() });
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