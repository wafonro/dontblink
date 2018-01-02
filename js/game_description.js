$(document).ready(function(){
	$("#slider").on("input",function(){
		$("#slider-value").html(this.value);
	});
	$("#to_game").click(function(){
		window.location.replace("../games/game1.php?value="+document.getElementById("slider").value);
	})
});