<?php if ( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'Moore_Ajax_Filter' ) ){
	class Moore_Ajax_Filter{

		public function __construct(){
			add_action( 'wp_ajax_load_room_filter', array( $this, 'load_room_filter') );
			add_action( 'wp_ajax_nopriv_load_room_filter', array( $this, 'load_room_filter') );
		
		}

		/* Ajax Load Post Click Elementor */
		public static function load_room_filter() {

      check_ajax_referer( apply_filters( 'moore_ajax_security', 'ajax_theme' ), 'security' );

			$post_per_page = isset( $_POST['post_per_page'] ) ? sanitize_text_field( $_POST['post_per_page'] ) : 5;
            $paged         = isset( $_POST['paged'] ) ? sanitize_text_field( $_POST['paged'] ) : '';
            $type_room     = isset( $_POST['type_room'] ) ? sanitize_text_field( $_POST['type_room'] ) : 'all';
            $features_room = isset( $_POST['features_room'] ) ? sanitize_text_field( $_POST['features_room'] ) : 'all';
             // area
            $area_value_start = isset( $_POST['area_value_start'] ) ? $_POST['area_value_start']  : 0;
            $area_value_end   = isset( $_POST['area_value_end'] ) ?  $_POST['area_value_end']  : 200;
            // price
            $price_value_start = isset( $_POST['price_value_start'] ) ? sanitize_text_field( $_POST['price_value_start'] ) : 0;
            $price_value_end   = isset( $_POST['price_value_end'] ) ? sanitize_text_field( $_POST['price_value_end'] ) : 200;
             // floor
            $floor_value_from = isset( $_POST['floor_value_from'] ) ? sanitize_text_field( $_POST['floor_value_from'] ) : 1;
            $floor_value_to   = isset( $_POST['floor_value_to'] ) ? sanitize_text_field( $_POST['floor_value_to'] ) : 30;
            // rooms value
            $rooms_value  = isset( $_POST['rooms_value'] ) ? sanitize_text_field( $_POST['rooms_value'] ) : 'all';

            $args = array(
                'post_type' => 'ova_room',
                'posts_per_page' => $post_per_page,
                'orderby'       => 'name',
                'order'         => 'ASC',
                'paged'        => $paged,
            );
            $args['tax_query'] = array();

            if ( 'all' != $type_room ) {
                $args_type_room = array(
                    'taxonomy' => 'cat_room',
                    'field'    => 'slug',
                    'terms'    => $type_room,
                );
                array_push( $args['tax_query'], $args_type_room );
            }

            if ( 'all' != $features_room ) {
                $args_features_room = array(
                    'taxonomy' => 'features_room',
                    'field'    => 'slug',
                    'terms'    => $features_room,
                );
                array_push( $args['tax_query'], $args_features_room );
            };

            $args['meta_query'] = array('relation' => 'AND');
            // area filter
            if ( $area_value_start || $area_value_end ) {
                $args_area_value = array(
					'relation' 	=> 'AND',
                    array(
						'key' 		=> 'ova_moorearea',
						'value' 	=> $area_value_start,
						'compare' 	=> '>=',
                        'type'  => 'NUMERIC'
					),
					array(
						'key' 		=> 'ova_moorearea',
						'value' 	=> $area_value_end,
						'compare' 	=> '<=',
                        'type'  => 'NUMERIC'
					),
				);
                array_push( $args['meta_query'], $args_area_value );
			}
             // price filter
             if ( $price_value_start || $price_value_end ) {
                $args_price_value = array(
					'relation' 	=> 'AND',
                    array(
						'key' 		=> 'ova_mooreprice',
						'value' 	=> $price_value_start,
						'compare' 	=> '>=',
                        'type'  => 'NUMERIC'
					),
					array(
						'key' 		=> 'ova_mooreprice',
						'value' 	=>  $price_value_end,
						'compare' 	=> '<=',
                        'type'  => 'NUMERIC'
					),
				);
                array_push( $args['meta_query'], $args_price_value );
			}
            //floor filter
            if ( $floor_value_from || $floor_value_to ) {
                $args_floor_value = array(
					'relation' 	=> 'AND',
                    array(
						'key' 		=> 'ova_moorefloor',
						'value' 	=> $floor_value_from,
						'compare' 	=> '>=',
                        'type'  => 'NUMERIC'
					),
					array(
						'key' 		=> 'ova_moorefloor',
						'value' 	=> $floor_value_to,
						'compare' 	=> '<=',
                        'type'  => 'NUMERIC'
					),
				);
                array_push( $args['meta_query'],  $args_floor_value );
			}
            //  rooms filter
            if ( $rooms_value != 'all' && $rooms_value != '4' ) {
                $args_rooms_value = array(
						'key' 		=> 'ova_moorebedrooms',
						'value' 	=> $rooms_value,
						'compare' 	=> '=',
                        'type'  => 'NUMERIC'
					);
                array_push( $args['meta_query'],  $args_rooms_value );
			};

            if ( $rooms_value == '4' ) {
                $args_rooms_value = array(
						'key' 		=> 'ova_moorebedrooms',
						'value' 	=> $rooms_value,
						'compare' 	=> '>=',
                        'type'  => 'NUMERIC'
					);
                array_push( $args['meta_query'],  $args_rooms_value );
			};
           
            $ajax_room_filter = new \WP_Query( $args );
            $number_results_found_filter = $ajax_room_filter->found_posts;
            ?>

            <?php
            
			if(  $ajax_room_filter->have_posts() ) : while(  $ajax_room_filter->have_posts() ) :  $ajax_room_filter->the_post();

                    $room_id   = get_the_ID();
                        
                    $mooredate = get_post_meta( $room_id, 'ova_mooredate', true );
                    $room_date = date('d/m', strtotime( $mooredate ));
                    $square    = get_post_meta( $room_id, 'ova_moorearea', true ).' ';
                    $bedrooms  = get_post_meta( $room_id, 'ova_moorebedrooms', true );
                    $floor     = get_post_meta( $room_id, 'ova_moorefloor', true );
                    // *****************
                    $total_price  = get_post_meta( $room_id, 'ova_mooretotal', true );
                    // *****************
                    $icon_group   = get_post_meta( $room_id, 'wiki_test_repeat_group', true );
                    // ******************
                    $url_image    = get_the_post_thumbnail_url( $room_id );
                    // for popup
                    $url_image_popup = get_post_meta( $room_id, 'ova_mooreimage_popup', true );
                    $url_send_request = get_post_meta( $room_id, 'ova_mooreurl_send_request', true );
					$url_file_layout = get_post_meta( $room_id, 'ova_moorefile_layout', true );
                    $path = str_replace( site_url('/'), ABSPATH, esc_url( $url_file_layout) );
					$size_file_layout = size_format( filesize( $path ), 1 );

			?>
                
                <div class="room room_filter_ajax">
                   
                   <div class="date">
                       <p class="room-date"><?php echo esc_html( $room_date ); ?></p>
                   </div>

                   <div class="plan">
                       <?php if ( $url_image ) :?>
                          <img src="<?php echo esc_url( $url_image ); ?>" alt="<?php echo the_title();?>">
                       <?php endif; ?>

                       <p class="square">
                           <?php echo esc_html( $square ); ?>
                           <?php esc_html_e( 'M', 'moore' ); ?><sub>2</sub>
                       </p>
                   </div>
                       
                   <div class="bed-floor">
                       <p class="bedrooms">
                           <?php esc_html_e('Bedrooms','moore')?>
                           <?php echo esc_html( $bedrooms ); ?>
                        </p>
                       <p class="floor">
                           <?php esc_html_e('Floor ','moore')?>
                           <?php echo esc_html( $floor ); ?>
                        </p>
                   </div>

                   <div class="price">
                       <p class="total_price"><?php echo esc_html( $total_price ); ?></p>
                   </div>

                   <div class="icon_group">
                       <?php if(is_array( $icon_group )) :foreach( $icon_group as $icons ) : foreach( $icons as $icon): ?>
                           <div class="icons">
                               <i class="<?php echo esc_attr( $icon ) ; ?>"></i>
                           </div>
                       <?php endforeach; endforeach; endif;?>
                   </div>
                   <div class="hidden-info-popup">
						<h2 class="title">
							<?php the_title(); ?>
						</h2>
                        <img src="<?php echo esc_url( $url_image_popup ); ?>" alt="<?php echo the_title();?>" class="url_image_popup">
                        <span class="url_send_request">
						    <?php echo esc_html( $url_send_request ); ?>
						</span>
                        <span class="url_file_layout">
						    <?php echo esc_html( $url_file_layout ); ?>
						</span>
                        <span class="size_file_layout">
						    <?php echo esc_html( $size_file_layout ); ?>
						</span>
					</div>
                    
               </div>

              <?php endwhile; ?>
                <div class="data-number-result" data-number_results_found_filter="<?php echo esc_attr( $number_results_found_filter ); ?>"></div>
              <?php  else:  wp_die(); ?>
             <?php endif; wp_reset_postdata(); ?>
				<!-- button -->
               
			<?php

			wp_die();
		}

		

	}
	new Moore_Ajax_Filter();
}
?>
