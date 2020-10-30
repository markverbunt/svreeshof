<?php
require('helpers/session.php');
require_once('helpers/global_vars.php');
require('helpers/check_admin.php');

$sql = "SELECT * FROM users ORDER BY finance DESC";
$result = $mysqli->query($sql);

foreach($mysqli->query("SELECT SUM(finance) FROM users") as $TotalPaidFinance) {
    $TotalPaid  = "". $TotalPaidFinance['SUM(finance)'] ."";
}

?>
<!DOCTYPE html>
<html lang="nl-NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Finance</title>
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
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>Financieel overzicht</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="finance-table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Voornaam</th>
                                            <th>Achternaam</th>
                                            <th>Email</th>
                                            <th>Openstaand bedrag</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            $firstname = $row['firstname'];
                                            $lastname = $row['lastname'];
                                            $email = $row['email'];
                                            $finance = $row['finance'];
                                            $financeBar = $finance*2;
                                            echo "<tr>";
                                                echo "<td>$firstname</td>";
                                                echo "<td>$lastname</td>";
                                                echo "<td><a href='mailto:$email'>$email</a></td>";
                                                if($finance>"25") {echo "
                                                <td><div class='progress'>
                                                        <div class='progress-bar bg-red' role='progressbar' aria-valuenow='$finance' aria-valuemin='0' aria-valuemax='50' style='width: $financeBar%'>&euro; $finance</div>
                                                    </div>
                                                </td>";
                                                }
                                                else if($finance=="0") {echo "
                                                <td><div class='progress'>
                                                        <div class='progress-bar bg-green' role='progressbar' aria-valuenow='$finance' aria-valuemin='0' aria-valuemax='50' style='width: 100%'>&euro; $finance</div>
                                                    </div>
                                                </td>";
                                                }
                                                else {echo"
                                                <td><div class='progress'>
                                                        <div class='progress-bar bg-green' role='progressbar' aria-valuenow='$finance' aria-valuemin='0' aria-valuemax='50' style='width: $financeBar%'>&euro; $finance</div>
                                                    </div>
                                                </td>";
                                                }
                                                echo "<td><a href='/account/edit_user.php?id=$id'><i class='material-icons'>create</i></a></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                      echo "Geen data gevonden";
                                    }                                   
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
                            <h2>Totaal openstaand/betaald</h2>
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="dashboard-donut-chart"></div>
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
        $(function () {
            initDonutChart();
        });
        function initDonutChart() {
            Morris.Donut({
                element: 'donut_chart',
                data: [{
                    label: 'Openstaand',
                    value: <?php echo $TotalPaid;?>
                }, {
                    label: 'Betaald',
                    value: <?php echo 1150-$TotalPaid;?>
                }],
                colors: ['rgb(244, 67, 53)', 'rgb(76, 175, 80)'],
                formatter: function (y) {
                    return y + '€'
                }
            });
        }
    </script>
</body>

</html>