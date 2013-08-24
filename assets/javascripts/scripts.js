$(document).ready(function () {
	

	// LIST AND GRID VIEW TOGGLE
	$('.view-type li:first-child').addClass('active');
		
	$('.grid-view').click(function() {
		$(".three-fourth article").attr("class", "one-fourth");
		$(".three-fourth article:nth-child(3n)").addClass("last");
		$(".view-type li").removeClass("active");
		$(this).addClass("active");
	});
	
	$('.list-view').click(function() {
		$(".three-fourth article").attr("class", "full-width");
		$(".view-type li").removeClass("active");
		$(this).addClass("active");
	});
	
});
