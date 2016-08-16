$("div.alert").delay(3000).slideUp();
function xacnhanxoa(msg) {
	if (window.confirm(msg)) {
		return true;
	}
	return false;
}
function logout() {
	$('#logout').submit();
}
var stt1 = 1;
var i1 = 1;
function del_row(i) {
	$('#row_' + i).remove();
	i1 = i1 - 1;
}

$(document).ready(function() {
	var cout1 = $('#chon_vd').attr("cout");

	$('#btn_them_vd').click(function() {
		var select1 = document.getElementById('select_vd_hide').outerHTML;
		stt1 = stt1 + 1;
		if (i1 <= cout1 - 1) {
			var str1 = '<tr class="odd gradeX" align="center" id="row_' + stt1 + '">' +
							'<td>' +
							select1 +
							'</td>' +
							'<td><input class="form-control" name="soLuong[]" style="text-align:right" type="number" min="0"></input></td>' +
							'<td>cái</td>' +
							'<td>' +
							'<a id="del_row' + stt1 + '" class="btn glyphicon glyphicon-remove" onclick ="return del_row(' + stt1 + ')" type="button">' +
							'</td>' +
							'</tr>';
			$('#chon_vd').append(str1);
			i1 = i1 + 1;
		} else {
			$('#insert_erro_vd').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Rất tiếc!</strong>Bạn không thể thêm nữa!!</div>");
		}
	});
	$("#datepicker").datepicker({
		autoclose: true,
		todayHighlight: true
	}).datepicker('update', new Date());

	$("#datepicker1").datepicker({
		autoclose: true,
		todayHighlight: true
	}).datepicker('update');
	$("#datepicker2").datepicker({
		autoclose: true,
		todayHighlight: true
	}).datepicker('update');

	$("#datepicker_edit").datepicker({
		autoclose: true,
		todayHighlight: true
	}).datepicker('update');

});
function check(key, dl) {
	for (var i = 0; i < dl.length; i++) {
		if (dl[i] == key)
			return true;
	}
	return false;
}
function check_vd(arr) {
	var map = {}, i, size;

	for (i = 0, size = arr.length; i < size; i++) {
		if (map[arr[i]]) {
			return false;
		}

		map[arr[i]] = true;
	}

	return true;
}

function checkdata() {
	var vatdung_obj = document.getElementsByName('vatdung[]');
	var vatdung = [];
	var soluong_obj = document.getElementsByName('soLuong[]');
	var soluong = [];
	for (var i = 1; i < vatdung_obj.length; i++) {
		vatdung[i] = vatdung_obj[i].value;
	}
	for (var i = 1; i < soluong_obj.length; i++) {
		soluong[i] = soluong_obj[i].value;
	}
	if (vatdung.length > 0) {
		console.log(check_vd(vatdung));
		if (check("0", vatdung) || check("0", soluong) || check("", soluong)) {
			$('#insert_erro_vd').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn nên xem lại để điền đầy đủ thông tin!!</div>");
		} else if (!check_vd(vatdung)) {
			$('#insert_erro_vd').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn không được chọn các loại vật dụng khác nhau :))!!</div>");
		} else {
			$('#donhang').submit();
		}
	} else {
		$('#insert_erro_vd').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn phải chọn ít nhất một vật dụng :))!!</div>");
	}


}
function checkedit() {
	var vatdung_obj = document.getElementsByName('vatdung[]');
	var vatdung = [];
	var soluong_obj = document.getElementsByName('soLuong[]');
	var soluong = [];
	for (var i = 1; i < vatdung_obj.length; i++) {
		vatdung[i] = vatdung_obj[i].value;
	}
	for (var i = 1; i < soluong_obj.length; i++) {
		soluong[i] = soluong_obj[i].value;
	}

	if (vatdung.length > 0) {
		if (check("0", vatdung) || check("0", soluong) || check("", soluong)) {
			$('#insert_erro_vd_edit').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn nên xem lại để điền đầy đủ thông tin!!</div>");
		} else if (!check_vd(vatdung)) {
			$('#insert_erro_vd_edit').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn không được chọn các loại vật giống khác nhau :))!!</div>");
		} else {
			$('#dh_edit').submit();
		}
	} else {
		$('#insert_erro_vd_edit').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn phải chọn ít nhất một vật dụng :))!!</div>");
	}
}
function checkvd() {
	var vatlieu_obj = document.getElementsByName('vatlieu[]');
	var vatlieu = [];
	var soLuong_obj = document.getElementsByName('soLuong[]');
	var soLuong = [];
	for (var i = 1; i < vatlieu_obj.length; i++) {
		vatlieu[i] = vatlieu_obj[i].value;
	}
	for (var i = 1; i < soLuong_obj.length; i++) {
		soLuong[i] = soLuong_obj[i].value;
	}
	var select = document.getElementById('select_vl_hide').outerHTML;
	if (vatlieu.length > 0) {
		if (check("0", vatlieu) || check("0", soLuong) || check("", soLuong)) {
			$('#insert_erro').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn nên xem lại để điền đầy đủ thông tin!!</div>");
		} else if (!check_vd(vatlieu)) {
			$('#insert_erro').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn không được chọn các loại vật liệu giống nhau :))!!</div>");
		} else {
			$('#vatdung_add').submit();
		}
	} else {
		$('#insert_erro').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn phải chọn ít nhất một vật liệu :))!!</div>");
	}
}

var stt = 1;
var i = 1;
function del_row_vl(a) {
	$('#rowvd_' + a).remove();
	i = i - 1;
}

$(document).ready(function() {
	var cout = $('#chon_nl').attr("cout");

	$('#btn_them_nl').click(function() {
		var select = document.getElementById('select_vl_hide').outerHTML;
		stt = stt + 1;

		if (i <= cout - 1) {
			var str = '<tr class="odd gradeX" align="center" id="rowvd_' + stt + '">' +
							'<td>' +
							select +
							'</td>' +
							'<td><input class="form-control" id="{!!$item["id"]!!}" name="soLuong[]" style="text-align:right" type="number" min="0"></input></td>' +
							'<td>cái</td>' +
							'<td>' +
							'<a class="btn glyphicon glyphicon-remove" onclick ="return del_row_vl(' + stt + ')" type="button">' +
							'</td></tr>';
			$('#chon_nl').append(str);
			i = i + 1
		} else {
			$('#insert_erro').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Rất tiếc!</strong>Bạn không thể thêm nữa!!</div>");
		}
	})
});

function fnExcelReport1() {
	var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
	var textRange;
	var j = 0;
	tab = document.getElementById('dataTables1'); // id of table
	// tab = document.getElementsByName('trdata');

	// for(j = 0 ; j < tab.length ; j++) 
	// {     
	//     tab_text=tab_text+tab[j].innerHTML+"</tr>";
	//     //tab_text=tab_text+"</tr>";
	// }

	for (j = 0; j < tab.rows.length; j++)
	{
		tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
		//tab_text=tab_text+"</tr>";
	}

	tab_text = tab_text + "</table>";
	tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
	tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
	tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE ");

	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
	{
		txtArea1.document.open("txt/html", "replace");
		txtArea1.document.write(tab_text);
		txtArea1.document.close();
		txtArea1.focus();
		sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
	}
	else                 //other browser not tested on IE 11
		sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

	return (sa);
}
function fnExcelReport() {
	var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
	var textRange;
	var j = 0;
	// tab = document.getElementById('dataTables'); // id of table
	tab = document.getElementsByName('trdata');

	for (j = 0; j < tab.length; j++)
	{
		tab_text = tab_text + tab[j].innerHTML + "</tr>";
		//tab_text=tab_text+"</tr>";
	}

	// for(j = 0 ; j < tab.rows.length ; j++) 
	// {     
	//     tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
	//     //tab_text=tab_text+"</tr>";
	// }

	tab_text = tab_text + "</table>";
	tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
	tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
	tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

	var ua = window.navigator.userAgent;
	var msie = ua.indexOf("MSIE ");

	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
	{
		txtArea1.document.open("txt/html", "replace");
		txtArea1.document.write(tab_text);
		txtArea1.document.close();
		txtArea1.focus();
		sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
	}
	else                 //other browser not tested on IE 11
		sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

	return (sa);
}

$(document).ready(function() {
	$(window).scroll(function() {
		if ($(this).scrollTop() > 50) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});
	// scroll body to 0px on click
	$('#back-to-top').click(function() {
		$('#back-to-top').tooltip('hide');
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	$('#back-to-top').tooltip('show');

});

var ItemPriceHistory = {};
$('#myModal').on('shown.bs.modal', function (event) {
	itemId = event.relatedTarget.getAttribute('data-params');
	function graphHistory(dl_chinh) {
		$(".chartContainer").CanvasJSChart({
                // backgroundColor: "#F5DEB4",
                animationEnabled: true,
                animationDuration: 2000,
                title: {
                    text: "Lịch sử giá"
                },
                axisY: {
                    // title: "Giá sản phẩm",
                    includeZero: false,
                    gridThickness:1
                    // minimum: 3
                },
                axisX: {
                    // title: "Ngày",
                    // titleFontColor: "green",
                    titleFontFamily: "verdana",
                    margin: 10,
                    // interval: 1
                },
                data:
                [
                {
                    type: "line",
                    toolTipContent: "{nguoi}: {y} VND <br/> {label}",
                    dataPoints: dl_chinh
                }
                ]
            
            });
	}
	var dl_chinh = ItemPriceHistory[itemId];
	if(dl_chinh == undefined) {
		$.getJSON ("/laravelapps/goma/public/vatdung/data/"+itemId,function(data){    
	        dl_chinh = new Array();
	       
	        for(var i = 0; i< data.length;i++){
	           var dl =  {
	                label: data[i].created_at,
	                y: parseInt(data[i].gia_cu),
	                nguoi: data[i].nguoi_sua
	            }
	            dl_chinh.push(dl);
	        }
	        ItemPriceHistory[itemId] = dl_chinh;
	        graphHistory(dl_chinh.reverse());
	    });
	} else {
		graphHistory(dl_chinh.reverse());
	}
});
