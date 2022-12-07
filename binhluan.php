<html>
    <head><meta charset="UTF-8">
    <style>

        .ds table
        {
            border:1px solid gray;
        }
        .ds table th
        {
            width: 100px;
            border-bottom: 1px solid gray;
        }
        .ds table td
        {
            border-right:1px solid gray ;
            border-bottom: 1px solid gray;
            padding-left:10px;
            font-size: 1.4rem;
        }
        .ds table th
        {
            border-right:1px solid gray ;
            border-bottom: 1px solid gray;
            padding-left:10px;
        }
        .ds table th a
        {
            text-decoration: none;
            color:black;
        }
        .ds table th a:hover
        {
            color:blue;
        }
        
    </style>
    </head>
    <body>
        <div class="them">
        <h2>Quản lý bình luận</h2>
<?php
    require "connect.php";
       $sql1="SELECT maKH,maBL FROM `danhgia`";
        if ($result=$con->query($sql1))
        {
         if($result->num_rows>0)
         {
            while($row = $result->fetch_assoc())
            {
                $idkh=$row['maKH'];
                $bl_id=$row['maBL'];
            
            $sql3="SELECT tenKH FROM `taikhoan` INNER JOIN `khachhan` ON `taikhoan`.`email` = `khachhan`.`emailKH` WHERE `khachhan`.`maKH` = $idkh";
            if ($result3=$con->query($sql3))
                        {
                        if($result3->num_rows>0)
                        {
                            $row3 = $result3->fetch_assoc();
                            $tenkh = $row3['tenKH'];
                            echo'<div class="ds">
                           
                            <table>
                            <hr>
                            <p>Tên Khách Hàng : '.$tenkh.'</p>
                                <tr height="50px">
                                        <th style="width: 400px;">Sản phẩm </th>
                                        <th style="width: 400px;">Nội dung</th>
                                        <th style="width: 100px;">Thời gian</th>
                                    
                                    </tr>';
                            $sql2="SELECT * FROM `danhgia`  WHERE maKH='$idkh'";
                                if ($result2=$con->query($sql2))
                                {
                                    if($result2->num_rows>0)
                                    {
                                        while($row2 = $result2->fetch_assoc())
                                        {
                                            $idsp = $row2['maSP'];
                                    $sql4="SELECT tenSP FROM `sanpham` WHERE maSP='$idsp'";
                                            if ($result4=$con->query($sql4))
                                            {
                                                if($result4->num_rows>0)
                                                {
                                                    $row4= $result4->fetch_assoc();
                                                    $tenhh=$row4['tenSP'];
                                                    echo '<tr>
                                                    <td style="width: 300px;">'.$tenhh.'</td>
                                                    <td style="width: 400px;">'.$row2['binhluan'].'</td>
                                                    <td style="width: 100px;">'.$row2['thoigian'].'</td>';
                                                   
                                                    echo '</tr>';
                                                    
                                                }   
                                            }
                                            
                                        }
                                    }
                                }
                        
                        }
                        }
                        echo"</table>";
                        
        
                       
                       
                        
                    }
                }
          
             
            }
        
        
        ?>
    
        
        
        
        <hr>
            
        </div>
    </body>

</html>
