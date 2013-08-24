$(document).ready(function(){
	$('#search_country').live('change',function(e){
		var url = CI.base_url+"geodata/searchstates/"+$(this).val();
		$('#load_searchstates').load(url);
	});
	
	$('#search_state').live('change',function(e){
		var url = CI.base_url+"geodata/searchcities/"+$(this).val();
		$('#load_searchcities').load(url);
	});
	
	$('#search_city').live('change',function(e){
			
	});
	
	
});	