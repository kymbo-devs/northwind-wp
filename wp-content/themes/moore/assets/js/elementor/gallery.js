(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
    elementorFrontend.hooks.addAction('frontend/element_ready/moore_elementor_gallery.default', function(){
      // on click tabs element
      $(document).on('click', '.elementor-tab-title', function (e) {
        e.preventDefault();
        // Grid Gallery
        $('.ova-gallery').each( function() {
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

          // Popup Gallery
          if( $('.gallery-fancybox').length && typeof Fancybox != 'undefined' ){
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
       // not event click 
       // Grid Gallery
       $('.ova-gallery').each( function() {
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

        // Popup Gallery
        if( $('.gallery-fancybox').length && typeof Fancybox != 'undefined' ){
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
