<?php
if(isset($_POST['submit']))
{
    $tensp =$_POST["tensp"];
    $gia = $_POST["price"];
    $donvitinh = $_POST["dvt"];
    $loai = $_POST["loaisp"];
    $mota = $_POST["editor"];
    $maTH = $_POST["thuonghieu"];
    $tmp_name = $_FILES["hinh"]["tmp_name"];
    $name = basename($_FILES["hinh"]["name"]);
    move_uploaded_file($tmp_name, "assets/img/$name");
    $file = './assets/img/'.$_FILES['hinh']['name'];

    $sql = "INSERT INTO `sanpham` ( `tenSP`, `maDVT`, `Hinh`, `motaSP`, `maloaiSP`,`maTH`,`isdelete`) 
                         VALUES ( '$tensp', '$donvitinh', '$file', '$mota', '$loai', '$maTH',1)";
    if ($con->query($sql))
    {
        $masp = $con->insert_id;
        $date = date("Y-m-d H:i:s");
        $sqlprice = "INSERT INTO `giasanpham` ( `price`, `masp`, `date`, `isdelete`) 
        VALUES ( '$gia', '$masp', '$date',1)";
            if ($con->query($sqlprice))
            {
                echo '<div class="alert alert-success alert-dismissible fade in">
                <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Thành Công!</strong>  sản phẩm đã được thêm.
                </div>';
                    $_POST['submit'] = null;
            }
            else {
                echo '<div class="alert alert-danger">
                        <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Lỗi!</strong> Thêm giá sản phẩm thất bại. 
                    </div>';  
                    $_POST['submit'] = null; 
            }
        
    }
    else {
        echo $sqlcheck;
            echo '<div class="alert alert-danger">
                <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Lỗi!</strong> Thêm sản phẩm thất bại.
            </div>'; 
    }
}

if(isset($_GET['deleteid']) ) {
    $deleteid =  $_GET['deleteid'];
    if(check($_GET['deleteid'],$con)) {
        $sqldelete = "UPDATE `sanpham` SET isdelete = 0 WHERE maSP = $deleteid";
        if ($con->query($sqldelete))
        {
            echo '<div class="alert alert-success alert-dismissible fade in">
                    <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Thành Công!</strong> Xóa sản phẩm
                </div>';
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Xóa sản phẩm thất bại.
                </div>';     
        }
    }
    else {
        echo '<div class="alert alert-danger">
                <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Lỗi!</strong> Xóa sản phẩm thất bại. Do không tìm được sản phẩm
              </div>';     
      }
}
if(isset($_POST['submitupdate']) ) {
    $updateid =  $_GET['updateid'];
    $tensp =$_POST["tensp"];
    $donvitinh = $_POST["dvt"];
    $loai = $_POST["loaisp"];
    $mota = $_POST["editor"];
    $maTH = $_POST["thuonghieu"];
    $tmp_name = $_FILES["hinh"]["tmp_name"];
    $name = basename($_FILES["hinh"]["name"]);
    move_uploaded_file($tmp_name, "assets/img/$name");
    $file = './assets/img/'.$_FILES['hinh']['name'];
    if(check($_GET['updateid'],$con)) {

        $sqlupdate = "UPDATE `sanpham` SET `maDVT` = '$donvitinh', `tenSP` = '$tensp', `Hinh` = '$file', `motaSP` = '$mota', `maloaiSP` = '$loai', `maTH` = '$maTH' 
        WHERE `sanpham`.`maSP` = $updateid AND isdelete = 1";
        if($file =="./assets/img/") {
            $sqlupdate = "UPDATE `sanpham` SET `maDVT` = '$donvitinh', `tenSP` = '$tensp', `motaSP` = '$mota', `maloaiSP` = '$loai', `maTH` = '$maTH' 
        WHERE `sanpham`.`maSP` = $updateid AND isdelete = 1";
        }
        if ($con->query($sqlupdate))
        {
            echo '<div class="alert alert-success alert-dismissible fade in">
                    <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Thành Công!</strong> Cập nhật sản phẩm.
                </div>';
        }
        else {
            echo '<div class="alert alert-danger">
                    <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Lỗi!</strong> Cập nhật sản phẩm thất bại.
                </div>';     
        }
    }
    else {
        echo '<div class="alert alert-danger">
                <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Lỗi!</strong> Cập nhật sản phẩm thất bại. Do không tìm được sản phẩm
              </div>';     
      }
      $_GET['updateid'] = null;
}
function check($id, $con) {
    $sqlcheck = "SELECT maSP FROM `sanpham` WHERE maSP = $id and isdelete = 1";
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
  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
  <script  src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script  src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="./css/price.css">
<style>
    .container {
    padding: 0px!important;
    margin: 0px!important;
    }
    #blah {
        display:none;
        margin: 20px;
    }
    .file-input__input {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
    }

    .file-input__label {
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    font-size: 14px;
    padding: 10px 12px;
    background-color: #4245a8;
    box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.25);
    }

    .file-input__label svg {
    height: 16px;
    margin-right: 4px;
    }



 
</style>
<script src="./js/hed.js"></script>
</head>
<body>
    <button class="btn btn-primary" id="myBtn">Thêm sản phẩm</button>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Thêm sản phẩm</h3>
            <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <label>Tên sản phẩm</label> 
                <input class="form-control" type="text" name="tensp" required/>
                <label>Loại sản phẩm</label> 
                <select name="loaisp" class="form-control" >
                    <option value="">--vui lòng chọn loại sản phẩm---</option>
                    <?php
                        $sql = 'SELECT tenloaiSP, maloaiSP FROM loaisanpham WHERE isdelete = 1';
                            if ($result = $con->query($sql)) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()){
                                        echo '<option value="'.$row['maloaiSP'].'">'.$row['tenloaiSP'].'</option>';
                                    }   
                                }
                            }
                    ?>
                </select>
                <label>Giá sản phẩm</label> 
                <input class="form-control" type="text" name="price" required/>

                <label>Thương hiệu</label> 
                <select name="thuonghieu" class="form-control" >
                    <option value="">--vui lòng chọn thương hiệu---</option>
                    <?php
                        $sql = 'SELECT tenTH, maTH FROM thuonghieu WHERE isdelete = 1';
                            if ($result = $con->query($sql)) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()){
                                        echo '<option value="'.$row['maTH'].'">'.$row['tenTH'].'</option>';
                                    }   
                                }
                            }
                    ?>
                </select>
                <label>Mô tả</label> 
                <textarea  id="editor"  name="editor" style="width: 860px" >
                </textarea>
                <div class = "row">
                    <div class ="col-xs-6">
                        <label>Hình Ảnh</label>
                        <div class="file-input">
                        <input
                            type="file"
                            name="hinh"
                            id="file-input"
                            class="file-input__input"
                            onchange="readURL(this);" 
                        />
                        <label class="file-input__label" for="file-input">
                            <svg
                            aria-hidden="true"
                            focusable="false"
                            data-prefix="fas"
                            data-icon="upload"
                            class="svg-inline--fa fa-upload fa-w-16"
                            role="img"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            >
                            <path
                                fill="currentColor"
                                d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"
                            ></path>
                            </svg>
                            <span>Upload file</span>
                        </label>
                        </div>
                    </div>
                    <img class ="col-xs-6" id="blah"  src="#" alt="your image" />
                </div>
                <label>Đơn Vị Tính</label>
                <select name="dvt" class="form-control" >
                    <option value="">--vui lòng chọn đơn vị tính---</option>
                    <?php
                        $sql = 'SELECT maDVT, tenDVT FROM donvitinh';
                            if ($result = $con->query($sql)) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()){
                                        echo '<option value="'.$row['maDVT'].'">'.$row['tenDVT'].'</option>';
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
    <div class="modal-content">
            <a href="./index.php?id=hh" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h3>Sửa sản phẩm</h3>
                
                <form class="form-group" method="Post" action="#" enctype="multipart/form-data" style="margin-left:20px;">
                <?php
                        $idshow = $_GET['updateid'];
                        $sqlshow = "SELECT a.maSP,a.maloaiSP,l.tenloaiSP,a.motaSP, a.tenSP, a.Hinh, 
                                    a.maTH, th.tenTH , e.price, dvt.tenDVT, a.maDVT,
                                    CASE WHEN d.soluong IS NULL THEN 0 ELSE d.soluong END AS soluong 
                                    FROM sanpham a 
                                    INNER JOIN loaisanpham l on l.maloaiSP = a.maloaiSP
                                    INNER JOIN thuonghieu th on th.maTH = a.maTH
                                    INNER JOIN donvitinh dvt on dvt.maDVT = a.maDVT
                                    LEFT JOIN (SELECT SUM(c.soluong) as soluong, c.maSP 
                                                FROM lonhap c GROUP BY c.maSP ) d on d.maSP = a.maSP
                                    INNER JOIN (select g.maSP, g.price from giasanpham g WHERE g.maSP = $idshow Order by g.date desc limit 1) 
                                    e on a.maSP = e.maSP
                                    WHERE a.isdelete = 1 AND a.maSP = $idshow";

                        if ($resultshow = $con->query($sqlshow)) {
                            if ($resultshow->num_rows > 0) {
                                while ($rowshow = $resultshow->fetch_assoc()) {
                    ?>
                    <label>Tên sản phẩm</label> 
                    <input class="form-control" type="text"  value="<?php echo $rowshow['tenSP'] ?>" name="tensp" required/>
                    <label>Loại sản phẩm</label> 
                    <select name="loaisp" class="form-control" >
                        <option value="">--vui lòng chọn loại sản phẩm---</option>
                        <?php
                            $sql = 'SELECT tenloaiSP, maloaiSP FROM loaisanpham WHERE isdelete = 1';
                                if ($result = $con->query($sql)) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()){
                                            if($rowshow['maloaiSP'] == $row['maloaiSP']) {
                                                echo '<option value="'.$row['maloaiSP'].'" selected>'.$row['tenloaiSP'].'</option>';
                                            } else {
                                                echo '<option value="'.$row['maloaiSP'].'">'.$row['tenloaiSP'].'</option>';
                                            }
                                        }   
                                    }
                                }
                        ?>
                    </select>
                    <label>Giá sản phẩm</label> 
                    <input disabled class="form-control" type="text" name="price" value="<?php echo $rowshow['price'] ?>" required/>

                    <label>Thương hiệu</label> 
                    <select name="thuonghieu" class="form-control" >
                        <option value="">--vui lòng chọn Thương hiệu---</option>
                        <?php
                            $sql = 'SELECT tenTH, maTH FROM thuonghieu WHERE isdelete = 1';
                                if ($result = $con->query($sql)) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()){
                                            if($rowshow['maTH'] == $row['maTH']) {
                                                echo '<option value="'.$row['maTH'].'" selected>'.$row['tenTH'].'</option>';
                                            } else {
                                            echo '<option value="'.$row['maTH'].'">'.$row['tenTH'].'</option>';
                                            }
                                        }   
                                    }
                                }
                        ?>
                    </select>
                    <label>Mô tả </label> 
                <textarea  cols="50" id="editor" name="editor" style="width: 100%;" >
                <?php echo $rowshow['motaSP']?>
                </textarea>
                <div class = "row" style="margin-top: 20px;">
                    <div class ="col-xs-6">
                        <label>Hình Ảnh</label>
                        <div class="file-input">
                        <input
                            type="file"
                            name="hinh"
                            id="file-input1"
                            class="file-input__input"
                            onchange="readURL(this);" 
                        />
                        <label class="file-input__label" for="file-input1">
                            <svg
                            aria-hidden="true"
                            focusable="false"
                            data-prefix="fas"
                            data-icon="upload"
                            class="svg-inline--fa fa-upload fa-w-16"
                            role="img"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            >
                            <path
                                fill="currentColor"
                                d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"
                            ></path>
                            </svg>
                            <span>Upload file</span>
                        </label>
                        </div>
                    </div>
                    <img class ="col-xs-6" id="showimage"  src="<?php echo $rowshow['Hinh'] ?>" alt="your image" />
                </div>
                    <label>Đơn Vị Tính</label>
                    <select name="dvt" class="form-control" >
                        <option value="">--vui lòng chọn đơn vị tính---</option>
                        <?php
                            $sql = 'SELECT maDVT, tenDVT FROM donvitinh';
                                if ($result = $con->query($sql)) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()){
                                            if($rowshow['maDVT'] == $row['maDVT']) {
                                                echo '<option value="'.$row['maDVT'].'" selected>'.$row['tenDVT'].'</option>';
                                            } else {
                                            echo '<option value="'.$row['maDVT'].'">'.$row['tenDVT'].'</option>';
                                            }
                                        }   
                                    }
                                }
                                }
                            }
                        }
                    ?>
                    </select>
                    <br>
                    <input class="btn btn-primary" type="submit" name="submitupdate" value="Lưu"/>
                </form>
            </div>
        </div>
    <?php
    } else {
        echo '<div class="modal" style="display:none">';
    }
    ?>
    <!-- Modal content -->
           
    </div>
    
<h2>Danh sách sản phẩm</h2>    
<hr>  
<div class="container">
    <table class="table table-striped">
        <thead >
            <tr height="50px">
                <th>Tên sản phẩm</th>
                <th>Hình</th>
                <th>Loại sản phẩm</th>
                <th>Thương hiệu</th>
                <th>Số Lượng</th>
                <th>Xoá</th>
                <th>Sửa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql2 = "SELECT a.maSP,a.maloaiSP,a.motaSP, a.tenSP, a.Hinh, th.tenTH, CASE WHEN d.soluong IS NULL THEN 0 ELSE d.soluong END AS soluong 
                    ,CASE WHEN ct.soluongmua IS NULL THEN 0 ELSE ct.soluongmua END AS soluongmua 
                    FROM sanpham a 
                    LEFT JOIN (SELECT SUM(c.soluong) as soluong, c.maSP 
                    FROM lonhap c GROUP BY c.maSP ) d on d.maSP = a.maSP
                    LEFT JOIN (SELECT SUM(c.soluong) as soluongmua, c.maSP 
                    FROM chitietdonhang c GROUP BY c.maSP ) ct on ct.maSP = a.maSP
                    INNER JOIN thuonghieu th on th.maTH = a.maTH
                    WHERE a.isdelete = 1 ";
            if ($result2 = $con->query($sql2)) {
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $nhom = $row2['maloaiSP'];
                        $sql3 = "SELECT tenloaiSP  FROM `loaisanpham`WHERE maloaiSP='$nhom'";
                        if ($result3 = $con->query($sql3)) {
                            if ($result3->num_rows > 0) {
                                while ($row3 = $result3->fetch_assoc()) {
                                    $id = $row2['maSP'];
                                    echo '<tr style="cursor: pointer">
                                    <td data-toggle="tooltip" title="Click để xem chi tiết!" style="width:20%"><a href="?id=hh&updateid=' . $row2['maSP'] . '" >' .substr($row2['tenSP'],0,100).'...</a></td>
                                    <td data-toggle="tooltip" title="Click để xem chi tiết!"> <a href="?id=hh&updateid=' . $row2['maSP'] . '" ><img src="' . $row2['Hinh'] . '" width="80px" height="80px"></a></td>
                                    <td>' . $row3['tenloaiSP']. '</td>
                                    <td>' . $row2['tenTH'] . '</td>
                                    <td>' . ($row2['soluong'] - $row2['soluongmua'] ). '</td>
                                    <td><a href="?id=hh&deleteid='.$row2['maSP'].'" class ="icon"> 
                                    <span style="color:red"  class="glyphicon glyphicon-trash"></span></td>
                                    <td> <a href="?id=hh&updateid=' . $row2['maSP'] . '" style="color:red"><span style="color:red" class="glyphicon glyphicon-pencil"></span></a></td>
                                    </tr>';
                                }
                                // <td>'.$row2['giaold'].'</td>
                            }
                        }
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>
    
    

</body>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').css("display","block")
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(400)
                        .height(200);
                    $('#showimage')
                        .attr('src', e.target.result)
                        .width(400)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
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
<!-- <td><p onclick="editProduct("' . $row2['tenSP'] . ',' . $row2['giaSP'] . ',' . $row2['tenDVT'] . ',' . $row2['soluongSP'] . ','.$nhom.',' . $row2['motaSP'] . ',' . $row2['thuonghieu'] . ',' . $row2['Hinh'] . '")" class ="icon"><img src="../assets/img/update.png"alt="sua"width="20px" height="20px"></p></td> -->