
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/main1.css">
    <link rel="stylesheet" href="./assets/css/float_style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main1.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="./js/main.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.concat.min.js'></script>

<style>
    .them {
        width: 100%;
    }

    .ds {
        margin-bottom: 20px;
    }

    .ds table {
        border: 1px solid gray;
    }

    .ds table th {
        width: 100px;
        border-bottom: 1px solid gray;
    }

    .ds table td {
        border-right: 1px solid gray;
        border-bottom: 1px solid gray;
        padding-left: 10px;
        font-size: 1.4rem;
        font-weight: 400;
    }

    .ds table th {
        border-right: 1px solid gray;
        border-bottom: 1px solid gray;
        padding-left: 10px;
        font-size: 1.4rem;
        font-weight: 600;
        width: 400px;
        background-color: #29d7ef;
    }
</style>
<script src="./js/hed.js"></script>
</head>

<body>

<div class="ds">
        <table>
            <tr height="50px">
                <th>Mã phiếu xuất</th>>
                <th>Tên lô nhập</th>
                <!-- <th>Giá cũ</th> -->
                <th>Đơn sản phẩm</th>
                <th>Đơn vị tính</th>
                <th>Số lượng xuất</th>
                <th>Giá sản phẩm</th>
                <th>Ghi chú</th>
                <th>Xoá</th>
                <th>Sửa</th>
            </tr>
    <?php
        require "connect.php";
        
            $sql3 = "SELECT a.maPX, a.ngayxuat, d.soluongxuat, b.tenNV, c.tenNCC, e.tenSP, f.tenLN, i.tenDVT, d.ghichu, e.giaSP
            FROM `phieuxuat` a 
            inner join nhanvien b on a.maNV = b.maNV
            inner join nhacungcap c on a.maNCC = c.maNCC
            inner join chitietphieuxuat  d on a.maPX = d.maPX
            inner join sanpham e on d.maSP = e.maSP
            inner join lonhap f on d.maLN = f.maLN
            inner join donvitinh i on e.maDVT = i.maDVT";
            if ($result3 = $con->query($sql3)) {
                if ($result3->num_rows > 0) {
                    while ($row3 = $result3->fetch_assoc()) {
                        echo ' <p style="font-size: 1.6rem; font-weight: 400">Tên nhân viên xuất: ' . $row3['tenNV'] . '</p>
                                <p style="font-size: 1.6rem; font-weight: 400">Ngày xuất: ' . $row3['ngayxuat'] . '</p>
                        <tr>
                    <td>' . $row3['maPX'] . '</td>
                    <td>' . $row3['tenLN'] . '</td>
                    <td>' . $row3['tenSP'] . '</td>
                    <td>' . $row3['tenDVT'] . '</td>
                    <td>' . $row3['soluongxuat'] . '</td>
                    <td>' . $row3['giaSP'] . '</td>
                    <td>' . $row3['ghichu'] . '</td>
                    <td><a href="xoaPhieuXuat.php?maPX=' . $row3['maPX'] . '" class ="icon"><img src="../assets/img/delete.png"alt="xoa"width="20px" height="20px"></a></td>
                    <td><a href="' . $row3['maPX'] . '" class ="icon"><img src="../assets/img/update.png"alt="sua"width="20px" height="20px"></td>
                    </tr>';
                    }
                }
            }
    ?>
</table>


</div>
</body>

</html>