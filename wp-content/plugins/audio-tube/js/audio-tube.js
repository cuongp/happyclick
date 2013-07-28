jQuery(document).ready( function($) {

	function initPic(){
		var theme = $("#atp_theme").is(":checked");
		var color = $("#atp_color").is(":checked");
		if (!theme && !color) {
		       $("#dark-red").show();
		       $("#dark-white").hide();
		       $("#light-red").hide();
		       $("#light-white").hide();
		 } else if(theme && !color) {
		       $("#dark-red").hide();
		       $("#dark-white").hide();
		       $("#light-red").show();
		       $("#light-white").hide();			
		} else if(!theme && color) {
		       $("#dark-red").hide();
		       $("#dark-white").show();
		       $("#light-red").hide();
		       $("#light-white").hide();
		} else {
		       $("#dark-red").hide();
		       $("#dark-white").hide();
		       $("#light-red").hide();
		       $("#light-white").show();
		}
	}
	
	function changePic(){
		var theme = $("#atp_theme").is(":checked");
		var color = $("#atp_color").is(":checked");
		if (!theme && !color) {
		       $("#dark-red").toggle(true);
		       $("#dark-white").toggle(false);
		       $("#light-red").toggle(false);
		       $("#light-white").toggle(false);
		 } else if(theme && !color) {
		       $("#dark-red").toggle(false);
		       $("#dark-white").toggle(false);
		       $("#light-red").toggle(true);
		       $("#light-white").toggle(false);			
		} else if(!theme && color) {
		       $("#dark-red").toggle(false);
		       $("#dark-white").toggle(true);
		       $("#light-red").toggle(false);
		       $("#light-white").toggle(false);
		} else {
		       $("#dark-red").toggle(false);
		       $("#dark-white").toggle(false);
		       $("#light-red").toggle(false);
		       $("#light-white").toggle(true);
		}
	}
	
	$('.hndle').click(function(){
	    $(this).next('.inside').toggle();
	    });
	
	$('.handlediv').click(function(){
	    $(this).nextAll('.inside').toggle();
	    });

	$("#atp_theme").click(changePic);
	$("#atp_color").click(changePic);
	
	initPic();
	
});
