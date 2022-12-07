
// JS admin---------------------------------------------------------------------------------------
function addProduct() {
    document.getElementById('showModal').style.display = "flex";
    document.getElementById('showModalnotificationCartUpdate').style.display = "none";
    document.getElementById('showModalnotificationCart').style.display = "block";
    
}
function UpdateProduct() {
    document.getElementById('showModal').style.display = "flex";
    document.getElementById('showModalnotificationCart').style.display = "none";
    document.getElementById('showModalnotificationCartUpdate').style.display = "block";
    
}

function editProduct(tensp, gia, dvt, sl, loai, mota, tenth, file) {
    debugger
    document.getElementById("tensp").value = tensp;
    document.getElementById("gia").value = gia;
    document.getElementById("dvt").value = dvt;
    document.getElementById("slh").value = sl;
    document.getElementById("loai").value = loai;
    document.getElementById("mota").value = mota;
    document.getElementById("thuonghieu").value = tenth;
    document.getElementById("hinh").value = file;
    document.getElementById('showModal').style.display = "flex";
    document.getElementById('showModalnotificationCart').style.display = "block";
 }

function closeAddProduct() {
    document.getElementById('showModal').style.display = "none";
    document.getElementById('showModalnotificationCart').style.display = 'none';

}
function closeUpdateProduct() {
    document.getElementById('showModal').style.display = "none";
    document.getElementById('showModalnotificationCartUpdate').style.display = 'none';
}

function showFied() {
    document.getElementById("tenloai").value = "tenloai";
 }

 

 