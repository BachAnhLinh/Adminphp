<?php
require "connect.php";
$keywork=$_GET['keywork'];
$sql="SELECT a.maSP, a.tenSP, b.idprice, b.date, b.price, CASE WHEN d.soluong IS NULL THEN 0 ELSE d.soluong END AS soluong
,CASE WHEN ct.soluongmua IS NULL THEN 0 ELSE ct.soluongmua END AS soluongmua 
FROM sanpham a 
INNER JOIN giasanpham b ON a.maSP = b.maSP
LEFT JOIN (SELECT SUM(c.soluong) as soluong, c.maSP 
FROM lonhap c GROUP BY c.maSP ) d on d.maSP = a.maSP
LEFT JOIN (SELECT SUM(c.soluong) as soluongmua, c.maSP 
FROM chitietdonhang c GROUP BY c.maSP ) ct on ct.maSP = a.maSP
WHERE a.isdelete = 1 
AND b.isdelete = 1
AND a.tenSP LIKE '%$keywork%'
GROUP  By a.maSP HAVING MAX(b.date);";
class getproduct {
    function getproduct ($maSP,$tenSP,$idprice, $price,$soluong)
    {
        $this->maSP=$maSP;
        $this->tenSP=$tenSP;
        $this->idprice=$idprice;
        $this->price=$price;
        $this->soluong=$soluong;
    }
}
$mangtn= array();
if ($result=$con->query($sql))
{
    if($result->num_rows>0)
    {
        while ($row= $result->fetch_assoc()) {
            array_push($mangtn, 
				new getproduct($row['maSP'],$row['tenSP'],$row['idprice'],
				$row['price'], ($row['soluong'] - $row['soluongmua'])
            ));
        }
        echo json_encode($mangtn);
    } else {
        echo "";
    }
} else {
    //echo "Lỗi không thể truy vấn csdl";
    echo $sql;
}
?>
