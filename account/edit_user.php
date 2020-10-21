<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');
require('helpers/check_admin.php');

$id=$_GET['id'];
$sql2 = "SELECT * FROM users WHERE id='$id' LIMIT 1";
$result = $mysqli->query($sql2);

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
} else {
  echo "Geen gebruiker gevonden";
}

$username = $row['username'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$email = $row['email'];
$role = $row['role'];
$finance = $row['finance'];
$user_status = $row['user_status'];

$mysqli->close();

?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Gebruiker wijzigen</title>
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

    <section class="content">
        <div class="container-fluid">

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Wijzig <?php echo $firstname; ?> <?php echo $lastname; ?>
                                <small>Pas alles aan en vergeet niet op te slaan</small>
                            </h2>
                        </div>
                        <div class="body">
                            <form action="helpers/modify_user.php" method="post">
                                <input type='hidden' name='id' value="<?php echo $id; ?>">
                                <div class="row clearfix">
                                    <div class="col-md-3">
                                        <b>Status *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">subject</i>
                                            </span>
                                            <select class="form-control show-tick" name="user_status" required>
                                                <option value="0" <?php if($user_status=="0") echo "selected"; ?>>Niet actief</option>
                                                <option value="1" <?php if($user_status=="1") echo "selected"; ?>>Actief</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Rol *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">subject</i>
                                            </span>
                                            <select class="form-control show-tick" name="role" required>
                                                <option value="0" <?php if($role=="0") echo "selected"; ?>>Gebruiker</option>
                                                <option value="1" <?php if($role=="1") echo "selected"; ?>>Beheerder</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Gebruikersnaam *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="username" class="form-control" placeholder="Gebruikersnaam" value="<?php echo $username; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Openstaand bedrag *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">euro_symbol</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="finance" class="form-control" placeholder="Openstaand bedrag" value="<?php echo $finance; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <b>Voornaam *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="firstname" class="form-control" placeholder="Voornaam" value="<?php echo $firstname; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Achternaam *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="lastname" class="form-control" placeholder="Achternaam" value="<?php echo $lastname; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Email *</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="email" name="email"class="form-control" placeholder="Email" value="<?php echo $email; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="WIJZIG">
                            </form>

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