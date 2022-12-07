<?php
 require "connect.php";
$mail = $_GET['nv'];
$hd = $_GET['dh'];
$sql="UPDATE `donhang` SET `trangthaiDH` = '1' , 
    `maNV` = (SELECT maNV FROM `nhanvien` WHERE `emailNV` = '$mail' AND `tinhtrangVN`='Hoạt động' LIMIT 1) 
    WHERE `donhang`.`maDH` = $hd";
if ($con->query($sql))
{
    header ('location:index.php?id=dh');
}
else {
  header ('location:index.php?id=dh');
  echo '<div class="alert alert-danger">
          <a href="./index.php?id=tdh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Lỗi!</strong> Tạo đơn hàng thất bại. 
      </div>';  
}
?>