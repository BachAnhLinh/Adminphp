<?php
require "connect.php";
?>
<?php
$id=$_GET['id'];
$sql="UPDATE `nhanvien` SET `tinhtrangVN` = 'Ngưng hoạt động' WHERE `nhanvien`.`maNV` = $id";
if ($con->query($sql))
{
    header ('location:index.php?id=nv');
}
else {
    echo "Erro";
}

?>