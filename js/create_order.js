function getcustomer() {
input = document.getElementById("sdtkh").value;
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var html = "";
        if(this.responseText != "") {
          $("#showphone").css("display","block");
            var data = JSON.parse(this.responseText);
            data.forEach(x => {
             var fc = "choose('"+ x.tenKH.toString() +"',"+ x.maKH +",'" + x.sdtKH +"')"; 
             html += '<p onclick ="'+fc+'">'+x.sdtKH+'</p>';
            });
        }  
        else {
            html += "<p>Không tìm thấy dữ liệu</p>";
        }
      } 
      $("#showphone").html(html);
    };
    xmlhttp.open("GET", "getcustomer.php?keywork=" + input, true);
    xmlhttp.send();
}

function choose(ten, ma, sdt) {
    document.getElementById("tenkh").value = ten;
    document.getElementById("makh").value = ma;
    document.getElementById("sdtkh").value = sdt;
    $("#showphone").css("display","none");
}

function getproduct(val) {
  input = document.getElementById("tensp"+val).value;
    var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var html = "";
            if(this.responseText != "") {
              $("#showproduct"+val).css("display","block");
                var data = JSON.parse(this.responseText);
                data.forEach(x => {
                var fc = "chooseproduct('"+ x.tenSP.toString() +"',"+ x.maSP +"," + x.idprice +","+x.price+","+x.soluong+","+val+")";
                 html += '<p onclick="'+fc+'">'+x.tenSP+'</p>';
                });
            }  
            else {
                html += "<p>Không tìm thấy dữ liệu</p>";
            }
          } 
          $("#showproduct"+ val).html(html);
        };
        xmlhttp.open("GET", "getproduct.php?keywork=" + input, true);
        xmlhttp.send();
}
    
function chooseproduct(ten, ma,idprice, price, soluong, key) {
  document.getElementById("tensp"+ key).value = ten;
  document.getElementById("masp"+ key).value = ma;
  document.getElementById("idprice"+ key).value = idprice;
  document.getElementById("price"+ key).value = price;
  document.getElementById("maxsoluong"+ key).value = soluong;
  $("#soluong"+ key).prop("max",soluong);
  $("#showproduct"+ key).css("display","none");        
}
function addForm(val) {
  var btn = "btnAdd" + val;
  $("#" + btn).css("display","none");   
  var htmlbody =  '<div class=" row item'+val+'">'+
                  '<div class="col-xs-4">'+
                  '<label>Sản phẩm:</label> '+
                  '<div id="myDropdown" class="dropdown-contentsp">'+
                  '    <input class="form-control" type="text" id="tensp'+val+'" name="tensp'+val+'" onkeyup="getproduct('+val+')"/>'+
                  '    <input type="text" name="masp'+val+'" id="masp'+val+'" hidden />'+
                  '    <div id="showproduct'+val+'"></div>'+
                  '</div>'+
                  '</div>'+
                  '<div class="col-xs-4">'+
                  '<label>Giá:</label> '+
                  '<input class="form-control" type="text" id="price'+val+'" name="price'+val+'" disabled/>'+
                  '<input type="text" name="idprice'+val+'" id="idprice'+val+'" hidden />'+
                  '</div>'+
                  '<div class="col-xs-3">'+
                  '<label>Số lượng:</label> '+
                  '<input id="maxsoluong'+val+'" name="maxsoluong'+val+'" type="number" hidden/>'+
                  '<input class="form-control" type="number" id="soluong'+val+'" name="soluong'+val+'" onchange="sum()" required/>'+
                  '</div>'+
                  '<div class="col-xs-1">'+
                  '<span class="close" aria-label="close" style="margin: 40px;" onclick="deleteitem('+val+')">&times;</span>'+
                  '</div>';
  var htmlbtn = '<button onclick="addForm('+(val +1)+')" id="btnAdd'+(val +1)+'"class="btn btn-primary">+</button>';
  $("#addProduct").append(htmlbody);
  $("#btnAdd").html(htmlbtn);
  $('#number').val(val);
}

function sum() {
  var number = $('#number').val() == "" || $('#number').val() == undefined ? 0 :$('#number').val();
  var sumproduct = 0;
  var sumprice = 0;
  for(var i = 0 ; i <= number; i++) {
    debugger
      sumproduct += parseInt($('#soluong'+i).val());
      sumprice =sumprice +  ($('#soluong'+i).val()* $('#price'+i).val());
  }
  $('#sumprice').text(sumprice);
  $('#sumproduct').text(sumproduct); 
}

function thongke() {
  input = document.getElementById("month_year").value;
    var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText != "") {
              var data = JSON.parse(this.responseText);
              var xValues = [];
              var yValues = []; 
              var max = 0;

                    for (var i in data) {
                      xValues.push(data[i].tenSP);
                      yValues.push(data[i].soluong);
                      max += parseInt(data[i].soluong);
                    }
              
                    new Chart("myChart", {
                      type: "horizontalBar",
                      data: {
                      labels: xValues,
                      datasets: [{
                        backgroundColor: "blue",
                        data: yValues
                      }]
                    },
                      options: {
                        legend: {display: false},
                        title: {
                          display: true,
                          text: "thống kê"
                        },
                        scales: {
                          xAxes: [{ticks: {min: -1, max:max}}]
                        }
                      }
                    });
            }  
            else {
                
            }
          } 
        };
        xmlhttp.open("GET", "thongke.php?keywork=" + input, true);
        xmlhttp.send();
}
function deleteitem(val) {
  $(".item"+ val).css('display','none');
  $("#soluong"+ val).val(0);
  sum();
}

function show(val) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          if(this.responseText != "") {
            debugger
            
              var data = JSON.parse(this.responseText)[0];
              data.ship = data.ship == ""? 0 :data.ship;
              var total = 0;
              var totalall = parseFloat(data.ship) * 1000;
              $('#maDH').text(data.maDH);
              $('#date').text(data.date);
              $('#ship').text(data.ship);
              $('#sdtKH').text(data.sdtKH);
              $('#diachi').text(data.diachi);
              $('#tenKH').text(data.tenKH);
              var detail = data.detail;
              detail.forEach(function (item) {
                total += item.soluong *item.price;
                totalall += item.soluong *item.price;
                  var html  = '<tr>'+
                              '<td colspan="1" rowspan="1">'+
                              '    <div class="pk-e2g"'+
                              '       style="transform: translate(0px, 0.710259px); top: 51px; left: 0px; width: 233.619px; height: 65.2293px;">'+
                              '       <div class="SGRppg" style="padding: 12px;">'+
                              '            <div class="fYDM2A" style="justify-content: center;">'+
                              '                <div class="Op_PdA">'+
                              '                    <div lang="vi-VN" class="_3stTEQ imh8lg">'+
                              '                        <p class="ok-Wdg UPenfA RVfbug"'+
                              '                            style=" font-size: 13.3333px; color: rgb(30, 50, 86); line-height: 18px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">'+
                              '                            <span class="S1PPyQ"'+
                              '                                style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">'+item.tenSP+'</span><span class="S1PPyQ SXLJUQ"'+
                              '                                style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">'+
                              '                            </span>'+
                              '                        </p>'+
                              '                    </div>'+
                              '                </div>'+
                              '            </div>'+
                              '        </div>'+
                              '    </div>'+
                              '</td>'+
                              '<td colspan="1" rowspan="1">'+
                              '    <div class="pk-e2g"'+
                              '        style="transform: translate(0.618873px, 0.710259px); top: 51px; left: 233px; width: 156.344px; height: 65.2293px;">'+
                              '        <div class="SGRppg" style="padding: 12px;">'+
                              '            <div class="fYDM2A" style="justify-content: center;">'+
                              '                <div class="Op_PdA">'+
                              '                    <div lang="vi-VN" class="_3stTEQ imh8lg">'+
                              '                        <p class="ok-Wdg UPenfA RVfbug"'+
                              '                            style=" font-size: 14.7075px; color: rgb(30, 50, 86); line-height: 20px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">'+
                              '                            <span class="S1PPyQ"'+
                              '                                style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">'+item.soluong+'</span>'+
                              '                        </p>'+
                              '                    </div>'+
                              '                </div>'+
                              '            </div>'+
                              '        </div>'+
                              '    </div>'+
                              '</td>'+
                              '<td colspan="1" rowspan="1">'+
                              '    <div class="pk-e2g"'+
                              '        style="transform: translate(0.963008px, 0.710259px); top: 51px; left: 389px; width: 125.596px; height: 65.2293px;">'+
                              '        <div class="SGRppg" style="padding: 12px;">'+
                              '            <div class="fYDM2A" style="justify-content: center;">'+
                              '                <div class="Op_PdA">'+
                              '                    <div lang="vi-VN" class="_3stTEQ imh8lg">'+
                              '                        <p class="ok-Wdg UPenfA RVfbug"'+
                              '                            style=" font-size: 14.7075px; color: rgb(30, 50, 86); line-height: 20px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">'+
                              '                            <span class="S1PPyQ"'+
                              '                                style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">'+new Intl.NumberFormat('en-VN', { maximumSignificantDigits: 3 }).format(item.price)+' VNĐ</span>'+
                              '                        </p>'+
                              '                    </div>'+
                              '                </div>'+
                              '            </div>'+
                              '        </div>'+
                              '    </div>'+
                              '</td>'+
                              '<td colspan="1" rowspan="1">'+
                              '    <div class="pk-e2g"'+
                              '        style="transform: translate(0.558901px, 0.710259px); top: 51px; left: 515px; width: 119.402px; height: 65.2293px;">'+
                              '        <div class="SGRppg" style="padding: 12px;">'+
                              '            <div class="fYDM2A" style="justify-content: center;">'+
                              '                <div class="Op_PdA">'+
                              '                    <div lang="vi-VN" class="_3stTEQ imh8lg">'+
                              '                        <p class="ok-Wdg OasF_A RVfbug"'+
                              '                            style=" font-size: 14.7075px; color: rgb(30, 50, 86); line-height: 20px; letter-spacing: 0em; --para-spacing:0; text-transform: none; --head-indent:0; --numeric-list-marker:none; list-style-type: none;">'+
                              '                            <span class="S1PPyQ"'+
                              '                                style="font-weight: 400; font-style: normal; color: rgb(30, 50, 86); text-decoration: none;">'+new Intl.NumberFormat('en-VN', { maximumSignificantDigits: 3 }).format(item.soluong * item.price)+' VNĐ</span>'+
                              '                        </p>'+
                              '                    </div>'+
                              '                </div>'+
                              '            </div>'+
                              '        </div>'+
                              '    </div>'+
                              '</td>'+
                              '</tr>';
                          $('#detail').append(html); 
              }) 
              $('#total').text(new Intl.NumberFormat('en-VN', { maximumSignificantDigits: 3 }).format(total))
              $('#totalall').text(new Intl.NumberFormat('en-VN', { maximumSignificantDigits: 3 }).format(totalall))
          }  
          else {
              
          }
      } 
      };
  xmlhttp.open("GET", "hoadon.php?id=" + val, true);
  xmlhttp.send();
  var modal = document.getElementById("myModal");
  modal.style.display = "block";
}