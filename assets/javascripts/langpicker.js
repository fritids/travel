function setlanguage(value){
	$.cookie("lang_code", value, { path: '/' });
    window.location.reload();
}