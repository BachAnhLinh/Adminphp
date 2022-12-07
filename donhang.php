<html>
    <head><meta charset="UTF-8">
    <link rel="stylesheet" href="./css/price.css">
    <script src="./js/create_order.js"></script>
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
            font-weight: 400;
            height: 35px;
        }
        .ds table th
        {
            border-right:1px solid gray ;
            border-bottom: 1px solid gray;
            padding-left:10px;
            font-size: 1.4rem;
            font-weight: 600;
            background-color: #29d7ef;
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
    <a href="/adminphp/index.php?id=tdh"><button id="myBtn"  class="btn btn-primary">Tạo đơn hàng</button></a>
    <h2>Quản lý đơn hàng</h2>
    <?php
    $user = $_SESSION['username'];
       $sql1="SELECT dh.maDH, dh.trangthaiDH,dh.phiship, kh.tenKH, nv.tenNV, dh.date, dh.maGH FROM `donhang` dh 
       INNER JOIN khachhan kh on kh.maKH = dh.maKH 
       LEFT JOIN nhanvien nv on nv.maNV = dh.maNV";
    if ($result=$con->query($sql1))
    {
        if($result->num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                $kh=$row['tenKH'];
                $maDH=$row['maDH'];
                $maGH=$row['maGH'];
                $date=$row['date'];
                $nv=$row['tenNV'];
                $tinhtrang=$row['trangthaiDH'];
                echo' <div class="container">
                        <table class="table table-striped">
                            <thead id="navbar">
                            <hr>
                            <p style="font-size: 2rem; font-weight: 700;">Tên Khách Hàng : '.$kh.'</p>
                                <tr height="50px">
                                    <th>STT</th>
                                    <th style="width: 500px;">Sản phẩm </th>
                                    <th>Số Lượng</th>
                                    <th>Đơn giá</th>
                                </tr>
                            </thead>
                            <tbody>';
                $sql2="SELECT ct.soluong, sp.tenSP, g.price FROM chitietdonhang ct 
                        INNER JOIN sanpham sp  on ct.maSP = sp.maSP
                        INNER JOIN giasanpham g on ct.idprice = g.idprice
                        WHERE ct.HD = $maDH";
                $sum = 0;
                    if ($result2=$con->query($sql2))
                    {
                        if($result2->num_rows>0)
                        {
                            $stt = 1;
                            while($row2 = $result2->fetch_assoc())
                            {
                                $sum += $row2['soluong'] * $row2['price']; 
                                
                                echo '<tr>
                                        <td>'.$stt.'</td>
                                        <td style="width: 500px;">'.$row2['tenSP'].'</td>
                                        <td>'.$row2['soluong'].'</td>
                                        <td>'.$row2['price'].'</td>
                                                
                                    </tr>';
                                $stt = $stt + 1;
                                }
                            }
                        echo"</tbody>
                        </table>";
                            echo "<div style='float:right;'>";
                            $money = number_format($sum, 0, ',', '.');
                            echo "<span style='font-weight:700'>Tổng tiền:</span> ".$money." VNĐ<br>";
                            echo "<span style='font-weight:700'>Phí ship:</span> ".number_format((float)$row['phiship']*1000,0, ',', '.')." VNĐ<br>";
                            echo "<span style='font-weight:700'>Tổng tất cả:</span> ".number_format((float)$row['phiship']*1000 + $sum,0, ',', '.')." VNĐ<br>";
                            echo "</div>";
                            echo '<button id="myBtn" onclick="show('.$maDH.')" class="btn btn-primary" style="margin-right:10px;">Xuất hóa đơn</button>';  
                            if($tinhtrang != 0 && $tinhtrang != -1) {
                                echo"<button class='btn btn-success' disabled>Mua tại của hàng, Nhân viên tạo đơn: ".$nv."</button> <br>";
                                echo '<div style="text-align:right">';
                                echo'<br> <span style="font-weight:bold;"> Ngày tạo đơn:</span> <span style="color:green; font-weight:bold;">'.$date.'</span>';
                                echo'</div>';
                            }
                            
                            else if($tinhtrang == -1) {
                                echo '<a href="https://5sao.ghn.dev/order"><button id="myBtn"  class="btn btn-danger">Đơn hàng đã huỷ</button></a>';  
                                echo '<div style="text-align:right">';
                                echo'<br> <span style="font-weight:bold;"> Mã tra cứu đơn hàng:</span> <span style="color:green; font-weight:bold;">'.$maGH.'</span>';
                                echo'<br> <span style="font-weight:bold;"> Ngày tạo đơn:</span> <span style="color:green; font-weight:bold;">'.$date.'</span>';
                                echo'</div>';
                            }
                             else {
                                echo '<a href="https://5sao.ghn.dev/order"><button id="myBtn"  class="btn btn-info">Xem chi tiết đơn hàng</button></a>';  
                                echo '<div style="text-align:right">';
                                echo'<br> <span style="font-weight:bold;"> Mã tra cứu đơn hàng:</span> <span style="color:green; font-weight:bold;">'.$maGH.'</span>';
                                echo'<br> <span style="font-weight:bold;"> Ngày tạo đơn:</span> <span style="color:green; font-weight:bold;">'.$date.'</span>';
                                echo'</div>';
                            }
                        }
                    }
                }
            }
            
        
        ?>   
        </div>
        <div id="myModal" class="modal" >
            <div class="modal-content" id="" style="background-color: #e8bac0;">
                <a href="./index.php?id=dh" onclick="close()" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <div class="row">
                    <div class="col-xs-6" style="width: 100%">
                        <p class="ok-Wdg UPenfA RVfbug"
                            style=" font-size: 24.9638px; color: rgb(30, 50, 86); line-height: 34px; letter-spacing: 0.05em; --para-spacing:0; text-transform: uppercase; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                            <span class="S1PPyQ"
                                style="font-weight: 600; font-style: normal; color: black; text-decoration: none;">YD-SHOP</span>
                        </p>
                        <p class="ok-Wdg UPenfA RVfbug"
                            style=" font-size: 15pxpx; color: rgb(30, 50, 86); line-height: 28px; letter-spacing: 0em; --para-spacing:0;  --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                            <span class="S1PPyQ"
                                style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">96 Nguyễn Huệ, TX.Ngã năm, Tỉnh Sóc Trăng</span>
                        </p>
                    </div>
                    <div class="col-xs-6"style=" width:100%">
                        <p class="ok-Wdg OasF_A RVfbug"
                            style=" font-size: 38px; color: rgb(0, 194, 203); line-height: 53px; letter-spacing: 0em; --para-spacing:0; text-transform: uppercase; --head-indent:0; --numeric-list-marker:none; list-style-type: none; display:flex; justify-content: center">
                            <span class="S1PPyQ"
                                style="font-weight: 400; font-style: normal; color:black; text-decoration: none;">hóa
                                đơn</span>
                        </p>
                        <p class="ok-Wdg OasF_A RVfbug"
                            style=" font-size: 17.3333px; color: rgb(30, 50, 86); line-height: 24px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none; display:flex; justify-content: center">
                            <span class="S1PPyQ"
                                style="font-weight: 700; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">Mã hoá 
                                đơn: <span id="maDH"></span></span>
                        </p>
                        <p class="ok-Wdg OasF_A RVfbug"
                            style=" font-size: 17.3333px; color: rgb(30, 50, 86); line-height: 24px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none; display:flex; justify-content: center">
                            <span class="S1PPyQ"
                                style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">Ngày: 
                                <span id="date"></span></span>
                        </p>
                    </div>
                    <div class="row" style="width: 100%;padding-left: 20px;">
                        <table class="b81PtQ lZ-0JQ" style="--table-cell-scale:1; width: 100%;">
                            <thead>
                                <tr>
                                    <td colspan="1" rowspan="1">
                                        <div class="pk-e2g" style="top: 2px; left: 0px; width: 233.619px; height: 47.7103px;">
                                            <div class="SGRppg" style="padding: 12px;">
                                                <div class="fYDM2A" style="justify-content: center;">
                                                    <div class="Op_PdA">
                                                        <div lang="vi-VN" class="_3stTEQ imh8lg">
                                                            <p class="ok-Wdg UPenfA RVfbug"
                                                                style=" font-size: 14.7075px; color: rgb(0, 0, 0); line-height: 20px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                                                <span class="S1PPyQ"
                                                                    style="font-weight: 700; font-style: normal; color: rgb(0, 0, 0); text-decoration: none;">Sản
                                                                    phẩm</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="1" rowspan="1">
                                        <div class="pk-e2g"
                                            style="transform: translate(0.618873px, 0px); top: 2px; left: 233px; width: 156.344px; height: 47.7103px;">
                                            <div class="SGRppg" style="padding: 12px;">
                                                <div class="fYDM2A" style="justify-content: center;">
                                                    <div class="Op_PdA">
                                                        <div lang="vi-VN" class="_3stTEQ imh8lg">
                                                            <p class="ok-Wdg UPenfA RVfbug"
                                                                style=" font-size: 14.7075px; color: rgb(0, 0, 0); line-height: 20px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                                                <span class="S1PPyQ"
                                                                    style="font-weight: 700; font-style: normal; color: rgb(0, 0, 0); text-decoration: none;">Số
                                                                    lượng</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="1" rowspan="1">
                                        <div class="pk-e2g"
                                            style="transform: translate(0.963008px, 0px); top: 2px; left: 389px; width: 125.596px; height: 47.7103px;">
                                            <div class="SGRppg" style="padding: 12px;">
                                                <div class="fYDM2A" style="justify-content: center;">
                                                    <div class="Op_PdA">
                                                        <div lang="vi-VN" class="_3stTEQ imh8lg">
                                                            <p class="ok-Wdg UPenfA RVfbug"
                                                                style=" font-size: 14.7075px; color: rgb(0, 0, 0); line-height: 20px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                                                <span class="S1PPyQ"
                                                                    style="font-weight: 700; font-style: normal; color: rgb(0, 0, 0); text-decoration: none;">Đơn
                                                                    giá</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="1" rowspan="1">
                                        <div class="pk-e2g"
                                            style="transform: translate(0.558901px, 0px); top: 2px; left: 515px; width: 119.402px; height: 47.7103px;">
                                            <div class="SGRppg" style="padding: 12px;">
                                                <div class="fYDM2A" style="justify-content: center;">
                                                    <div class="Op_PdA">
                                                        <div lang="vi-VN" class="_3stTEQ imh8lg">
                                                            <p class="ok-Wdg OasF_A RVfbug"
                                                                style=" font-size: 14.7075px; color: rgb(0, 0, 0); line-height: 20px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                                                <span class="S1PPyQ"
                                                                    style="font-weight: 700; font-style: normal; color: rgb(0, 0, 0); text-decoration: none;">Thành
                                                                    tiền</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody id="detail">
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="rowInfo" style="width: 100%; display: flex">
                        <div class="row" style="width: 80%; padding-left: 16px;" >
                            
                            <div class="col-xs-6" style="width: 100%;">
                                <p class="ok-Wdg UPenfA RVfbug"
                                    style=" font-size: 16px; color: rgb(30, 50, 86); line-height: 22px; letter-spacing: 0em; --para-spacing:0; text-transform: uppercase; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                    <span class="S1PPyQ"
                                        style="font-weight: 400; font-style: normal; font-weight: 600;color: rgb(30, 50, 86); text-decoration: none;">Thông
                                        tin khách hàng</span></p>
                                <div lang="vi-VN" class="_3stTEQ imh8lg IPnEEQ" style="transform: translate(0px, -1.6px);">
                                    <p class="ok-Wdg UPenfA RVfbug"
                                        style=" font-size: 16px; color: rgb(30, 50, 86); line-height: 22px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                        <span class="S1PPyQ"
                                            style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">Tên khách hàng: <span id="tenKH"></span></span></p>
                                    <p class="ok-Wdg UPenfA RVfbug"
                                        style=" font-size: 16px; color: rgb(30, 50, 86); line-height: 22px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                        <span class="S1PPyQ"
                                            style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">
                                            Số điện thoại: <span id="sdtKH"></span></span></p>
                                    <p class="ok-Wdg UPenfA RVfbug"
                                        style=" font-size: 16px; color: rgb(30, 50, 86); line-height: 22px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                        <span class="S1PPyQ"
                                            style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">Số
                                            Đia chỉ: <span id="diachi"></span> </span></p>
                                    <p class="ok-Wdg UPenfA RVfbug"
                                        style=" font-size: 16px; color: rgb(30, 50, 86); line-height: 22px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                        <span class="S1PPyQ"
                                            style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">Hình thức thanh toán: Tiền mặt</span></p>
                                
                                </div>
                            </div>
                        </div>
                        <div class="row" style= "margin-right: -23px">
                            
                            <div class="col-xs-6" style="width: 100%">
                                <p class="ok-Wdg OasF_A RVfbug"
                                    style=" font-size: 16px; color: rgb(30, 50, 86); line-height: 22px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                    <span class="S1PPyQ"
                                        style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">Thành
                                        tiền: <span id="total"> VNĐ</span></span>
                                </p>
                                <p class="ok-Wdg OasF_A RVfbug"
                                    style=" font-size: 16px; color: rgb(30, 50, 86); line-height: 22px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                    <span class="S1PPyQ"
                                        style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">Phí
                                        ship: <span id="ship"> VNĐ</span></span>
                                </p>
                                <p class="ok-Wdg OasF_A RVfbug"
                                    style=" font-size: 16.9999px; color: rgb(30, 50, 86); line-height: 23px; letter-spacing: 0em; --para-spacing:0; text-transform: uppercase; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">
                                    <span class="S1PPyQ"
                                        style="font-weight: 400; font-style: normal;font-weight: 600; color: rgb(30, 50, 86); text-decoration: none;">Tổng
                                        TIỀN: <span id="totalall"> VNĐ</span></span></p>
                                <svg class="urh_lA" style="stroke: rgb(30, 50, 86); fill: rgb(30, 50, 86);">
                                    <g>
                                        <g class="_682gpw" style="touch-action: pan-x pan-y pinch-zoom;">
                                            <path d="M0.9999999999999432,1L187.00614167239615,1" stroke-linecap="round" stroke-width="2"
                                                fill="none" pointer-events="auto"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-primary" style="margin-left: 17px;" type="submit" name="submit" value="In"/>

                </div>
            </div>
        </div>
    </body>

    <script>
    

    // When the user clicks the button, open the modal 
     

    // When the user clicks on <span> (x), close the modal
     function close() {
        var modal = document.getElementById("myModal");
    modal.style.display = "none";
    }
</script>
</html>
