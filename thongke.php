<?php
require "connect.php";
$keywork=str_split($_GET['keywork'],4);
$month = str_replace("-","",$keywork[1]);
$year = $keywork[0];
$sql="SELECT  a.tenSP, CASE WHEN ct.soluongmua IS NULL THEN 0 ELSE ct.soluongmua END as soluong
    FROM `sanpham` a LEFT JOIN ( SELECT SUM(c.soluong) as soluongmua, c.maSP 
    FROM chitietdonhang c LEFT JOIN donhang dh ON c.HD = dh.maDH 
    WHERE MONTH(dh.date) = $month AND YEAR(dh.date) = $year GROUP BY c.maSP ) 
    ct on ct.maSP = a.maSP";
class get {
    function get($tenSP,$soluong)
    {
        $this->tenSP=$tenSP;
        $this -> soluong = $soluong;

    }
}
$mangtn= array();
if ($result=$con->query($sql))
{
    if($result->num_rows>0)
    {
        while ($row= $result->fetch_assoc()) {
            array_push($mangtn, 
				new get($row['tenSP'],$row['soluong']
            ));
        }
        echo json_encode($mangtn);
    } else {
        echo "";
    }
} else {
    echo "Lỗi! Không thể kết nối cơ sở dữ liệu";
}
?>