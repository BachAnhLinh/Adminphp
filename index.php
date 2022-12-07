<?php
require "connect.php";
session_start();
$status = 0;
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $sql = "SELECT * FROM `nhanvien` WHERE `emailNV` = '$user' AND `tinhtrangVN`='Hoạt động' AND Status = 1";
    $re = $con->query($sql);
    if ($re->num_rows > 0) {
        $status = 1;
    }
} else {
    header('location:dn.php');
}
$tem = 'tk';
$titlePage = "Thống kê";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Quản trị</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main1.css">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        #show {
            width: 100%;
            height: 10;
            padding-right: 10px;
            color: black;
        }
        .container {
            padding: 0px!important;
            margin: 0px!important;
        }
        /* width */
        ::-webkit-scrollbar {
        width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey; 
        border-radius: 100px;
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: grey; 
        border-radius: 100px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #b30000; 
        }
        #popupImage {
            margin-top: 200px;
        }

        #cnavbar-header {
            color: white;
            font-size: 2rem;
            font-weight: 500;
        }
        body {
            position: relative;
        }
        .navbar-header {
            padding: 10px;
            width: 100%;
        }
        .navbar-brand {
            height: 0px;
        }
    </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div id="main-wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <b>Admin</b>
                </a>
                <div style="text-align: right;">
                    <span style="color: white; font-size: 1.5rem; font-weight: 400; "><?php echo "$user"; ?></span>
                </div>
            </div>
        </nav>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                <div class="scroll-sidebar" style="overflow: hidden; width: auto; height: 100%;overflow-y: scroll;">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav active">
                        <ul id="sidebarnav" class="in">
                        <li> <a class="waves-effect waves-dark" href="?id=tk" style="font-size: 1.5rem;font-weight: 500;">Thống kê</a>
                                <hr>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="?id=hh" style="font-size: 1.5rem;font-weight: 500;">Quản lý sản phẩm</a>
                                <hr>
                            </li>
                            <?php
                             if ($status == 1) {
                            echo '<li> <a class="waves-effect waves-dark" href="?id=price" style="font-size: 1.5rem;font-weight: 500;">Quản lý giá sản phẩm</a>
                                <hr>
                            </li>';
                            }
                            ?>
                            <li> <a class="waves-effect waves-dark" href="?id=nh" style="font-size: 1.5rem;font-weight: 500;">Quản lý loại sản phẩm</a>
                                <hr>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="?id=th" style="font-size: 1.5rem;font-weight: 500;">Quản lý thương hiệu</a>
                                <hr>
                            </li>

                            <!-- <li> <a class="waves-effect waves-dark"  href="?id=th" >Quản lý thương hiệu</a>
                                            <hr>
                                        </li> -->
                            <!-- <li> <a class="waves-effect waves-dark"  href="?id=nv" >Quản lý Nhân viên</a>
                                            <hr>
                                        </li> -->
                            <?php
                            if ($status == 1) {
                                echo '<li> <a class="waves-effect waves-dark" href="?id=nv" style="font-size: 1.5rem;font-weight: 500;" >Quản lý nhân Viên</a>
                                                <hr>
                                </li>';
                            }
                            ?>
                            <li> <a class="waves-effect waves-dark" href="?id=kh" style="font-size: 1.5rem;font-weight: 500;">Danh sách khách hàng</a>
                                <hr>
                            </li>
                            <?php
                            if ($status == 1) {
                            echo '<li> <a class="waves-effect waves-dark" href="?id=ncc" style="font-size: 1.5rem;font-weight: 500;">Quản lý nhà cung cấp</a>
                                <hr>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="?id=ln" style="font-size: 1.5rem;font-weight: 500;">Quản lý lô nhập</a>
                                <hr>
                            </li>';
                            }
                            ?>

                            <!-- <li> <a class="waves-effect waves-dark" href="?id=px" style="font-size: 1.5rem;font-weight: 500;">Quản lý phiếu xuất</a>
                                <hr>
                            </li> -->

                            <li> <a class="waves-effect waves-dark" href="?id=dh" style="font-size: 1.5rem;font-weight: 500;">Quản lý Đơn Hàng</a>
                                <hr>
                            <li> <a class="waves-effect waves-dark" href="?id=bl" style="font-size: 1.5rem;font-weight: 500;">Quản lý Bình Luận</a>
                                <hr>
                            <li> <a class="waves-effect waves-dark" href="dx.php" style="font-size: 1.5rem;font-weight: 500;">Đăng Xuất</a>
                                <hr>

                        </ul>
                    </nav>

        </aside>
    <?php
        if (isset($_GET["id"])) {
            $tem = $_GET["id"];
        }
        if ($tem == 'hh') {
            $titlePage ="Quản lý sản phẩm";
            
        } else if ($tem == "price") {
            $titlePage ="Quản lý giá sản phẩm";
        }
        else if ($tem == "nh") {
            $titlePage ="Quản lý loại sản phẩm";
        }
        else if ($tem == "th") {
            $titlePage ="Quản lý thương hiệu";
        }
         else if ($tem == 'ncc') {
            $titlePage ="Quản lý nhà cung cấp";
        } else if ($tem == 'ln') {
            $titlePage ="Quản lý lô nhập";
        } else if ($tem == 'px') {
        } else if ($tem == 'nv') {
            $titlePage ="Quản lý nhân viên";
        } else if ($tem == 'dh') {
            $titlePage ="Quản lý đơn hàng";
        } else if ($tem == 'bl') {
            $titlePage ="Quản lý bình luận/ đánh giá";
        }else if ($tem == 'tdh') {
            $titlePage ="Tạo đơn hàng";
        } else if ($tem == 'tk') {
            $titlePage ="Thống kê";
        } else if ($tem == 'kh') {
            $titlePage ="Quản lý khách hàng";
        }
        
    ?>
        <div class="page-wrapper" style="min-height: 580px;">
            <div class="container-fluid" style="margin-left: 20px; margin-bottom:20px;">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor"><?php echo $titlePage; ?></h3>
                        <ol class="breadcrumb">
                            <li styte="color: #29d7ef !important"  class="breadcrumb-item"><a styte="color: #29d7ef !important;font-size: 1.5rem;font-weight: 400;" href="index.php">Trang Chủ</a></li>
                            <li class="breadcrumb-item active" styte="font-size: 1.5rem; font-weight: 400;"><?php echo $titlePage; ?></li>
                        </ol>
                    </div>
                </div>
                <div id="show">
                    <?php
                    if (isset($_GET["id"])) {
                        $tem = $_GET["id"];
                    }
                    if ($tem == 'hh') {
                        $titlePage ="Quản lý sản phẩm";
                        include('them.php');
                        
                    } else if ($tem == "price") {
                        $titlePage ="Quản lý giá sản phẩm";
                        include('price.php');
                    }
                    else if ($tem == "nh") {
                        $titlePage ="Quản lý loại sản phẩm";
                        include('themloai.php');
                    } 
                    else if ($tem == "th") {
                        $titlePage ="Quản lý thương hiệu";
                        include('themth.php');
                    } 
                    else if ($tem == 'ncc') {
                        $titlePage ="Quản lý nhà cung cấp";
                        include('nhacungcap.php');
                    } else if ($tem == 'ln') {
                        $titlePage ="Quản lý lô nhập";
                        include('lonhap.php');
                    } else if ($tem == 'px') {
                        include('phieuxuat.php');
                    } else if ($tem == 'nv') {
                        $titlePage ="Quản lý nhân viên";
                        include('themnv.php');
                    } else if ($tem == 'dh') {
                        $titlePage ="Quản lý đơn hàng";
                        include('donhang.php');
                    } else if ($tem == 'bl') {
                        $titlePage ="Quản lý bình luận/ đánh giá";
                        include('binhluan.php');
                    }else if ($tem == 'tdh') {
                        $titlePage ="Tạo đơn hàng";
                        include('taodonhang.php');
                    }else if ($tem == 'tk') {
                        $titlePage ="Thống kê";
                        include('thongke.html');
                    } else if ($tem == 'kh') {
                        $titlePage ="Quản lý khách hàng";
                        include('themkh.php');
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>