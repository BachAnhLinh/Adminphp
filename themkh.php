

<html>
<head><meta charset="UTF-8">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/price.css">
    <script src="./js/hed.js"></script>
</head>
<body>
    
    <h2> Danh sách khách hàng </h2>
    <hr>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr height="50px"; weight="1000px">
                    <th>Tên khách hàng</th> 
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql2="SELECT * FROM `khachhan`order by maKH desc";
                if ($result2=$con->query($sql2))
                {
                if($result2->num_rows>0)
                {
                    while($row2 = $result2->fetch_assoc())
                    {
                        echo '<tr>
                        <td>'.$row2['tenKH'].'</td>
                        <td>'.$row2['emailKH'].'</td>
                        <td>'.$row2['sdtKH'].'</td>
                        <td>'.$row2['diachiKH'].'</td>
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
