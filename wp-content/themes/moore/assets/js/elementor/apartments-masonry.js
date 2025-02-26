(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
    elementorFrontend.hooks.addAction('frontend/element_ready/moore_elementor_apartments_masonry.default', function(){
      // Grid Gallery
      $('.ova-apartments-masonry').each( function() {
        var that = $(this);
        var grid = that.find('.grid');
        var run  = grid.masonry({
          itemSelector: '.grid-item',
          columnWidth: '.grid-sizer',
          gutter: 0,
          percentPosition: true,
          transitionDuration: 0,
        });

        run.imagesLoaded().progress( function() {
          run.masonry();
        });

       
        
      });
    });
  });

})(jQuery);
