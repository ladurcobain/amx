var time_ajax = 30000; // sets timeout to 5 minutes
var time_show = 3000;  // sets timeout to 3 seconds
var time_done = 500; 


// ajax chain

// popup
function preview_data(id) {
	$('#modal-preview-data').modal()                      
	$('#modal-preview-data').modal({ keyboard: false, backdrop: 'static' })   
	$('#modal-preview-data').modal('show')   
	
	var uri = base_url + "ajax/preview-data";
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		data: $.param({ id:id }),
		success: function(msg) {
			$("#preview-data").fadeIn( 3000 );  			
			$("#preview-data").html(msg);                                                                     
		}
	}); 
		
	return false;
}
