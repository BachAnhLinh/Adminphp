<?php
require "connect.php";
?>
<?php
$id=$_GET['id'];
$status = $_GET['status'];
$sql="UPDATE `binhluan` SET `trangthaiBL` = $status WHERE `binhluan`.`maBL` = $id";
if ($con->query($sql))
{
    header ('location:index.php?id=bl');
}
else {
    echo "Erro";
}

?>