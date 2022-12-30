<?php
session_start();
if (empty($_SESSION['username'])) {
    header('location:../index.php');
} else {
    include "../conn.php";
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Perpus SMK BPP</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Hakko Bio Richard">
        <meta name="keywords" content="Perpus, Website, Aplikasi, Perpustakaan, Online">
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="../css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="../css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <link href="../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <link href="../css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <style type="text/css">

        </style>
    </head>

    <body class="skin-black">
        <header class="header">
            <a href="index.php" class="logo">
                Perpus SMK BPP
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $_SESSION['nama']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Account</li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-user fa-fw pull-right"></i>
                                        Profile
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="../logout.php"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php
        $timeout = 10; // Set timeout minutes
        $logout_redirect_url = "../login.html"; // Set logout URL

        $timeout = $timeout * 60; // Converts minutes to seconds
        if (isset($_SESSION['start_time'])) {
            $elapsed_time = time() - $_SESSION['start_time'];
            if ($elapsed_time >= $timeout) {
                session_destroy();
                echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
            }
        }
        $_SESSION['start_time'] = time();
        ?>
    <?php } ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <aside class="left-side sidebar-offcanvas">
            <section class="sidebar">
                <div class="user-panel">
                    <div>
                        <center><img src="<?php echo $_SESSION['foto']; ?>" height="80" width="80" class="img-circle" alt="User Image" style="border: 3px solid white;" /></center>
                    </div>
                    <div class="info">
                        <center>
                            <p><?php echo $_SESSION['nama']; ?></p>
                        </center>

                    </div>
                </div>
                <?php include "menu.php"; ?>
            </section>
        </aside>

        <aside class="right-side">

            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <header class="panel-heading">
                                <b>Detail Anggota</b>

                            </header>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM data_anggota WHERE id='$_GET[kd]'");
                            $data  = mysqli_fetch_array($query);
                            ?>
                            <div class="panel-body">
                                <table id="example" class="table table-hover table-bordered">
                                    <tr>
                                        <td>ID Anggota</td>
                                        <td><?php echo $data['id']; ?></td>
                                        <td rowspan="9">
                                            <div class="pull-right image">
                                                <img src="<?php echo $data['foto']; ?>" class="img-rounded" height="300" width="250" alt="Foto Profil" style="border: 3px solid #333333;" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="250">No Induk</td>
                                        <td width="550"><?php echo $data['no_induk']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td><?php echo $data['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td><?php echo $data['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td><?php echo $data['password']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td><?php echo $data['jk']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td><?php echo $data['kelas']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tempat dan Tanggal Lahir</td>
                                        <td><?php echo $data['ttl']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><?php echo $data['alamat']; ?></td>
                                    </tr>
                                </table>

                                <div class="text-right">
                                    <a class="btn btn-sm btn-primary" data-placement="bottom" data-toggle="tooltip" title="Edit Profil" href="edit-anggota.php?hal=edit&kd=<?php echo $data['id']; ?>"> Edit <span class="glyphicon glyphicon-edit"></span></a>
                                    <a data-placement="bottom" data-toggle="tooltip" title="Kembali" href="index.php" class="btn btn-sm btn-danger"> Kembali <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="footer-main">
                Copyright Perpus SMK BPP 2022
            </div>
        </aside>

    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="../js/jquery.min.js" type="text/javascript"></script>

    <script src="../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>

    <script src="../js/bootstrap.min.js" type="text/javascript"></script>

    <script src="../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

    <script src="../js/plugins/chart.js" type="text/javascript"></script>

    <script src="../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

    <script src="../js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>

    <script src="../js/Director/app.js" type="text/javascript"></script>

    <script src="../js/Director/dashboard.js" type="text/javascript"></script>

    <script type="text/javascript">
        $('input').on('ifChecked', function(event) {
            $(this).parents('li').addClass("task-done");
            console.log('ok');
        });
        $('input').on('ifUnchecked', function(event) {
            $(this).parents('li').removeClass("task-done");
            console.log('not');
        });
    </script>
    <script>
        $('#noti-box').slimScroll({
            height: '400px',
            size: '5px',
            BorderRadius: '5px'
        });

        $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
            checkboxClass: 'icheckbox_flat-grey',
            radioClass: 'iradio_flat-grey'
        });
    </script>
    <script type="text/javascript">
        $(function() {
            "use strict";
            //BAR CHART
            var data = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                        label: "My First dataset",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };
            new Chart(document.getElementById("linechart").getContext("2d")).Line(data, {
                responsive: true,
                maintainAspectRatio: false,
            });

        });
    </script>
    </body>

    </html>