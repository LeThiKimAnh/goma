$(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
$("div.alert").delay(3000).slideUp();


function xacnhanxoa(msg){
	if(window.confirm(msg)){
		return true;
	}
	return false;
}
function logout(){
	$('#logout').submit();
}
var stt1 = 1;
var i1 = 1;
function del_row(i){
	$('#row_'+i).remove();
	i1 = i1-1;
}
$(document).ready(function(){
	var cout1 = $('#chon_vd').attr("cout");
	
	$('#btn_them_vd').click(function(){
			var select1 = document.getElementById('select').outerHTML;
			stt1 = stt1+1;
		if(i1<=cout1-1){
			var str1 = '<tr class="odd gradeX" align="center" id="row_'+stt1+'">'+
				             '<td>'+
				             	select1+
				             '</td>'+
				             '<td><input class="form-control" name="soLuong[]""></input></td>'+
				             '<td>cái</td>'+
				             '<td>'+
				             	'<a id="del_row'+stt1+'" class="btn glyphicon glyphicon-remove" onclick ="return del_row('+stt1+')" type="button">'+
				             '</td>'+
			             '</tr>';
			$('#chon_vd').append(str1);
			i1 = i1+1
		}else{
			$('#insert_erro_vd').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Rất tiếc!</strong>Bạn không thể thêm nữa!!</div>");
		}
	});
	$("#datepicker").datepicker({      
		autoclose: true,         
		todayHighlight: true 
		}).datepicker('update', new Date());

	$("#datepicker_edit").datepicker({        
		autoclose: true,         
		todayHighlight: true 
		}).datepicker('update', new Date());

});
function check(key,dl){
	for(var i = 0; i < dl.length; i++) {
        if(dl[i] == key) return true;
    }
    return false;
}
function check_vd(arr){
	var map = {}, i, size;

    for (i = 0, size = arr.length; i < size; i++){
        if (map[arr[i]]){
            return false;
        }

        map[arr[i]] = true;
    }

    return true;
}

function checkdata(){
	var vatdung_obj = document.getElementsByName('vatdung[]');
	var vatdung = [];
	var soluong_obj = document.getElementsByName('soLuong[]');
	var soluong = [];
	for(var i = 0; i<vatdung_obj.length;i++){
		vatdung[i] = vatdung_obj[i].value;
	}
	for(var i = 0; i<soluong_obj.length;i++){
		soluong[i] = soluong_obj[i].value;
	}
	console.log(check_vd(vatdung));
	if(check("0",vatdung)||check("0",soluong)||check("",soluong)){
		$('#insert_erro_vd').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn nên xem lại để điền đầy đủ thông tin!!</div>");
	}else if(!check_vd(vatdung)){
		$('#insert_erro_vd').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn không được chọn các loại vật dụng khác nhau :))!!</div>");
	}else{
		$('#donhang').submit();
	}


}
function checkedit(){
	var vatdung_obj = document.getElementsByName('vatdung[]');
	var vatdung = [];
	var soluong_obj = document.getElementsByName('soLuong[]');
	var soluong = [];
	for(var i = 0; i<vatdung_obj.length;i++){
		vatdung[i] = vatdung_obj[i].value;
	}
	for(var i = 0; i<soluong_obj.length;i++){
		soluong[i] = soluong_obj[i].value;
	}
	console.log(check_vd(vatdung));
	if(check("0",vatdung)||check("0",soluong)||check("",soluong)){
		$('#insert_erro_vd_edit').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn nên xem lại để điền đầy đủ thông tin!!</div>");
	}else if(!check_vd(vatdung)){
		$('#insert_erro_vd_edit').append("<div class='alert alert-warning fade in' aria-label='close'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Cảnh báo!</strong>Bạn không được chọn các loại vật dụng khác nhau :))!!</div>");
	}else{
		$('#dh_edit').submit();
	}
}

var stt =1;
var i = 1;
function del_row_vl(a){
	$('#rowvd_'+a).remove();
	i = i-1;
}
$(document).ready(function(){
	var cout = $('#chon_nl').attr("cout");

	$('#btn_them_nl').click(function(){
		var select = document.getElementById('select').outerHTML;
		stt = stt + 1;
		
		if(i<=cout-1){
			var str = '<tr class="odd gradeX" align="center" id="rowvd_'+stt+'">'+
	             '<td>'+
	                select+
	             '</td>'+
	             '<td><input class="form-control" id="{!!$item["id"]!!}" name="soLuong[]"></input></td>'+
	             '<td>cái</td>'+
				             '<td>'+
				             	'<a class="btn glyphicon glyphicon-remove" onclick ="return del_row_vl('+stt+')" type="button">'+
				             '</td></tr>';
			$('#chon_nl').append(str);
			i = i+1
		}else{
			$('#insert_erro').append("<strong>Rất tiếc!</strong>Bạn không thể thêm nữa!!");
		}
	})
});
