jQuery(document).ready(function(){
	jQuery("#search").submit(function(){
		
		var url ='admin.php?page=hccard&options=list';

		window.location.href=url+'&valid='+jQuery("#valid").val()+'&status='+jQuery("#status").val();
		return false; 
	});
	jQuery('.delete').click(function(){
		var id = jQuery(this).attr('data-id');
		var c = confirm('Bạn có muốn xóa thẻ cào này ?');
		if(c){
			jQuery.ajax({
			url:'?page=hccard&options=list&action=delete&id='+id,
			type:'POST',
			success:function(msg){
				alert('Thẻ cào đã được xóa.');
				jQuery("#item-"+id).fadeOut(500);
				return false
			}
		})
		}else
			return false;
		
	})
})