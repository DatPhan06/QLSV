<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['update'])) {
        $classname = $_POST['classname'];
        $classnamenumeric = $_POST['classnamenumeric'];
        $section = $_POST['section'];
        $cid = intval($_GET['classid']);
        $sql = "update  classes set ClassName=:classname,ClassNameNumeric=:classnamenumeric,Section=:section where id=:cid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':classname', $classname, PDO::PARAM_STR);
        $query->bindParam(':classnamenumeric', $classnamenumeric, PDO::PARAM_STR);
        $query->bindParam(':section', $section, PDO::PARAM_STR);
        $query->bindParam(':cid', $cid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Đã cập nhật thành công";
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>QLHS Admin | Cập nhật lớp học</title>
        <link rel="stylesheet" href="front-end/css/bootstrap.css" media="screen">
        <link rel="stylesheet" href="front-end/css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="front-end/css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="front-end/css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="front-end/css/prism/prism.css" media="screen">
        <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="front-end/css/main.css" media="screen">
        <script src="front-end/js/modernizr/modernizr.min.js"></script>
    </head>

    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php'); ?>
            <!-----End Top bar>
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                    <?php include('includes/leftbar.php'); ?>
                    <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Update Department</h2>
                                </div>

                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Trang chủ</a></li>
                                        <li><a href="#">Lớp học</a></li>
                                        <li><a href="#">Quản lí lớp học</a></li>
                                        <li class="active">Cập nhật lớp học</li>
                                    </ul>
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">





                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Cập nhật thông tin lớp học </h5>
                                                </div>
                                            </div>
                                            <?php if ($msg) { ?>
                                                <div class="alert alert-success left-icon-alert" role="alert">
                                                    <strong>Tuyệt vời! </strong><?php echo htmlentities($msg); ?>
                                                </div><?php } else if ($error) { ?>
                                                <div class="alert alert-danger left-icon-alert" role="alert">
                                                    <strong>Ôi không! </strong> <?php echo htmlentities($error); ?>
                                                </div>
                                            <?php } ?>

                                            <form method="post">
                                                <?php
                                                $cid = intval($_GET['classid']);
                                                $sql = "SELECT * from classes where id=:cid";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':cid', $cid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {   ?>

                                                        <div class="form-group has-success">
                                                            <label for="success" class="control-label">Tên lớp</label>
                                                            <div class="">
                                                                <input type="text" name="classname" value="<?php echo htmlentities($result->ClassName); ?>" required="required" class="form-control" id="success">
                                                                <span class="help-block">Ví dụ: CSE, IT, MECH,...</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-success">
                                                            <label for="success" class="control-label">Năm </label>
                                                            <div class="">
                                                                <input type="number" name="classnamenumeric" value="<?php echo htmlentities($result->ClassNameNumeric); ?>" required="required" class="form-control" id="success">
                                                                <span class="help-block">Ví dụ: 1,2,3,4</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-success">
                                                            <label for="success" class="control-label">Phần</label>
                                                            <div class="">
                                                                <input type="text" name="section" value="<?php echo htmlentities($result->Section); ?>" class="form-control" required="required" id="success">
                                                                <span class="help-block">Ví dụ: A,B,C,...</span>
                                                            </div>
                                                        </div>
                                                <?php }
                                                } ?>
                                                <div class="form-group has-success">

                                                    <div class="">
                                                        <button type="submit" name="update" class="btn btn-success btn-labeled">Cập nhật<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                    </div>



                                            </form>


                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-md-8 col-md-offset-2 -->
                            </div>
                            <!-- /.row -->




                    </div>
                    <!-- /.container-fluid -->
                    </section>
                    <!-- /.section -->

                </div>
                <!-- /.main-page -->


                <!-- /.right-sidebar -->

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

        <!-- ========== THEME JS ========== -->
        <script src="front-end/js/main.js"></script>



        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>

    </html>
<?php  } ?>