$(function() {
	$('.image-profil').click(function() {

	 if ($('.boite-menu').hasClass("hidden") ) {
			$('.boite-menu').removeClass("hidden");
			$('.boite-menu').addClass("showed");	
			/*$('.boite-menu').show();*/
	 		}
	 else {
		$('.boite-menu').removeClass("showed");	
		$('.boite-menu').addClass("hidden");		
		/*$('.boite-menu').hide();*/
	 	}

	});

});



