<?php
   if(isset($_POST['submit']))
   {
    
       $ten =$_POST["namebrand"];
        $sql = "INSERT INTO `thuonghieu` ( `tenTH`,`isdelete` ) 
                            VALUES ( '$ten',1)";             
        if ($con->query($sql))
        {
            echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="./index.php?id=th" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Thành Công!</strong> thêm thương hiệu.
            </div>';
        }
        else {
            echo '<div class="alert alert-danger">
                <a href="./index.php?id=th" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Lỗi!</strong> Thêm thương hiệuthất bại.
            </div>';     
        }
    }
    if(isset($_GET['deleteid']) ) {
        $deleteid =  $_GET['deleteid'];
        if(check($_GET['deleteid'],$con)) {
            $sqldelete = "UPDATE `thuonghieu` SET isdelete = 0 WHERE maTH = $deleteid";
            if ($con->query($sqldelete))
            {
                echo '<div class="alert alert-success alert-dismissible fade in">
                        <a href="./index.php?id=th" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Thành Công!</strong> Xóa thương hiệu .
                    </div>';
            }
            else {
                echo '<div class="alert alert-danger">
                        <a href="./index.php?id=th" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Lỗi!</strong> Xóa thương hiệu thất bại.
                    </div>';     
            }
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=th" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Xóa thương hiệu thất bại. Do không tìm được thương hiệu 
                  </div>';     
          }
    }

    if(isset($_POST['submitupdate']) ) {
        $updateid =  $_GET['updateid'];
        $ten = $_POST['namebrand'];
        if(check($_GET['updateid'],$con)) {
            $sqlupdate = "UPDATE `thuonghieu` SET tenTH = '$ten'  WHERE maTH = $updateid AND isdelete = 1";
            if ($con->query($sqlupdate))
            {
                echo '<div class="alert alert-success alert-dismissible fade in">
                        <a href="./index.php?id=th" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Thành Công!</strong> Cập nhật thương hiệu.
                    </div>';
            }
            else {
                echo '<div class="alert alert-danger">
                        <a href="./index.php?id=th" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Lỗi!</strong> Cập nhật thương hiệu thất bại.
                    </div>';     
            }
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=th" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Cập nhật thương hiệu thất bại. Do không tìm được thương hiệu. 
                  </div>';     
          }
          $_GET['updateid'] = null;
    }
    
    function check($id, $con) {
        $sqlcheck = "SELECT maTH FROM `thuonghieu` WHERE maTH = $id and isdelete = 1";
        if ($resultcheck = $con->query($sqlcheck)) {
            if ($resultcheck->num_rows > 0) {
                return true;
            }
        } 
        return false;
    } 
?>
<?php

if (isset($_GET['maTH'])) {
    $maloaiSP = $_GET['maTH'];}
?>


<html>
    <head><meta charset="UTF-8">
    <script src="./js/hed.js"></script>
    <link rel="stylesheet" href="./css/price.css">
    </head>
    <body>
    <button id="myBtn"  class="btn btn-primary">Thêm thương hiệu</button>
    <div id="myModal" class="modal">
    <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Thêm thương hiệu</h3>
            
            <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <label>Tên thương hiệu</label> 
                <input class="form-control" type="text" name="namebrand" required/>
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
            <a href="./index.php?id=th" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <h3>Sửa Thương hiệu</h3>
            
            <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <label>Tên thương hiệu</label> 
                <?php
                    $idshow = $_GET['updateid'];
                    $sqlshow = "SELECT a.tenTH FROM `thuonghieu` a WHERE maTh = $idshow ";
                    if ($resultshow = $con->query($sqlshow)) {
                        if ($resultshow->num_rows > 0) {
                            while ($rowshow = $resultshow->fetch_assoc()) {
                                echo '<input class="form-control" type="text" name="namebrand" value="'.$rowshow['tenTH'].'" required/>';
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
    <h2>Danh sách Thương hiệu</h2>    
    <hr>  
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr height="50px">
                    <th>Tên Thương Hiệu </th> 
                    <th>Xóa</th>
                    <th>Sữa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2="SELECT * FROM `thuonghieu` WHERE isdelete = 1 ";
                if ($result2=$con->query($sql2))
                {
                if($result2->num_rows>0)
                {
                    while($row2 = $result2->fetch_assoc())
                    {
                    
                        echo '<tr>
                        <td>'.$row2['tenTH'].'</td>
                    
                        <td><a href="?id=th&deleteid='.$row2['maTH'].'"class="icon"><span style="color:red" class="glyphicon glyphicon-trash"></span></a></td>
                        
                        <td><a href="?id=th&updateid='.$row2['maTH'].'" onclick="UpdateProduct()" href="index.php?id=th&maTH='.$row2['maTH'].'"><span style="color:red" class="glyphicon glyphicon-pencil"></span></a><td>

                        
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
