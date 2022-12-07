<?php
   if(isset($_POST['submit']))
   {
        $ln =$_POST["tenlonhap"];
        $nn = $_POST["ngaynhap"];
        $tennv = $_POST["nhanvien"];
        $tensp = $_POST["sanpham"];
        $tenncc = $_POST["nhacungcap"];
        $slnhap = $_POST["soluong"];
        $gian = $_POST["gianhap"];

        $sql = "INSERT INTO `lonhap` ( `maNV`, `maNCC`, `tenLN`, `ngaynhap`, `maSP`, `soluong`, `gianhap`,`isdelete`) 
        VALUES ($tennv, $tenncc, '$ln','$nn', $tensp,$slnhap,$gian,1)";
        if ($con->query($sql))
        {
            echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="./index.php?id=ln" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Thành Công!</strong> lô nhập đã được thêm.
            </div>';
        }
        else {
            echo '<div class="alert alert-danger">
                <a href="./index.php?id=ln" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Lỗi!</strong> Thêm lô nhập thất bại.
            </div>';     
        }
    }
    if(isset($_GET['deleteid']) ) {
        $deleteid =  $_GET['deleteid'];
        if(check($_GET['deleteid'],$con)) {
            $sqldelete = "UPDATE `lonhap` SET isdelete = 0 WHERE maLN = $deleteid";
            if ($con->query($sqldelete))
            {
                echo '<div class="alert alert-success alert-dismissible fade in">
                        <a href="./index.php?id=ln" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Thành Công!</strong> Xóa lô nhập.
                    </div>';
            }
            else {
                echo '<div class="alert alert-danger">
                        <a href="./index.php?id=ln" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Lỗi!</strong> Xóa lô nhập thất bại.
                    </div>';     
            }
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=ln" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Xóa lô nhập thất bại. Do không tìm được lô nhập
                  </div>';     
          }
    }
    if(isset($_POST['submitupdate']) ) {
        $updateid =  $_GET['updateid'];
        $ln =$_POST["tenlonhap"];
        $nn = $_POST["ngaynhap"];
        $tennv = $_POST["nhanvien"];
        $tensp = $_POST["sanpham"];
        $tenncc = $_POST["nhacungcap"];
        $slnhap = $_POST["soluong"];
        $gian = $_POST["gianhap"];
        if(check($_GET['updateid'],$con)) {
            $sqlupdate = "UPDATE `lonhap` SET tenLN = '$ln', ngaynhap = '$nn', gianhap = $gian,
                            maNV = $tennv, maNCC = $tenncc, maSP = $tensp, soluong = $slnhap 
                            WHERE maLN = $updateid AND isdelete = 1";
            if ($con->query($sqlupdate))
            {
                echo '<div class="alert alert-success alert-dismissible fade in">
                        <a href="./index.php?id=ln" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Thành Công!</strong> Cập nhật lô nhập.
                    </div>';
            }
            else {
                echo '<div class="alert alert-danger">
                        <a href="./index.php?id=ln" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Lỗi!</strong> Cập nhật lô nhập thất bại.
                    </div>';     
            }
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=ln" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Cập nhật lô nhập thất bại. Do không tìm được lô nhập 
                  </div>';     
          }
          $_GET['updateid'] = null;
    }
    function check($id, $con) {
        $sqlcheck = "SELECT maLN FROM `lonhap` WHERE maLN = $id and isdelete = 1";
        if ($resultcheck = $con->query($sqlcheck)) {
            if ($resultcheck->num_rows > 0) {
                return true;
            }
        } 
        return false;
    } 

?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/price.css">
</head>

<body>
<button id="myBtn"  class="btn btn-primary">Thêm lô nhập</button>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close">&times;</span>
            <h3>Thêm lô nhập</h3>
            
            <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <label> Tên lô nhập:</label>
                <input type="text" class="form-control" name="tenlonhap" required>

                <label> Sản phẩm:</label>
               <select name="sanpham" class="form-control" required>
               <option value="">--vui lòng chọn sản phẩm---</option>>
                <?php
                    $sqlSP = 'SELECT tenSP, maSP FROM sanpham WHERE isdelete = 1';
                        if ($resultSP = $con->query($sqlSP)) {
                            if ($resultSP->num_rows > 0) {
                                while ($rowSP = $resultSP->fetch_assoc()){
                                    echo '<option value="'.$rowSP['maSP'].'">'.$rowSP['tenSP'].'</option>';
                                }   
                            }
                        }
                    ?>
                </select>                                

                <label>Ngày nhập</label>
                <input type="date" class="form-control" name="ngaynhap" required>

                <label>Số lượng nhập:</label>
                <input type="number" class="form-control" name="soluong" required>

                <label>Giá nhập:</label>
                <input type="number" class="form-control"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" 
                data-type="currency" placeholder="1,000,000.00VND" name="gianhap" required>

                <label>Nhà cung cấp:</label>
                
                <select name="nhacungcap" class="form-control" >
                    <option value="">--vui lòng chọn nhà cung cấp---</option>
                    <?php
                        $sqlNCC = 'SELECT tenNCC, maNCC FROM nhacungcap WHERE isdelete = 1';
                            if ($resultNCC = $con->query($sqlNCC)) {
                                if ($resultNCC->num_rows > 0) {
                                    while ($rowNCC = $resultNCC->fetch_assoc()){
                                        echo '<option value="'.$rowNCC['maNCC'].'">'.$rowNCC['tenNCC'].'</option>';
                                    }   
                                }
                            }
                    ?>
                </select>

                <label>Nhân viên:</label>
                <select name="nhanvien" class="form-control">
                    <option value="">--vui lòng chọn nhân vi---</option>
                    <?php
                        $sqlName = 'SELECT tenNV, maNV FROM nhanvien WHERE tinhtrangVN = "Hoạt động"';
                            if ($resultName = $con->query($sqlName)) {
                                if ($resultName->num_rows > 0) {
                                    while ($rowName = $resultName->fetch_assoc()){
                                        echo '<option value="'.$rowName['maNV'].'">'.$rowName['tenNV'].'</option>';
                                    }   
                                }
                            }
                    ?>
                </select>

                <br>
                <input class="btn btn-primary" type="submit" name="submit" value="Lưu"/>
            </form>
        </div>
    </div>  
    <?php
    if(isset($_GET['updateid']) ) {
        echo '<div id="myModalUpdate" class="modal">';
    ?>
    <!-- Modal content -->
    <div class="modal-content">
        <a href="./index.php?id=ln" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <h3>Sửa lô nhập</h3>
            
            <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <label>Tên lô nhập</label> 
                <?php
                    $idshow = $_GET['updateid'];
                    $sqlshow = "SELECT a.maLN, a.tenLN, b.maNV, c.maNCC, i.maSP, a.ngaynhap,a.soluong, a.gianhap
                    FROM `lonhap` a 
                    inner join nhanvien b on a.maNV = b.maNV
                    inner join nhacungcap c on a.maNCC = c.maNCC
                    inner join sanpham i on a.maSP = i.maSP
                    WHERE a.isdelete = 1 AND a.maLN = $idshow";
                    if ($resultshow = $con->query($sqlshow)) {
                        if ($resultshow->num_rows > 0) {
                            while ($rowshow = $resultshow->fetch_assoc()) {
                ?>
                <input type="text" class="form-control" value="<?php echo $rowshow['tenLN'] ?>" name="tenlonhap" required>

                <label> Sản phẩm:</label>
                <select name="sanpham" class="form-control" required>
                <option value="">--vui lòng chọn sản phẩm---</option>
                <?php
                    $sqlSP = 'SELECT tenSP, maSP FROM sanpham WHERE isdelete = 1';
                        if ($resultSP = $con->query($sqlSP)) {
                            if ($resultSP->num_rows > 0) {
                                while ($rowSP = $resultSP->fetch_assoc()){
                                    if($rowshow['maSP'] == $rowSP['maSP']) {
                                        echo '<option value="'.$rowSP['maSP'].'" selected>'.$rowSP['tenSP'].'</option>';
                                    } else {
                                        echo '<option value="'.$rowSP['maSP'].'">'.$rowSP['tenSP'].'</option>';
                                    }
                                    
                                }   
                            }
                        }
                    ?>
                </select>                                

                <label>Ngày nhập:</label>
                <input type="date" class="form-control" name="ngaynhap"  value="<?php echo $rowshow['ngaynhap'] ?>"  required>

                <label>Số lượng nhập:</label>
                <input type="number" class="form-control" name="soluong"  value="<?php echo $rowshow['soluong'] ?>" required>

                <label>Giá nhập:</label>
                <input type="number" class="form-control"  pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" 
                data-type="currency" placeholder="1,000,000.00VND"  value="<?php echo $rowshow['gianhap'] ?>" name="gianhap" required>

                <label>Nhà cung cấp:</label>

                <select name="nhacungcap" class="form-control" >
                    <option value="">--vui lòng chọn nhà cung cấp---</option>
                    <?php
                        $sqlNCC = 'SELECT tenNCC, maNCC FROM nhacungcap WHERE isdelete = 1';
                            if ($resultNCC = $con->query($sqlNCC)) {
                                if ($resultNCC->num_rows > 0) {
                                    while ($rowNCC = $resultNCC->fetch_assoc()){
                                        if($rowshow['maNCC'] == $rowNCC['maNCC']) {
                                            echo '<option value="'.$rowNCC['maNCC'].' "selected>'.$rowNCC['tenNCC'].'</option>';
                                        } else {
                                            echo '<option value="'.$rowNCC['maNCC'].'">'.$rowNCC['tenNCC'].'</option>';
                                        }
                                    }   
                                }
                            }
                    ?>
                </select>

                <label>Nhân viên:</label>
                <select name="nhanvien" class="form-control">
                    <option value="">--vui lòng chọn nhân viên---</option>
                    <?php
                        $sqlName = 'SELECT tenNV, maNV FROM nhanvien WHERE tinhtrangVN = "Hoạt động"';
                            if ($resultName = $con->query($sqlName)) {
                                if ($resultName->num_rows > 0) {
                                    while ($rowName = $resultName->fetch_assoc()){
                                        if($rowshow['maNV'] == $rowName['maNV']) {
                                            echo '<option value="'.$rowName['maNV'].'" selected>'.$rowName['tenNV'].'</option>';
                                        } else {
                                            echo '<option value="'.$rowName['maNV'].'">'.$rowName['tenNV'].'</option>';
                                        }
                                    }   
                                }
                            }
                    ?>
                </select>
                <?php
                            }
                        }
                    }
                ?>
                <br>
                <input class="btn btn-primary" type="submit" name="submitupdate" value="Lưu"/>
            </form>
        </div>
    <?php
    } else {
        echo '<div class="modal">';
    }
    ?>
    
    </div>
    <h2> Danh sách lô nhập </h2> 
    <hr>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr height="50px">
                    <th>Tên lô nhập</th>
                    <th style="width:200px;">Tên sản phẩm </th>
                    <th>Số lượng</th>
                    <th>Giá nhập</th>
                    <th>Ngày nhập</th>
                    <th>Nhà cung cấp</th>
                    <th>Nhân viên</th>
                    <th>Xoá</th>
                    <th>Sửa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql3 = "SELECT a.maLN, a.tenLN, b.tenNV, c.tenNCC, i.tenSP, a.ngaynhap,a.soluong, a.gianhap
                    FROM `lonhap` a 
                    inner join nhanvien b on a.maNV = b.maNV
                    inner join nhacungcap c on a.maNCC = c.maNCC
                    inner join sanpham i on a.maSP = i.maSP
                    WHERE a.isdelete = 1";
                    if ($result3 = $con->query($sql3)) {
                        if ($result3->num_rows > 0) {
                            while ($row3 = $result3->fetch_assoc()) {
                                echo '
                                <tr>
                                    <td>' . $row3['tenLN'] . '</td>
                                    <td>' . $row3['tenSP'] . '</td>
                                    <td>' . $row3['soluong'] . '</td>
                                    <td>' . $row3['gianhap'] . '</td>
                                    <td>' . $row3['ngaynhap'] . '</td>
                                    <td>' . $row3['tenNCC'] . '</td>
                                    <td>' . $row3['tenNV'] . '</td>
                                    <td><a href="?id=ln&deleteid='.$row3['maLN'].'"class="icon"><span style="color:red" class="glyphicon glyphicon-trash"></span></a></td>
                                    <td><a href="?id=ln&updateid=' . $row3['maLN'] . '" class ="icon"><span style="color:red" class="glyphicon glyphicon-pencil"></span></td>
                                </tr>';
                            }
                        }
                    }
                
                ?>
            <tbody>
        </table>
    </div>
</body>
<script>
        // Get the modal
        var modal = document.getElementById("myModal");
    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }
</script>
</html>