<?php
   if(isset($_POST['submit']))
   {
       $ten=$_POST["ten"];
       $mail = $_POST["mail"];
       $mk = $_POST["mk"];
       $cv = $_POST["cv"];
       $sdt = $_POST["sdt"];
       $dc=$_POST["dc"];
       $status = 0;
        if($cv == "Admin") {
            $status = 1;
        }
        $sql = "INSERT INTO `nhanvien` ( `tenNV`, `chucvuNV`, `diachiNV`, `sdtNV`, `emailNV`, `password`, `tinhtrangVN`,`Status`) 
        VALUES ('$ten', '$cv', '$dc', '$sdt', '$mail', '$mk', 'Hoạt động', $status);";
        if ($con->query($sql))
        {
            echo '<div class="alert alert-success alert-dismissible fade in">
                    <a href="/adminphp/index.php?id=nv" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Thành Công!</strong> Nhân viên đã được thêm.
                </div>';
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="/adminphp/index.php?id=nv" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Thêm nhân viên thất bại.
                </div>';     
        }
    }
?>
<html>
<head><meta charset="UTF-8">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/price.css">
    <script src="./js/hed.js"></script>
</head>
<body>
    <button id="myBtn" class="btn btn-primary">Thêm nhân viên</button>
    <div id="myModal" class="modal">
    <!-- Modal content -->
        <div class="modal-content">
            <span class="close" id="close">&times;</span>
            <h3>Thêm nhân viên</h3>
            <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <label> Tên nhân viên:</label>
                <input type="text" class="form-control" name="ten" required>

                <label> Email nhân viên:</label>
                <input type="mail" class="form-control" name="mail" required>

                <label> Mật khẩu:</label>
                <input type="password" class="form-control" name="mk" required>

                <label> Chức vụ:</label>
                <select name="cv" class="form-control" required>
                    <option value="">--vui lòng chọn sản phẩm---</option>
                    <option value="Nhân viên quản lý">Nhân viên quản lý</option>
                    <option value="Nhân viên bán hàng">Nhân viên bán hàng</option>
                    <option value="Admin">Admin</option>
                </select>
                <label> Số điện thoại:</label>
                <input type="text" class="form-control" name="sdt" required>

                <label> Địa chỉ:</label>
                <input type="text" class="form-control" name="dc" required>
                
                <br>
                <input class="btn btn-primary" type="submit" name="submit" value="Lưu"/>
            </form>
        </div>
    </div>   
    <h2> Danh sách nhân viên </h2>
    <hr>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr height="50px"; weight="1000px">
                    <th>Tên Nhân Viên</th> 
                    <th>Email</th>
                    <th>Chức Vụ</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Tình trạng</th>
                    <th>Cập nhật</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql2="SELECT * FROM nhanvien order by maNV desc";
                if ($result2=$con->query($sql2))
                {
                if($result2->num_rows>0)
                {
                    while($row2 = $result2->fetch_assoc())
                    {
                        echo '<tr>
                        <td>'.$row2['tenNV'].'</td>
                        <td>'.$row2['emailNV'].'</td>
                        <td>'.$row2['chucvuNV'].'</td>
                        <td>'.$row2['sdtNV'].'</td>
                        <td>'.$row2['diachiNV'].'</td>
                        <td>'.$row2['tinhtrangVN'].'</td>';
                        if($row2['tinhtrangVN'] == 'Ngưng hoạt động') {
                            echo '<td><a style="color: #29d7ef; font-weight: 600"; href="Kichhoat.php?id='.$row2['maNV'].'">Kích hoạt</a></td>';
                        } else {
                            echo '<td><a style="color: red; font-weight: 600"; href="vohieuhoa.php?id='.$row2['maNV'].'">Vô hiện hóa</a></td>';
                        }
                        echo '</tr>';
                        }
                    }
                }
            ?>
            </tbody>
        </table>    
    </div>
</body>
<script>
// Get the modal
var modal = document.getElementById("myModal");
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementById("close");

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
