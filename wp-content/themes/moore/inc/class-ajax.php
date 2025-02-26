<?php if ( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'Moore_Ajax' ) ){
	class Moore_Ajax{

		public function __construct(){
			add_action( 'wp_ajax_load_room_list', array( $this, 'load_room_list') );
			add_action( 'wp_ajax_nopriv_load_room_list', array( $this, 'load_room_list') );
		
		}

		/* Ajax Load Post Click Elementor */
		public static function load_room_list() {

      check_ajax_referer( apply_filters( 'moore_ajax_security', 'ajax_theme' ), 'security' );

			$post_per_page =  isset( $_POST['post_per_page'] ) ? sanitize_text_field( $_POST['post_per_page'] ) : 5;
            $paged         =  isset( $_POST['paged'] ) ? sanitize_text_field( $_POST['paged'] ) : 2 ;
            $type_room     =  isset( $_POST['type_room'] ) ? sanitize_text_field( $_POST['type_room'] ) : '';
            $features_room =  isset( $_POST['features_room'] ) ? sanitize_text_field( $_POST['features_room'] ) : '';
            $args = array(
                'post_type' => 'ova_room',
                'posts_per_page' => $post_per_page,
                'orderby'       => 'name',
                'order'         => 'ASC',
                'paged'        => $paged,
            );
            
            if ( ( 'all' != $type_room ) && ( 'all' === $features_room ) ) {
                $args['tax_query'] = array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'cat_room',
                        'field'    => 'slug',
                        'terms'    => array( $type_room ),
                    ),
                    array(
                        'taxonomy' => 'features_room',
                        'field'    => 'slug',
                        'terms'    => array( $features_room ),
                    ),
                );
            } elseif ( ( 'all' != $features_room ) && ( 'all' === $type_room ) ) {
                $args['tax_query'] = array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'cat_room',
                        'field'    => 'slug',
                        'terms'    => array( $type_room ),
                    ),
                    array(
                        'taxonomy' => 'features_room',
                        'field'    => 'slug',
                        'terms'    => array( $features_room ),
                    ),
                );
            } elseif ( ( 'all' != $features_room ) && ( 'all' != $type_room ) ) {
                $args['tax_query'] = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'cat_room',
                        'field'    => 'slug',
                        'terms'    => array( $type_room ),
                    ),
                    array(
                        'taxonomy' => 'features_room',
                        'field'    => 'slug',
                        'terms'    => array( $features_room ),
                    ),
                );
            };

            $ajax_room = new \WP_Query( $args );
          
            ?>
            <?php
			if(  $ajax_room->have_posts() ) : while(  $ajax_room->have_posts() ) :  $ajax_room->the_post();

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
					$url_image_popup  = get_post_meta( $room_id, 'ova_mooreimage_popup', true );
                    $url_send_request = get_post_meta( $room_id, 'ova_mooreurl_send_request', true );
					$url_file_layout  = get_post_meta( $room_id, 'ova_moorefile_layout', true );
                    $path = str_replace( site_url('/'), ABSPATH, esc_url( $url_file_layout) );
					$size_file_layout = size_format( filesize( $path ), 1 );
			?>
                 <div class="room room_ajax">
                   
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
                               <i class="<?php echo esc_attr($icon) ; ?>"></i>
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

               <?php endwhile; else:  wp_die(); ?>
					
				<?php endif; wp_reset_postdata(); ?>
                
			<?php

			wp_die();
		}

		

	}
	new Moore_Ajax();
}
?>
