
<?php
if(isset($_POST['submitadd']))
{
    $makh =$_POST["makh"];
    $user = $_SESSION['username'];
    $number = $_POST["number"];
    if($makh == '' | $makh == null) {
      $sdt = $_POST['sdtkh'];
      $ten = $_POST['tenkh'];
      $sqlkh = "INSERT INTO `khachhan` (`maKH`, `tenKH`, `ngaysinhKH`, `gioitinhKH`, `sdtKH`, `emailKH`, `diachiKH`) 
      VALUES (NULL, '$ten', '', '', '$sdt', '', '')";
      if ($con->query($sqlkh))
      {
          $makh = $con->insert_id;
      }
    }
    $sqladd = "INSERT INTO `donhang` (`maKH`, `maNV`, `trangthaiDH`,`date`) 
    VALUES ('$makh', (SELECT maNV FROM `nhanvien` WHERE `emailNV` = '$user' AND `tinhtrangVN`='Hoạt động' LIMIT 1), '1', CURRENT_TIMESTAMP())";
    if ($con->query($sqladd))
    {
        $orderid = $con->insert_id;

        for($i = 0; $i <= $number; $i++) {
          if($_POST["soluong{$i}"] > 0) {
            $masp = $_POST["masp{$i}"];
            $price = $_POST["idprice{$i}"];
            $sl = $_POST["soluong{$i}"];
            $sqldetail = "INSERT INTO `chitietdonhang` ( `maSP`, `idprice`, `soluong`, `HD`) 
            VALUES ('$masp', '$price', '$sl', '$orderid')";
            if (!$con->query($sqldetail))
            {
                echo '<div class="alert alert-danger">
                        <a href="./index.php?id=tdh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Lỗi!</strong> Tạo đơn hàng thất bại. 
                    </div>';  
            } else {
            }
          }
        } 
        echo '<div class="alert alert-success alert-dismissible fade in">
                    <a href="./index.php?id=tdh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Thành Công!</strong> Tạo đơn hàng thành công.
                </div>';
    }
    else {
            echo '<div class="alert alert-danger">
                <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Lỗi!</strong> Thêm sản phẩm thất bại.
            </div>'; 
    }
}
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="./js/create_order.js"></script>
    <script src="./js/main.js"></script>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
    <link  href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script  src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script  src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="./css/price.css">
<style>
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #3e8e41;
}

#myInput {
  box-sizing: border-box;
  background-image: url('searchicon.png');
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 16px;
  padding: 14px 20px 12px 45px;
  border: none;
}

#myInput:focus {outline: 3px solid #ddd;}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  position: absolute;
  background-color: #f6f6f6;
  min-width: 95%;
  overflow: auto;
  z-index: 2;
}

.dropdown-contentsp {
  position: absolute;
  background-color: #f6f6f6;
  min-width: 95%;
  overflow: auto;
  z-index: 1;
}

.dropdown-content p {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  cursor: pointer;
}

.dropdown-contentsp p {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  cursor: pointer;
}
.dropdown p:hover {
  background-color: #ddd;
}

.show {display: block;}
.row-sum {
  text-align: right;
  margin-top: 100px;
}
#btnAdd button {
  margin-top: 50px;
  border-radius: 100px;
  min-width: 40px;
  font-weight:bold;
}
</style>
</head>
<body>
    <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
        <h3>Thông tin khách hàng</h3>
        <div class="row">
            <div class="col-xs-6">
                <label>Số điện thoại:</label> 
                <div id="myDropdown" class="dropdown-content">
                    <input class="form-control" type="text" id="sdtkh" name="sdtkh" onkeyup="getcustomer()" required/>
                    <div id="showphone"></div>
                </div>
                
            </div>
            <div class="col-xs-6">
                <label>Tên khách hàng:</label> 
                <input class="form-control" type="text" id="tenkh" name="tenkh" required/>
                <input type="text" name="makh" id="makh" hidden />
            </div>
        </div>
        <h3>Thông tin đơn hàng</h3>
        <div class="shownotify"></div>
        <div class="row" style="    margin-bottom: 20px;">
            <div class="col-xs-4">
                <label>Sản phẩm:</label> 
                <div id="myDropdown" class="dropdown-contentsp">
                    <input class="form-control" type="text" id="tensp0" name="tensp0" onkeyup="getproduct(0)" required/>
                    <input type="text" name="masp0" id="masp0" hidden />
                    <div id="showproduct0"></div>
                </div>
            </div>
            <div class="col-xs-4">
                <label>Giá:</label> 
                <input class="form-control" type="text" id="price0" name="price0" disabled required/>
                <input type="text" name="idprice0" id="idprice0" hidden />
            </div>
            <div class="col-xs-3">
                <label>Số lượng:</label> 
                <input id="maxsoluong0" name="maxsoluong0" type="number" hidden/>
                <input class="form-control" type="number" id="soluong0" name="soluong0" onchange="sum()" required/>
            </div>
        </div>
        <div id="addProduct">
        </div>
        <div id="btnAdd" style="text-align: center;">
          <button onclick="addForm(1)" class="btn btn-primary" id="btnAdd1">+</button>
        </div>
        <div class="row-sum">
          <input id="number" name="number" hidden/>
          <span><b>Tổng tiền:</b></span> <span id="sumprice">0</span> VNĐ <br/>
          <span><b>Tổng sản phẩm:</b></span> <span id="sumproduct">0</span> SP
        </div>
        <br>
        <div style="margin-left: 45%">
          <input class="btn btn-primary" type="submit" name="submitadd" value="Tạo đơn hàng"/>
        </div>
    </form>
</body>

</html>
