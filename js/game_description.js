$(document).ready(function(){
	$("#slider").on("input",function(){
		$("#slider-value").html(this.value);
	});
});