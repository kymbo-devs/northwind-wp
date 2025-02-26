(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
      elementorFrontend.hooks.addAction('frontend/element_ready/moore_elementor_room_list.default', function(){
            var flag = false;
            // Event click Load More Button
            $(".button-room").on( "click", function() {
                 var that = $(this);
                var post_per_page  = $(this).data('post_per_page');
                var paged      = parseInt( $(this).attr('data-paged') );
                var type_room  = $(this).data('type_room');
                var features_room  = $(this).data('features_room');
               $.ajax({
                    url: ajax_object.ajax_url,
                    type: 'POST',
                    data: ({
                       action: 'load_room_list',
                        paged : paged,
                        post_per_page: post_per_page,
                        type_room : type_room,
                        features_room : features_room,
                        security: ajax_object.ajax_nonce
                    }),
                 success: function( response ){
                    var data = response;
                    
                    if ( data.length > 30 ) {
                        $('.ova-room-list').append( data ).fadeIn(300);
                     } else {
                        $('.button-room').css('display','none');
                        $('.button-room-nodata').css('display','block');
                     }
                    var new_paged     = parseInt( paged ) + 1;
                    $('.button-room').attr('data-paged',new_paged );

                    load_room_in_ajax_popup();
                    
                  },
                  

               });

              load_room_in_ajax_popup();

            });

            // Event click div room
            load_room_popup();
            function load_room_popup(){
               $('.ova-room-list .room').on('click', function (e) {
                  e.preventDefault();
                  load_popup_right ( $(this) );
                  $(this).closest('.ova-room-list').find('.right').toggleClass('toggled');
                 
               });
            }

            function load_room_in_ajax_popup(){
               $('.ova-room-list .room_ajax').on('click', function (e) {
                  e.preventDefault();
                  load_popup_right ( $(this) );
                  $(this).closest('.ova-room-list').find('.right').toggleClass('toggled');
                 
               });
            }
           

            if( $('.site-overlay').length > 0 ){
               $('.site-overlay').on('click', function () {
                  $(this).closest( '.right' ).toggleClass('toggled');
                  $('.ova-room-list .room-toggle').toggleClass('show');
               });
            }

            if( $('.room-toggle').length > 0 ){
               $('.room-toggle').on('click', function () {
                  $(this).closest( '.right' ).toggleClass('toggled');
                  $('.ova-room-list .room-toggle').toggleClass('show');
               });
            }
            
            // function load popup right
            function load_popup_right( $this ) {
               
               var room_popup  = $this.closest( '.ova-room-list' ).find('.right');
               // get data
               var total_price = $this.find('.total_price').text();
               var title       = $this.find('.title').text();
               var date        = $this.find('.room-date').text();
               var square      = $this.find('.square').text();
               var bedrooms    = $this.find('.bedrooms').text();
               var floor       = $this.find('.floor').text();
               var icon_group  = $this.find('.icon_group').html();
               var url_image_popup    = $this.find('.url_image_popup').prop('src');
               var url_send_request   = $this.find('.url_send_request').text();
               var url_file_layout    = $this.find('.url_file_layout').text();
               var size_file_layout   = $this.find('.size_file_layout').text();
               // append data for right div
               room_popup.find('.title-popup').html('').append(title);
               room_popup.find('.date-popup').html('').append(date);
               room_popup.find('.total_price_popup').html('').append(total_price);
               room_popup.find('.square-popup').html('').append(square);
               room_popup.find('.bedrooms-popup').html('').append(bedrooms);
               room_popup.find('.floor-popup').html('').append(floor);
               room_popup.find('.icon_group_popup').html('').append(icon_group);
               room_popup.find('.room-image-popup').prop('src',url_image_popup);
               room_popup.find('.url-send-request-popup').prop('href',url_send_request);
               room_popup.find('.url-file-layout-popup').prop('href',url_file_layout);
               room_popup.find('.size-file-layout-popup').html('').append(size_file_layout);
               // **************************
            }

      });

    });


})(jQuery);
