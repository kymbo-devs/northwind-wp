(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/moore_elementor_gallery_simple.default', function(){
	       
                $('.gallery-simple-fancybox').each( function() {
                
                        // Popup Gallery Simple
                        if( $('.gallery-simple-fancybox').length && typeof Fancybox != 'undefined' ){
                          var group = $(this).data('group');
                          Fancybox.bind('[data-fancybox="'+group+'"]', {
                            'scrolling': 'no',
                            'speedIn': 600, 
                            'speedOut': 200, 
                            'overlayShow' : false,
                            caption: function (fancybox, carousel, slide) {
                              return (
                                `${slide.index + 1} / ${carousel.slides.length} <br />` + slide.caption
                              );
                            },
                          });
                        }
                        
                 });
	    	
	      

        });


   });

})(jQuery);
