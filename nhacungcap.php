<?php
   if(isset($_POST['submit']))
   {
       $ten =$_POST["tenNCC"];
       $sdt =$_POST["sdtNCC"];
       $diachi =$_POST["diachiNCC"];
     
        $sql = "INSERT INTO `nhacungcap` ( `tenNCC`,`sdtNCC`,`diachiNCC`, `isdelete`) 
                            VALUES ( '$ten','$sdt','$diachi', 1)";             
        if ($con->query($sql))
        {
            echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="./index.php?id=ncc" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Thành Công!</strong> nhà cung cấp đã được thêm.
            </div>';
        }
        else {
            echo '<div class="alert alert-danger">
                <a href="./index.php?id=ncc" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Lỗi!</strong> Thêm nhà cung cấp thất bại.
            </div>';     
        }
    }
    if(isset($_GET['deleteid']) ) {
        $deleteid =  $_GET['deleteid'];
        if(check($_GET['deleteid'],$con)) {
            $sqldelete = "UPDATE `nhacungcap` SET isdelete = 0 WHERE maNCC = $deleteid";
            if ($con->query($sqldelete))
            {
                echo '<div class="alert alert-success alert-dismissible fade in">
                        <a href="./index.php?id=ncc" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Thành Công!</strong> Xóa nhà cung cấp.
                    </div>';
            }
            else {
                echo '<div class="alert alert-danger">
                        <a href="./index.php?id=ncc" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Lỗi!</strong> Xóa nhà cung cấp thất bại.
                    </div>';     
            }
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=ncc" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Xóa nhà cung cấp thất bại. Do không tìm được nhà cung cấp 
                  </div>';     
          }
    }
    if(isset($_POST['submitupdate']) ) {
        $updateid =  $_GET['updateid'];
        $ten =$_POST["tenNCC"];
        $sdt =$_POST["sdtNCC"];
        $diachi =$_POST["diachiNCC"];
        if(check($_GET['updateid'],$con)) {
            $sqlupdate = "UPDATE `nhacungcap` SET tenNCC = '$ten', sdtNCC = '$sdt', diachiNCC = '$diachi'  WHERE maNCC = $updateid AND isdelete = 1";
            if ($con->query($sqlupdate))
            {
                echo '<div class="alert alert-success alert-dismissible fade in">
                        <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Thành Công!</strong> Cập nhật nhà cung cấp.
                    </div>';
            }
            else {
                echo '<div class="alert alert-danger">
                        <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Lỗi!</strong> Cập nhật nhà cung cấp thất bại.
                    </div>';     
            }
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Cập nhật nhà cung cấp thất bại. Do không tìm được nhà cung cấp 
                  </div>';     
          }
          $_GET['updateid'] = null;
    }
    function check($id, $con) {
        $sqlcheck = "SELECT maNCC FROM `nhacungcap` WHERE maNCC = $id and isdelete = 1";
        if ($resultcheck = $con->query($sqlcheck)) {
            if ($resultcheck->num_rows > 0) {
                return true;
            }
        } 
        return false;
    } 

?>
<html>
    <head><meta charset="UTF-8">
    <link rel="stylesheet" href="./css/price.css">
    </head>
<body>
    <button id="myBtn"  class="btn btn-primary">Thêm Nhà cung cấp</button>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close">&times;</span>
            <h3>Thêm nhà cung cấp</h3>
            
            <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <label> Tên nhà cung cấp:</label>
                <input type="text" class="form-control" name="tenNCC" required>

                <label> SĐT nhà cung cấp:</label>
                <input type="text" class="form-control" name="sdtNCC" required>

                <label> Địa chỉ nhà cung cấp:</label>
                <input type="text" class="form-control" name="diachiNCC" required>

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
            <a href="./index.php?id=ncc" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <h3>Sửa loại cho sản phẩm</h3>
            
            <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <label>Tên loại sản phẩm</label> 
                <?php
                    $idshow = $_GET['updateid'];
                    $sqlshow = "SELECT a.tenNCC, a.sdtNCC, a.diachiNCC FROM `nhacungcap` a WHERE maNCC = $idshow ";
                    if ($resultshow = $con->query($sqlshow)) {
                        if ($resultshow->num_rows > 0) {
                            while ($rowshow = $resultshow->fetch_assoc()) {
                                echo '<label> Tên nhà cung cấp:</label>
                                <input type="text" class="form-control" name="tenNCC" value ="'.$rowshow['tenNCC'].'" required>
                
                                <label> SĐT nhà cung cấp:</label>
                                <input type="text" class="form-control" name="sdtNCC" value ="'.$rowshow['sdtNCC'].'" required>
                
                                <label> Địa chỉ nhà cung cấp:</label>
                                <input type="text" class="form-control" name="diachiNCC" value ="'.$rowshow['diachiNCC'].'" required>';
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
    <h2>Danh sách nhà cung cấp</h2>   
    <hr> 
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr height="50px">
                    <th>Tên nhà cung cấp </th> 
                    <th>Số điện thoại </th> 
                    <th>Địa chỉ </th> 
                    <th>Xóa</th>
                    <th>Sữa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql2="SELECT * FROM `nhacungcap` WHERE isdelete = 1";
                    if ($result2=$con->query($sql2))
                    {
                    if($result2->num_rows>0)
                    {
                        while($row2 = $result2->fetch_assoc())
                        {
                        
                            echo '<tr>
                            <td>'.$row2['tenNCC'].'</td>
                            <td>'.$row2['sdtNCC'].'</td>
                            <td>'.$row2['diachiNCC'].'</td>
                        
                            <td><a href="?id=ncc&deleteid='.$row2['maNCC'].'"class="icon"><span style="color:red" class="glyphicon glyphicon-trash"></span></a></td>
                            <td><a href="?id=ncc&updateid=' . $row2['maNCC'] . '" class ="icon"><span style="color:red" class="glyphicon glyphicon-pencil"></span></td>
                            </tr>';
                        
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
