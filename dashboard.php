<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>QLHS | Bảng điều khiển</title>
        <link rel="stylesheet" href="front-end/css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="front-end/css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="front-end/css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="front-end/css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="front-end/css/toastr/toastr.min.css" media="screen">
        <link rel="stylesheet" href="front-end/css/icheck/skins/line/blue.css">
        <link rel="stylesheet" href="front-end/css/icheck/skins/line/red.css">
        <link rel="stylesheet" href="front-end/css/icheck/skins/line/green.css">
        <link rel="stylesheet" href="front-end/css/main.css" media="screen">
        <script src="front-end/js/modernizr/modernizr.min.js"></script>
    </head>

    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <?php include('includes/topbar.php'); ?>
            <div class="content-wrapper">
                <div class="content-container">

                    <?php include('includes/leftbar.php'); ?>

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Bảng điều khiển</h2>

                                </div>
                                <!-- /.col-sm-6 -->
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat bg-primary" href="manage-students.php">
                                            <?php
                                            $sql1 = "SELECT StudentId from students ";
                                            $query1 = $dbh->prepare($sql1);
                                            $query1->execute();
                                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                            $totalstudents = $query1->rowCount();
                                            ?>

                                            <span class="number counter"><?php echo htmlentities($totalstudents); ?></span>
                                            <span class="name">Đã đăng kí tài khoản</span>
                                            <span class="bg-icon"><i class="fa fa-users"></i></span>
                                        </a>
                                        <!-- /.dashboard-stat -->
                                    </div>
                                    <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat bg-danger" href="manage-subjects.php">
                                            <?php
                                            $sql = "SELECT id from  subjects ";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $totalsubjects = $query->rowCount();
                                            ?>
                                            <span class="number counter"><?php echo htmlentities($totalsubjects); ?></span>
                                            <span class="name">Môn học</span>
                                            <span class="bg-icon"><i class="fa fa-ticket"></i></span>
                                        </a>
                                        <!-- /.dashboard-stat -->
                                    </div>
                                    <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top:1%;">
                                        <a class="dashboard-stat bg-warning" href="manage-classes.php">
                                            <?php
                                            $sql2 = "SELECT DISTINCT(ClassName) from  classes ";
                                            $query2 = $dbh->prepare($sql2);
                                            $query2->execute();
                                            $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                            $totalclasses = $query2->rowCount();
                                            ?>
                                            <span class="number counter"><?php echo htmlentities($totalclasses); ?></span>
                                            <span class="name">Lớp học</span>
                                            <span class="bg-icon"><i class="fa fa-bank"></i></span>
                                        </a>
                                        <!-- /.dashboard-stat -->
                                    </div>
                                    <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top:1%">
                                        <a class="dashboard-stat bg-success" href="manage-results.php">
                                            <?php
                                            $sql3 = "SELECT  distinct StudentId from  result ";
                                            $query3 = $dbh->prepare($sql3);
                                            $query3->execute();
                                            $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                                            $totalresults = $query3->rowCount();
                                            ?>

                                            <span class="number counter"><?php echo htmlentities($totalresults); ?></span>
                                            <span class="name">Kết quả</span>
                                            <span class="bg-icon"><i class="fa fa-file-text"></i></span>
                                        </a>
                                        <!-- /.dashboard-stat -->
                                    </div>
                                    <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->


                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Footer-->
            <footer class="py-5 bg-dark">
            </footer>
        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="front-end/js/jquery/jquery-2.2.4.min.js"></script>
        <script src="front-end/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="front-end/js/bootstrap/bootstrap.min.js"></script>
        <script src="front-end/js/pace/pace.min.js"></script>
        <script src="front-end/js/lobipanel/lobipanel.min.js"></script>
        <script src="front-end/js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="front-end/js/prism/prism.js"></script>
        <script src="front-end/js/waypoint/waypoints.min.js"></script>
        <script src="front-end/js/counterUp/jquery.counterup.min.js"></script>
        <script src="front-end/js/amcharts/amcharts.js"></script>
        <script src="front-end/js/amcharts/serial.js"></script>
        <script src="front-end/js/amcharts/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="front-end/js/amcharts/plugins/export/export.css" type="text/css" media="all" />
        <script src="front-end/js/amcharts/themes/light.js"></script>
        <script src="front-end/js/toastr/toastr.min.js"></script>
        <script src="front-end/js/icheck/icheck.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="front-end/js/main.js"></script>
        <script src="front-end/js/production-chart.js"></script>
        <script src="front-end/js/traffic-chart.js"></script>
        <script src="front-end/js/task-list.js"></script>
        <script>
            $(function() {

                // Counter for dashboard stats
                $('.counter').counterUp({
                    delay: 10,
                    time: 1000
                });

                // Welcome notification
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr["success"]("Chào mừng bạn đến với hệ thống quản lí sinh viên!");

            });
        </script>
    </body>

    </html>
<?php } ?>