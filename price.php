<!DOCTYPE html>
<html>
<!--php-->
<?php
if(isset($_POST['submit']))
{
    $price =$_POST["price"];
    $date = $_POST["date"];
    $maSP = $_POST["maSP"];

 $sql = "INSERT INTO `giasanpham` ( `price`, `maSP`, `date`, `isdelete`) 
                      VALUES ( '$price', '$maSP', '$date',1)";
    $update = "UPDATE `giasanpham` SET `isdelete` = 0 WHERE   `maSP` = $maSP";
    if ($con->query($update))
      {
        if ($con->query($sql))
        {
            echo '<div class="alert alert-success alert-dismissible fade in">
                      <a href="./index.php?id=price" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Thành Công!</strong> Giá của sản phẩm đã được thêm.
                  </div>';
                  $_POST['submit'] = null;
        }
        else {
            echo '<div class="alert alert-danger">
                      <a href="./index.php?id=price" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Lỗi!</strong> Thêm giá sản phẩm thất bại. 
                  </div>';  
                  $_POST['submit'] = null; 
        }
      }
      else {
          echo '<div class="alert alert-danger">
                    <a href="./index.php?id=price" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Thêm giá sản phẩm thất bại. 
                </div>';  
                $_POST['submit'] = null; 
      }
  
}
if(isset($_GET['deleteid']) ) {
    $deleteid =  $_GET['deleteid'];
    if(check($_GET['deleteid'],$con)) {
        $sqldelete = "UPDATE `giasanpham` SET isdelete = 0 WHERE idprice = $deleteid";
        if ($con->query($sqldelete))
        {
            echo '<div class="alert alert-success alert-dismissible fade in">
                    <a href="./index.php?id=price" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Thành Công!</strong> Xóa giá của sản phẩm đã được thêm.
                </div>';
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=price" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Xóa giá sản phẩm thất bại.
                </div>';     
        }
    }
    else {
        echo '<div class="alert alert-danger">
                <a href="./index.php?id=price" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Lỗi!</strong> Xóa giá sản phẩm thất bại. Do không tìm được giá 
              </div>';     
      }
}

if(isset($_POST['update']) )
{
    $updateid =  $_GET['updateid'];
    $price =$_POST["price"];
    $date = $_POST["date"];
    if(check($_GET['updateid'],$con)) {
        $sqlupdate = "UPDATE `giasanpham` SET `price` = $price, `date` = '$date' WHERE idprice = $updateid";
        if ($con->query($sqlupdate))
        {
            echo '<div class="alert alert-success alert-dismissible fade in">
                    <a href="./index.php?id=price" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Thành Công!</strong> Cập nhật giá của sản phẩm đã được thêm.
                </div>';
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=price" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Cập nhật giá sản phẩm thất bại.
                </div>';     
        }
    }
    else {
        echo '<div class="alert alert-danger">
                <a href="./index.php?id=price" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Lỗi!</strong> Cập nhật giá sản phẩm thất bại. Do không tìm được giá 
              </div>';     
      }
      $_GET['updateid'] = null;
}
function check($id, $con) {
    $sqlcheck = "SELECT idprice FROM `giasanpham` WHERE idprice = $id and isdelete = 1";
    if ($resultcheck = $con->query($sqlcheck)) {
        if ($resultcheck->num_rows > 0) {
            return true;
        }
    } 
    return false;
} 
?>
<head>
    <title>Quản lý giá sản phẩm</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/price.css">
</head>

<body>
    

<!-- Trigger/Open The Modal -->
<button id="myBtn" class="btn btn-primary">Thêm giá sản phẩm</button>
<!--Table list price-->
<div class="container">
  <h2>Danh sách giá sản phẩm</h2>    
  <hr>      
  <table class="table table-striped">
    <thead>
      <tr>
      <th>Sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Ngày áp dụng</th>
        <th>Xóa</th>
        <th>Sửa</th>
    </tr>
    </thead>
    <tbody>
      <?php
            $sqlget = "SELECT b.tenSP, a.price, a.date, a.isdelete,a.idprice FROM `giasanpham` a
                    join `sanpham` b on a.maSP = b.maSP WHERE a.isdelete = 1 ";
            if ($resultget = $con->query($sqlget)) {
                if ($resultget->num_rows > 0) {
                    while ($rowget = $resultget->fetch_assoc()) {
                        echo "<tr>  <td>".$rowget["tenSP"]."</td>
                                <td>".$rowget['price']."</td>
                                <td>".$rowget['date']."</td>";
                                echo " <td><a href='?id=price&deleteid=".$rowget['idprice']."' style='color:red'>
                                <span class='glyphicon glyphicon-trash'></span>
                            </a></i></td>";
                        echo "<td><a id='showUpdate' href='?id=price&updateid=".$rowget['idprice']."' style='color:red'><span style='color:red' class='glyphicon glyphicon-pencil'></span></a></td>";
                        
                        
                    }
                }
            }
            ?>
    </tbody>
  </table>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Thêm giá cho sản phẩm</h3>
    
    <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
        <label>Chọn sản phẩm</label>
        <select name="maSP" class="form-control" required>
        <option value="">--vui lòng chọn sản phẩm---</option>
        <?php
            $sql = "SELECT maSP, tenSP FROM `sanpham` WHERE isdelete = 1";
            if ($result = $con->query($sql)) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=".$row['maSP'].">".$row['tenSP']."</option>";
                    }
                }
            }
            ?>
            
        </select>
        <label>Giá sản phẩm</label> 
        <input class="form-control" type="number" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" 
            data-type="currency" placeholder="1,000,000.00VND" name="price" required/>
        <label>Ngày áo dụng</label> <input class="form-control" type="date" name="date" required/>
        <br>
        <input class="btn btn-primary" type="submit" name="submit" value="Lưu"/>
    </form>
  </div>
</div>

<!--Cập nhật-->
<?php
if(isset($_GET['updateid']) ) {
    echo '<div id="myModalUpdate" class="modal">';
?>
<div class="modal-content">
  <a href="./index.php?id=price" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <h3>Cập nhật giá cho sản phẩm</h3>
    
    <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
        <label>Chọn sản phẩm</label>
        <?php
            $idshow = $_GET['updateid'];
            $sqlshow = "SELECT b.tenSP, a.price, a.date, a.isdelete,a.idprice FROM `giasanpham` a
            join `sanpham` b on a.maSP = b.maSP  WHERE a.idprice = $idshow  AND a.isdelete = 1";
            if ($resultshow = $con->query($sqlshow)) {
                if ($resultshow->num_rows > 0) {
                    while ($rowshow = $resultshow->fetch_assoc()) {
                        echo "<select name='maSP' class='form-control'disabled>
                                <option>".$rowshow['tenSP']."</option>
                                </select>
                        <label>Giá sản phẩm</label>";
                        echo '<input class="form-control" type="number" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" 
                        data-type="currency" placeholder="1,000,000.00VND" name="price" value="'.$rowshow['price'].'" required/>
                        <label>Ngày áo dụng</label> <input class="form-control" type="date" name="date" value='.$rowshow['date'].' required/>
                        <br>
                        <input class="btn btn-primary" type="submit" name="update" value="Lưu"/>';
                    }
                }
            }
            ?>
    </form>
  </div>
<?php
} else {
    echo '<div class="modal">';
}
?>
  <!-- Modal content -->
  
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

    // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    // if (event.target == modal) {
    //     modal.style.display = "none";
    // }
    // }
 </script>
</html>