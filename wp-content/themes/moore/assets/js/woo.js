(function($){
	"use strict";

	// Popup Sinlge Gallery
	if( $('.woocommerce-product-gallery__image').length && typeof Fancybox != 'undefined' ){
		Fancybox.bind("[data-fancybox]", {
		  // Your options go here
		});
	} 
 
})(jQuery);