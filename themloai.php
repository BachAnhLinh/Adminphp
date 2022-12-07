<?php
   if(isset($_POST['submit']))
   {
    
       $ten =$_POST["nametype"];
        $sql = "INSERT INTO `loaisanpham` ( `tenloaiSP`,`isdelete` ) 
                            VALUES ( '$ten',1)";             
        if ($con->query($sql))
        {
            echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Thành Công!</strong> Loại của sản phẩm đã được thêm.
            </div>';
        }
        else {
            echo '<div class="alert alert-danger">
                <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Lỗi!</strong> Thêm loại sản phẩm thất bại.
            </div>';     
        }
    }
    if(isset($_GET['deleteid']) ) {
        $deleteid =  $_GET['deleteid'];
        if(check($_GET['deleteid'],$con)) {
            $sqldelete = "UPDATE `loaisanpham` SET isdelete = 0 WHERE maloaiSP = $deleteid";
            if ($con->query($sqldelete))
            {
                echo '<div class="alert alert-success alert-dismissible fade in">
                        <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Thành Công!</strong> Xóa loại của sản phẩm.
                    </div>';
            }
            else {
                echo '<div class="alert alert-danger">
                        <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Lỗi!</strong> Xóa loại sản phẩm thất bại.
                    </div>';     
            }
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Xóa loại sản phẩm thất bại. Do không tìm được loại sản phẩm 
                  </div>';     
          }
    }

    if(isset($_POST['submitupdate']) ) {
        $updateid =  $_GET['updateid'];
        $ten = $_POST['nametype'];
        if(check($_GET['updateid'],$con)) {
            $sqlupdate = "UPDATE `loaisanpham` SET tenloaiSP = '$ten'  WHERE maloaiSP = $updateid AND isdelete = 1";
            if ($con->query($sqlupdate))
            {
                echo '<div class="alert alert-success alert-dismissible fade in">
                        <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Thành Công!</strong> Cập nhật loại của sản phẩm đã được thêm.
                    </div>';
            }
            else {
                echo '<div class="alert alert-danger">
                        <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Lỗi!</strong> Cập nhật loại sản phẩm thất bại.
                    </div>';     
            }
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Cập nhật loại sản phẩm thất bại. Do không tìm được loại sản phẩm. 
                  </div>';     
          }
          $_GET['updateid'] = null;
    }
    
    function check($id, $con) {
        $sqlcheck = "SELECT maloaiSP FROM `loaisanpham` WHERE maloaiSP = $id and isdelete = 1";
        if ($resultcheck = $con->query($sqlcheck)) {
            if ($resultcheck->num_rows > 0) {
                return true;
            }
        } 
        return false;
    } 
?>
<?php

if (isset($_GET['maloaiSP'])) {
    $maloaiSP = $_GET['maloaiSP'];}
?>


<html>
    <head><meta charset="UTF-8">
    <script src="./js/hed.js"></script>
    <link rel="stylesheet" href="./css/price.css">
    </head>
    <body>
    <button id="myBtn"  class="btn btn-primary">Thêm loại sản phẩm</button>
    <div id="myModal" class="modal">
    <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Thêm loại cho sản phẩm</h3>
            
            <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <label>Tên loại sản phẩm</label> 
                <input class="form-control" type="text" name="nametype" required/>
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
            <a href="./index.php?id=nh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <h3>Sửa loại cho sản phẩm</h3>
            
            <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <label>Tên loại sản phẩm</label> 
                <?php
                    $idshow = $_GET['updateid'];
                    $sqlshow = "SELECT a.tenloaiSP FROM `loaisanpham` a WHERE maloaiSP = $idshow ";
                    if ($resultshow = $con->query($sqlshow)) {
                        if ($resultshow->num_rows > 0) {
                            while ($rowshow = $resultshow->fetch_assoc()) {
                                echo '<input class="form-control" type="text" name="nametype" value="'.$rowshow['tenloaiSP'].'" required/>';
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
    <h2>Danh sách loại sản phẩm</h2>    
    <hr>  
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr height="50px">
                    <th>Tên loại sản phẩm </th> 
                    <th>Xóa</th>
                    <th>Sữa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2="SELECT * FROM `loaisanpham` WHERE isdelete = 1 ";
                if ($result2=$con->query($sql2))
                {
                if($result2->num_rows>0)
                {
                    while($row2 = $result2->fetch_assoc())
                    {
                    
                        echo '<tr>
                        <td>'.$row2['tenloaiSP'].'</td>
                    
                        <td><a href="?id=nh&deleteid='.$row2['maloaiSP'].'"class="icon"><span style="color:red" class="glyphicon glyphicon-trash"></span></a></td>
                        
                        <td><a href="?id=nh&updateid='.$row2['maloaiSP'].'" onclick="UpdateProduct()" href="index.php?id=nh&maloaiSP='.$row2['maloaiSP'].'"><span style="color:red" class="glyphicon glyphicon-pencil"></span></a><td>

                        
                        </tr>';
                    
                    }
                }
            }?>
            </tbody>
        </table>   
        </div>
    </body>
</html>
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
