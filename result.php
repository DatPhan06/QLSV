<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QLHS | Kết quả</title>
    <link rel="stylesheet" href="front-end/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="front-end/css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="front-end/css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="front-end/css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="front-end/css/prism/prism.css" media="screen">
    <link rel="stylesheet" href="front-end/css/main.css" media="screen">
    <script src="front-end/js/modernizr/modernizr.min.js"></script>
</head>

<body>
    <div class="main-wrapper">
        <div class="content-wrapper">
            <div class="content-container">


                <!-- /.left-sidebar -->

                <div class="main-page">
                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-12">
                                <h2 class="title" align="center">Hệ thống quản lí sinh viên</h2>
                            </div>
                        </div>
                        <!-- /.row -->

                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->

                    <section class="section" id="exampl">
                        <div class="container-fluid">

                            <div class="row">



                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h3 align="center">Kế quả sinh viên</h3>
                                                <hr />
                                                <?php
                                                // code Student Data
                                                $rollid = $_POST['rollid'];
                                                $classid = $_POST['class'];
                                                $_SESSION['rollid'] = $rollid;
                                                $_SESSION['classid'] = $classid;
                                                $qery = "SELECT students.StudentName, students.RollId, students.RegDate, students.StudentId, students.Status, classes.ClassName, classes.Section from students join classes on classes.id= students.ClassId where students.RollId=:rollid and students.ClassId=:classid ";
                                                $stmt = $dbh->prepare($qery);
                                                $stmt->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                                $stmt->bindParam(':classid', $classid, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $resultss = $stmt->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($stmt->rowCount() > 0) {
                                                    foreach ($resultss as $row) {   ?>
                                                        <p><b>Tên đầy đủ :</b> <?php echo htmlentities($row->StudentName); ?>
                                                        </p>
                                                        <p><b>Mã số sinh viên :</b> <?php echo htmlentities($row->RollId); ?>
                                                        <p><b>Lớp:</b>
                                                            <?php echo htmlentities($row->ClassName); ?>(<?php echo htmlentities($row->Section); ?>)
                                                        <?php }

                                                        ?>
                                            </div>
                                            <div class="panel-body p-20">







                                                <table class="table table-hover table-bordered" border="1" width="100%">
                                                    <thead>
                                                        <tr style="text-align: center">
                                                            <th style="text-align: center">Stt</th>
                                                            <th style="text-align: center">Môn học</th>
                                                            <th style="text-align: center">Điểm số</th>
                                                        </tr>
                                                    </thead>




                                                    <tbody>
                                                        <?php
                                                        // Code for result

                                                        $query = "select t.StudentName,t.RollId,t.ClassId,t.marks,SubjectId, subjects.SubjectName from (select sts.StudentName,sts.RollId,sts.ClassId,tr.marks,SubjectId from students as sts join  result as tr on tr.StudentId=sts.StudentId) as t join subjects on subjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
                                                        $query = $dbh->prepare($query);
                                                        $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                                        $query->bindParam(':classid', $classid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($countrow = $query->rowCount() > 0) {
                                                            foreach ($results as $result) {

                                                        ?>

                                                                <tr>
                                                                    <th scope="row" style="text-align: center">
                                                                        <?php echo htmlentities($cnt); ?></th>
                                                                    <td style="text-align: center">
                                                                        <?php echo htmlentities($result->SubjectName); ?></td>
                                                                    <td style="text-align: center">
                                                                        <?php echo htmlentities($totalmarks = $result->marks); ?>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                                $totlcount += $totalmarks;
                                                                $cnt++;
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th scope="row" colspan="2" style="text-align: center">Tổng
                                                                    điểm</th>
                                                                <td style="text-align: center">
                                                                    <b><?php echo htmlentities($totlcount); ?></b> trên
                                                                    <b><?php echo htmlentities($outof = ($cnt - 1) * 100); ?></b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" colspan="2" style="text-align: center">
                                                                    Tỉ lệ</th>
                                                                <td style="text-align: center">
                                                                    <b><?php echo  htmlentities($totlcount * (100) / $outof); ?>
                                                                        %</b>
                                                                </td>
                                                            </tr>

                                                            <tr>

                                                                <td colspan="3" align="center"><i class="fa fa-print fa-2x" aria-hidden="true" style="cursor:pointer" OnClick="CallPrint(this.value)"></i></td>
                                                            </tr>

                                                        <?php } else { ?>
                                                            <div class="alert alert-warning left-icon-alert" role="alert">
                                                                <strong>Cảnh báo!</strong> Kết quả của bạn không được lưu.
                                                            <?php }
                                                            ?>
                                                            </div>
                                                        <?php
                                                    } else { ?>

                                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                                strong>Ôi không! </strong>
                                                            <?php
                                                            echo htmlentities("Invalid Register Number");
                                                        }
                                                            ?>
                                                            </div>



                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                    <div class="form-group">

                                        <div class="col-sm-6">
                                            <a href="index.php">Back to Home</a>
                                        </div>
                                    </div>

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

    </div>
    <!-- /.main-wrapper -->

    <!-- ========== COMMON JS FILES ========== -->
    <script src="front-end/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="front-end/js/bootstrap/bootstrap.min.js"></script>
    <script src="front-end/js/pace/pace.min.js"></script>
    <script src="front-end/js/lobipanel/lobipanel.min.js"></script>
    <script src="front-end/js/iscroll/iscroll.js"></script>

    <!-- ========== PAGE JS FILES ========== -->
    <script src="front-end/js/prism/prism.js"></script>

    <!-- ========== THEME JS ========== -->
    <script src="front-end/js/main.js"></script>
    <script>
        $(function($) {

        });


        function CallPrint(strid) {
            var prtContent = document.getElementById("exampl");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
    </script>

    </script>

    <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

    <!-- Footer-->
    <footer class="py-5 bg-dark">
    </footer>

</body>

</html>