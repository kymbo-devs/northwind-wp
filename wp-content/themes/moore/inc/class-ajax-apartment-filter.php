<?php if ( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'Moore_Ajax_Apartment_Filter' ) ){
    class Moore_Ajax_Apartment_Filter {

        public function __construct(){
            add_action( 'wp_ajax_load_apartment_filter', array( $this, 'load_apartment_filter') );
            add_action( 'wp_ajax_nopriv_load_apartment_filter', array( $this, 'load_apartment_filter') );
        }

        public static function load_apartment_filter() {

            check_ajax_referer( apply_filters( 'moore_ajax_security', 'ajax_theme' ), 'security' );

            $post_per_page = isset( $_POST['post_per_page'] ) ? sanitize_text_field( $_POST['post_per_page'] ) : 5;
            // Default paged to 1 if not provided
            $paged = isset( $_POST['paged'] ) ? sanitize_text_field( $_POST['paged'] ) : 1;
            $location = isset( $_POST['location'] ) ? sanitize_text_field( $_POST['location'] ) : 'all';
            $features = isset( $_POST['features_room'] ) ? sanitize_text_field( $_POST['features_room'] ) : 'all';

            // Clean the area values received (e.g. "474 m²" becomes 474)
            $raw_area_value_start = isset( $_POST['area_value_start'] ) ? $_POST['area_value_start'] : '0';
            $raw_area_value_end   = isset( $_POST['area_value_end'] ) ? $_POST['area_value_end'] : '0';
            $area_value_start = (int) preg_replace('/\D/', '', $raw_area_value_start);
            $area_value_end   = (int) preg_replace('/\D/', '', $raw_area_value_end);

            // Clean the price values (e.g. "1.320.000 €" becomes 1320000)
            $raw_price_value_start = isset( $_POST['price_value_start'] ) ? $_POST['price_value_start'] : '0';
            $raw_price_value_end   = isset( $_POST['price_value_end'] ) ? $_POST['price_value_end'] : '0';
            $price_value_start = (int) preg_replace('/\D/', '', $raw_price_value_start);
            $price_value_end   = (int) preg_replace('/\D/', '', $raw_price_value_end);
			
            // Current category filter (if any)
            $current_category = isset( $_POST['current_category'] ) ? sanitize_text_field( $_POST['current_category'] ) : '';

            // Build the basic query arguments
            $args = array(
                'post_type'      => 'ova_apartments',
                'posts_per_page' => $post_per_page,
                'orderby'        => 'name',
                'order'          => 'ASC',
                'paged'          => $paged,
            );

            // Build meta_query to filter numeric fields
            $meta_query = array('relation' => 'AND');

            // Location filter
            if ( $location !== 'all' ) {
                $meta_query[] = array(
                    'key'     => 'ova_apartment_location',
                    'value'   => $location,
                    'compare' => '='
                );
            }

            // Area range filter (using the key 'ova_apartment_tamano')
            if ( $area_value_start || $area_value_end ) {
                $meta_query[] = array(
                    'relation' => 'AND',
                    array(
                        'key'     => 'ova_apartment_tamano',
                        'value'   => $area_value_start,
                        'type'    => 'NUMERIC',
                        'compare' => '>='
                    ),
                    array(
                        'key'     => 'ova_apartment_tamano',
                        'value'   => $area_value_end,
                        'type'    => 'NUMERIC',
                        'compare' => '<='
                    )
                );
            }

            // Price range filter (using the key 'ova_apartment_precio')
            if ( $price_value_start || $price_value_end ) {
                $meta_query[] = array(
                    'relation' => 'AND',
                    array(
                        'key'     => 'ova_apartment_precio',
                        'value'   => $price_value_start,
                        'type'    => 'NUMERIC',
                        'compare' => '>='
                    ),
                    array(
                        'key'     => 'ova_apartment_precio',
                        'value'   => $price_value_end,
                        'type'    => 'NUMERIC',
                        'compare' => '<='
                    )
                );
            }
            $args['meta_query'] = $meta_query;

            // Build tax_query to filter taxonomies
            $tax_query = array();

            // Features filter
            if ( $features !== 'all' ) {
                $tax_query[] = array(
                    'taxonomy' => 'features_apartment',
                    'field'    => 'slug',
                    'terms'    => $features
                );
            }

            // Current category filter
            if ( !empty( $current_category ) ) {
                $tax_query[] = array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $current_category,
                );
            }

            if ( !empty( $tax_query ) ) {
                if ( count( $tax_query ) > 1 ) {
                    $tax_query['relation'] = 'AND';
                }
                $args['tax_query'] = $tax_query;
            }
			
            error_log("DEBUG: args for query: " . print_r($args, true));

            $apartments = new WP_Query($args);
            error_log("DEBUG: Query found " . $apartments->found_posts . " posts");

            if ( $apartments->have_posts() ) {
                while ( $apartments->have_posts() ) {
                    $apartments->the_post();
                    $apartment_id = get_the_ID();
                    $title = get_the_title();
                    $area = get_post_meta( $apartment_id, 'ova_apartment_tamano', true );
                    $price = get_post_meta( $apartment_id, 'ova_apartment_precio', true );
                    $location = get_post_meta( $apartment_id, 'ova_apartment_location', true );
                    $permalink = get_permalink();
                    ?>
                    <div class="ova-box-feature2">
                        <div class="img">
                            <a href="<?php echo esc_url($permalink); ?>">
                                <?php 
                                $gallery_ids = get_post_meta($apartment_id, 'apartment_gallery_ids', true);
                                if ( $gallery_ids ) {
                                    $first_image_id = explode(',', $gallery_ids)[0];
                                    $image_url = wp_get_attachment_image_url($first_image_id, 'full');
                                    if ( $image_url ) {
                                        echo '<img src="' . esc_url($image_url) . '" class="box-feature2-img" alt="' . esc_attr($title) . '">';
                                    }
                                }
                                ?>
                            </a>
                        </div>
                        <div class="info">
                            <h2 class="title">
                                <a href="<?php echo esc_url($permalink); ?>">
                                    <?php echo esc_html($title); ?>
                                </a>
                            </h2>
                            <p class="sub-title">
                                <a href="<?php echo esc_url($permalink); ?>">
                                    <?php echo esc_html($area); ?> | <?php echo esc_html($price); ?> | <?php echo esc_html($location); ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            }
            
            die();
        }
    }
    new Moore_Ajax_Apartment_Filter();
}
