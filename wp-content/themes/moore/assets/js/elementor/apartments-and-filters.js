(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
       elementorFrontend.hooks.addAction('frontend/element_ready/moore_elementor_apartments_and_filters.default', function(){
            // Initialize slider:
            $(document).ready(function() {
               // ranger slider area
               var rangeSliderArea = document.getElementById('slider-range-area');
               var minArea = $('.ova-rooms-filter').data('range_area_min') ? $('.ova-rooms-filter').data('range_area_min') : 0;
               var maxArea = $('.ova-rooms-filter').data('range_area_max') ? $('.ova-rooms-filter').data('range_area_max') : 200;
               var clearFilter = document.getElementById('clear-filter');

               if (rangeSliderArea) {
                   noUiSlider.create(rangeSliderArea, {
                       start: [minArea, maxArea],
                       connect: true,
                       step: 1,
                       range: {
                           'min': minArea,
                           'max': maxArea
                       },
                       tooltips: true,
                       format: {
                         from: function(value) {
                                 return parseInt(value);
                             },
                         to: function(value) {
                                 // Format number with thousands separator (.) and decimal separator (,) and append m²
                                 return new Intl.NumberFormat('es-ES', {
                                     minimumFractionDigits: 0,
                                     maximumFractionDigits: 0
                                 }).format(value) + ' m²';
                             }
                       }
                   });
                   // Set visual min and max values
                   var range_area_start = document.getElementById('range-area-start');
                   var range_area_end   = document.getElementById('range-area-end');

                   rangeSliderArea.noUiSlider.on('update', function(values, handle) {
                      range_area_start.value = values[0];
                      range_area_end.value = values[1];
                   });
               }

               // ranger slider price
               var rangeSliderPrice = document.getElementById('slider-range-price');
               var minPrice = $('.ova-rooms-filter').data('range_price_min') ? $('.ova-rooms-filter').data('range_price_min') : 0;
               var maxPrice = $('.ova-rooms-filter').data('range_price_max') ? $('.ova-rooms-filter').data('range_price_max') : 200;
               
               if (rangeSliderPrice) {
                   noUiSlider.create(rangeSliderPrice, {
                       start: [minPrice, maxPrice],
                       connect: true,
                       step: 1,
                       range: {
                           'min': minPrice,
                           'max': maxPrice
                       },
                       tooltips: true,
                       format: {
                         from: function(value) {
                                 return parseInt(value);
                             },
                         to: function(value) {
                                 // Format number with thousands separator (.) and add € symbol
                                 return new Intl.NumberFormat('es-ES', {
                                     style: 'currency',
                                     currency: 'EUR',
                                     minimumFractionDigits: 0,
                                     maximumFractionDigits: 0
                                 }).format(value);
                             }
                       }
                   });
                   // Set visual min and max values 
                   var range_price_start = document.getElementById('range-price-start');
                   var range_price_end   = document.getElementById('range-price-end');
                   rangeSliderPrice.noUiSlider.on('update', function(values, handle) {
                      range_price_start.value = values[0];
                      range_price_end.value = values[1];
                   });
               }

               // reset range value
               if (clearFilter) {
                   clearFilter.addEventListener('click', function () {
                       if (rangeSliderArea && rangeSliderArea.noUiSlider) {
                           rangeSliderArea.noUiSlider.reset();
                       }
                       if (rangeSliderPrice && rangeSliderPrice.noUiSlider) {
                           rangeSliderPrice.noUiSlider.reset();
                       }
                   });
               }

               //**********Range Slider Area On Change ********************* */
               if (rangeSliderArea && rangeSliderArea.noUiSlider) {
                   rangeSliderArea.noUiSlider.on('change', function() {
                       var form = $('#rooms-filter');
                       var click_loadmore = 0;
                       var paged = '';
                       form.closest('.ova-rooms-filter').find('.button-loadmore').attr('data-paged', 2);
                       moore_load_ajax(form, paged, click_loadmore);
                   });
               }
            
               //**********Range Slider Price On Change********************* */
               if (rangeSliderPrice && rangeSliderPrice.noUiSlider) {
                   rangeSliderPrice.noUiSlider.on('change', function() {
                       var form = $('#rooms-filter');
                       var click_loadmore = 0;
                       var paged = '';
                       form.closest('.ova-rooms-filter').find('.button-loadmore').attr('data-paged', 2);
                       moore_load_ajax(form, paged, click_loadmore);
                   });
               }
            }); 

            // number results found before action filter
            $('.results-filter').each(function(){
                 var number_results_found  =  $('.button-loadmore').data('number_results_found_filter');
                 $('.number-results-found').html('').append( number_results_found  );
            });

            // Event on input filter change
            $("#rooms-filter").on("change", "select", function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var click_loadmore = 0;
                var paged = '';
                form.closest('.ova-rooms-filter').find('.button-loadmore').attr('data-paged', 2);
                moore_load_ajax(form, paged, click_loadmore); 
            });

            // Event click Load More Button
            $(".button-loadmore").on("click", function(e) {
                e.preventDefault();
                var form = $('#rooms-filter');
                var click_loadmore = 1;
                var paged = parseInt($(this).attr('data-paged'));
                moore_load_ajax(form, paged, click_loadmore);
            });

            // Event click clear filter
            $(".clear-filter").on("click", function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var click_loadmore = 0;
                var paged = '';
                form.closest('.ova-rooms-filter').find('.button-loadmore').attr('data-paged', 2);
                
                // Reset all selects to default
                form.find('select').prop('selectedIndex', 0);
                
                moore_load_ajax(form, paged, click_loadmore);
            });

            function moore_load_ajax( form, paged , click_loadmore ){

               var post_per_page  =  form. closest('.ova-rooms-filter').find('.button-loadmore').data('post_per_page');
			   var current_category = form.find('input[name="current_category"]').val();
               var location      =  form.find('select[name="location"]').val();
               var regimen       =  form.find('select[name="regimen"]').val();
               var features_room  =  form.find('select[name="features"]').val();
               // get options filter area 
               var area_value_start  = form.find('#range-area-start').val();
               var area_value_end    = form.find('#range-area-end').val();
               // get options filter price
               var price_value_start = form.find('#range-price-start').val();
               var price_value_end   = form.find('#range-price-end').val();
               // get floor from-to value
               var floor_value_from = form.find('#from').val(); 
               var floor_value_to   = form.find('#to').val();
               // get room value
               var rooms_value      = form.find('#rooms').val();
                 $.ajax({
                  url: ajax_object.ajax_url,
                  type: 'POST',
                  data: ({
                     action: 'load_apartment_filter',
                     post_per_page: post_per_page,
                     location: location,
                     regimen: regimen,
                     paged : paged,
                     features_room : features_room,
                     area_value_start : area_value_start,
                     area_value_end :  area_value_end,
                     price_value_start : price_value_start,
                     price_value_end : price_value_end,
                     floor_value_from : floor_value_from,
                     floor_value_to : floor_value_to,
                     rooms_value : rooms_value,
					 current_category: current_category,
                     security: ajax_object.ajax_nonce
                  }),
                  success: function( response ){
                     if ( click_loadmore == 0 ) {
                        if ( response ) {
                           var wrap_form = form.closest('.ova-rooms-filter');
                           wrap_form.find('.results-filter').html('').append( response ).fadeIn(300);
                           // update number results found
                           var number_results_found_filter  =  wrap_form.find('.data-number-result').data('number_results_found_filter');
                           if (number_results_found_filter == undefined ) {
                              number_results_found_filter = 0 ;
                           };
                           wrap_form.find('.number-results-found').html('').append( number_results_found_filter  );
                           // show button loadmore
                           wrap_form.find('.button-loadmore').css('display','block');
                           wrap_form.find('.button-loadmore-nodata').css('display','none'); 
                        } ;
                     } else {
                        if ( response.length > 30 ) {
                           var wrap_form = form.closest('.ova-rooms-filter');
                           wrap_form.find('.results-filter').append( response ).fadeIn(300);
                           } else {
                              // show button nodata
                              $('.ova-rooms-filter .button-loadmore').css('display','none');
                              $('.ova-rooms-filter  .button-loadmore-nodata').css('display','block'); 
                             } ;
                           var new_paged     = parseInt( paged ) + 1;
                           $('.ova-rooms-filter .button-loadmore').attr('data-paged',new_paged );

                     };
            
                  }
               });
            }
           
            // hide rigth popup when click overlay
            if( $('.site-overlay').length > 0 ){
               $('.site-overlay').on('click', function () {
                  $(this).closest( '.right' ).toggleClass('toggled');
                  $('.ova-room-list .room-toggle').toggleClass('show');
               });
            }
            // hide rigth popup when click button close right popup
            if( $('.room-toggle').length > 0 ){
               $('.room-toggle').on('click', function () {
                  $(this).closest( '.right' ).toggleClass('toggled');
                  $('.ova-room-list .room-toggle').toggleClass('show');
               });
            }

         });
   });

})(jQuery);
