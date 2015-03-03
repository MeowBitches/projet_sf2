
$(function(){
	$("#burger").click(function(){
		$("#burger").css("display","none"),
		$("#croix").css("display","block"),
		$(".nav").slideDown()
	}),

	$("#croix").click(function(){
		$("#croix").css("display","none"),
		$("#burger").css("display","block"),
		$(".nav").slideUp()
	})
});