$(document).ready(function() {
	
	
    $('#dataTables-example').DataTable({
            responsive: true
    });

    // addImages-Click
    $("#addImages").click(function(){
    	var str = $('#insert').html() + '<div class="form-group"><input type="file" name="fEditImage[]" /></div>';
    	//alert (str);
    	$("#insert").html(str);
    	//$("#insert").html(('<div class="form-group"><input type="file" name="fEditImage[]" /></div>');
	});
	// end addImages-Click
	
	// del_img_demo-Click
	$('a#del_img_demo').on('click',function(){
		var url 	= 'http://localhost/framework/project1/admin/product/delimg/';
		var _token	= $("form[name='frmEditProduct']").find('input[name="_token"]').val();
		var idHinh 	= $(this).parent().find("img").attr('id');
		var img 	= $(this).parent().find("img").attr('src');
		var rid 		= $(this).parent().find("img").attr('id');
		$.ajax({
			url: 	url + rid,
			type: 	'GET',
			cache: 	false,
			data: 	{"_token":_token,"idHinh":idHinh,"urlHinh":img},
			success: function(data){
				if(data=="2788"){
					$("#hinh"+rid).remove();
				}else{
					alert('Xảy ra lỗi khi xóa.');
				}
			} 
		});
		//alert(rid);
	})
	// end del_img_demo-Click
});

$("div.alert").delay(3000).slideUp();

function xacnhanxoa(msg){
	if(window.confirm(msg)){
		return true;
	}
	return false;
}
