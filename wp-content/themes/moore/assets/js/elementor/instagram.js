(function($){
	"use strict";

	$(window).on('elementor/frontend/init', function () {
        
		elementorFrontend.hooks.addAction('frontend/element_ready/moore_elementor_instagram.default', function(){

			$('.ova-instagram .slide').each(function(){
				var owl = $(this);
				var data = owl.data('instagram_slide');
				
				owl.owlCarousel(
					data
					);
			});
			
		});

   });

})(jQuery);



