(function($) {

	"use strict";
	
// Toggle the side navigation when window is resized below 480px

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
	if ($("#sidebar").hasClass("active")) {
		$('#content').css('margin-left', '0px');
	}else{
		$('#content').css('margin-left', '300px');
	};
  });

  




  
})(jQuery);
