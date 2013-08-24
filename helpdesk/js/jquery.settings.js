
/* Form Style */
$(function(){

$(".stinput").focus(function(){

$(this).attr('class','stinput-active ');

});

$(".stinput").blur(function(){

$(this).attr('class','stinput');

});

});



/* Toogle */
$(document).ready(function(){
  $("a.ticketinfoclose").click(function(){
    $("#ticketinfo").slideToggle()
  });
});
