var base_url = "http://localhost/dashboard/user/";



$(document).ready(function(){
	$("body").on( "change", "#role", function() {
	  $val = $(this).val();
	  if($val == 1)
	  {
		 $(".super_user").show();
	  }
	  else
	  {
		 $(".super_user").hide();
	  }
	 
	});
	
	
	$("body").on( "click", "#add_setting", function() {
	event.preventDefault();
	
	var new_setting = "";
	
	 $( "<h2>hello</h2>" ).insertBefore( $( this ) );

	});
	
	
	$("body").on( "change", "#location_adduser", function() {
	
	
	//$("#location_submit").submit();
	
	});
	
	
	
	
	
	
	
	
	
	
	
	
});