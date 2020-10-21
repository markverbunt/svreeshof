<?php
require('helpers/session');
require_once('helpers/global_vars');
?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Profiel wijzigen</title>
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
    <?php include 'components/navigation-top'; ?>
    <?php include 'components/navigation-left-right'; ?>

    <section class="content">
        <div class="container-fluid">

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Wijzig je profiel gegevens
                                <small>Let op dit wordt direct aangepast</small>
                            </h2>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#profiel" data-toggle="tab">
                                        <i class="material-icons">create</i> PROFIEL
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#wachtwoord-wijzigen" data-toggle="tab">
                                        <i class="material-icons">lock</i> WACHTWOORD WIJZIGEN
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profiel">
                                    <form action="helpers/edit_profile" method="post">
                                        <input type='hidden' name='id' value='<?php echo $id; ?>'>
                                        <label for="email_address">Gebruikersnaam</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="username" class="form-control" placeholder="Gebruikersnaam" value="<?php echo $username; ?>">
                                                <span class="help-block"><?php echo $username_err; ?></span>
                                            </div>
                                        </div>
                                        <label for="email_address">Voornaam</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="firstname" class="form-control" placeholder="Voornaam" value="<?php echo $firstname; ?>">
                                                <span class="help-block"><?php echo $firstname_err; ?></span>
                                            </div>
                                        </div>
                                        <label for="email_address">Achternaam</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="lastname" class="form-control" placeholder="Achternaam" value="<?php echo $lastname; ?>">
                                                <span class="help-block"><?php echo $lastname_err; ?></span>
                                            </div>
                                        </div>
                                       <label for="email_address">Email</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" name="email"class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                                                <span class="help-block"><?php echo $email_err; ?></span>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="WIJZIG">
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="wachtwoord-wijzigen">
                                    <form action="change_password" method="post">
                                        <input type='hidden' name='id' value='<?php echo $id; ?>'>
                                        <label for="password">Password</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="password" class="form-control" minlength="6" placeholder="Wachtwoord" value="<?php echo $password; ?>">
                                                <span class="help-block"><?php echo $password_err; ?></span>
                                            </div>
                                        </div>
                                        <label for="password">Password</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="confirm_password" class="form-control" minlength="6" placeholder="Herhaal Wachtwoord" value="<?php echo $confirm_password; ?>">
                                                <span class="help-block"><?php echo $confirm_password_err; ?></span>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="WIJZIG WACHTWOORD">
                                    </form>
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