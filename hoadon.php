<?php
require "connect.php";
$keywork=$_GET['id'];
$sql1="SELECT dh.maDH, dh.trangthaiDH, kh.tenKH, kh.sdtKH,dh.phiship, dh.date, dh.maGH, diachi.address FROM `donhang` dh 
       INNER JOIN khachhan kh on kh.maKH = dh.maKH 
       LEFT JOIN diachi on dh.maDC = diachi.id
       WHERE maDH = $keywork";
class hoadon {
    function hoadon ($maDH,$date,$ship, $detail, $tenKH, $diachi,$sdtKH)
    {
        $this->maDH=$maDH;
        $this->date=$date;
        $this->ship=$ship;
        $this->sdtKH=$sdtKH;
        $this->diachi=$diachi;
        $this->tenKH=$tenKH;
        $this->detail=$detail;
    }
}
$mangtn= array();
if ($result=$con->query($sql1))
{
    if($result->num_rows>0)
    {
        while ($row= $result->fetch_assoc()) {
            $maDH = $row['maDH'];
            $sql2="SELECT ct.soluong, sp.tenSP, g.price FROM chitietdonhang ct 
            INNER JOIN sanpham sp  on ct.maSP = sp.maSP
            INNER JOIN giasanpham g on ct.idprice = g.idprice
            WHERE ct.HD = $maDH";
            if ($result1=$con->query($sql2))
            {
                if($result1->num_rows>0)
                {
                    $detail = [];
                    while ($row1= $result1->fetch_assoc()) {
                        array_push($detail, $row1);
                    }
                    array_push($mangtn, 
                        new hoadon($maDH,$row['date'],$row['phiship'],
                        $detail,$row['tenKH'],$row['address'],$row['sdtKH']
                        
                    ));
                }
            }
        }
        echo json_encode($mangtn);
    } else {
        echo "";
    }
} else {
    echo "Lỗi! Không thể kết nối cơ sở dữ liệu";
}
?> 