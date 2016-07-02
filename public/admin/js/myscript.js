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
var stt1 = 1;
var i1 = 1;
function del_row(i){
	$('#row_'+i).remove();
	i1 = i1-1;
}
$(document).ready(function(){
	var cout1 = $('#chon_vd').attr("cout");
	
	
	$('#btn_them_vd').click(function(){
			var select1 = document.getElementById('select_vd').outerHTML;
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
			$('#insert_erro_vd').append("<strong>Rất tiếc!</strong>Bạn không thể thêm nữa!!");
		}
	});

});

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
