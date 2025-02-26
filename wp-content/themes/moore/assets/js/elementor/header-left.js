(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/moore_elementor_header_left.default', function(){
	       
	        /* Add your code here */
	    	$('.ova-header-left .header-menu-toggle').on('click', function () {
	        	$(this).closest( '.ova-header-left' ).find('.right').toggleClass('toggled');
	            $(this).toggleClass('show');
				
	        });

	        
	        if( $('.header-left-site-overlay').length > 0 ){
	        	$('.header-left-site-overlay').on('click', function () {
		        	$(this).parents().toggleClass('toggled');
					$(this).closest('.ova-header-left').find('.header-menu-toggle').toggleClass('show');
		        });
	        }

	        if( $('.close-menu').length > 0 ){
	        	$('.close-menu').on('click', function () {
		        	$(this).parents().toggleClass('toggled');
					$(this).closest('.ova-header-left').find('.header-menu-toggle').toggleClass('show');
		        });
	        }

	        var $menu = $('.ova-header-left');

	        if ( $menu.length > 0 ) {
	            $menu.find('.menu-item-has-children > a, .page_item_has_children > a').each((index, element) => {
	                var $dropdown = $('<button class="dropdown-toggle"></button>');
	                $dropdown.insertAfter(element);
	            });
	            
	            $(document).on('click', '.ova-header-left .dropdown-toggle', function (e) {
	                e.preventDefault();
	                $(e.target).toggleClass('toggled-on');
	                $(e.target).siblings('ul').stop().toggleClass('show');
	            });
	            $(document).on('click', '.ova-header-left .close-menu', function (e) {
	                e.preventDefault();
	                $(e.target).toggleClass('toggled-on');
	                $(e.target).siblings('ul').stop().toggleClass('show');
	            });
	        }
	      

        });


   });

})(jQuery);
