<?php
require "connect.php";
$keywork=$_GET['keywork'];
$sql="SELECT tenKH, maKH, sdtKH FROM khachhan WHERE sdtKH LIKE '%$keywork%'";
class getcustomer {
    function getcustomer ($tenKH,$maKH,$sdtKH)
    {
        $this->tenKH=$tenKH;
        $this->maKH=$maKH;
        $this->sdtKH=$sdtKH;
    }
}
$mangtn= array();
if ($result=$con->query($sql))
{
    if($result->num_rows>0)
    {
        while ($row= $result->fetch_assoc()) {
            array_push($mangtn, 
				new getcustomer($row['tenKH'],$row['maKH'],
				$row['sdtKH']
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