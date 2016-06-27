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
$(document).ready(function(){
	var cout1 = $('#chon_vd').attr("cout");
	var i1 = 1;
	$('#btn_them_vd').click(function(){
			var select1 = document.getElementById('select_vd').outerHTML;
			var str1 = '<tr class="odd gradeX" align="center">'+'<td>1</td>'+
			             '<td>'+
			             	select1+
			             '</td>'+
			             '<td><input class="form-control" name="soLuong[]""></input></td>'+
			             '<td>cái</td></td>';
		if(i1<=cout1-1){
			$('#chon_vd').append(str1);
			i1 = i1+1
		}else{
			$('#insert_erro_vd').append("<strong>Rất tiếc!</strong>Bạn không thể thêm nữa!!");
		}
	});
});
$(document).ready(function(){
	var cout = $('#chon_nl').attr("cout");
	var i = 1;
	$('#btn_them_nl').click(function(){
		var select = document.getElementById('select').outerHTML;
	var str = '<tr class="odd gradeX" align="center">'+'<td>1</td>'+
	             '<td>'+
	                select+
	             '</td>'+
	             '<td><input class="form-control" id="{!!$item["id"]!!}" name="soLuong[]"></input></td>'+
	             '<td>cái</td></td>';
		if(i<=cout-1){
			$('#chon_nl').append(str);
			i = i+1
		}else{
			$('#insert_erro').append("<strong>Rất tiếc!</strong>Bạn không thể thêm nữa!!");
		}
	})
});
