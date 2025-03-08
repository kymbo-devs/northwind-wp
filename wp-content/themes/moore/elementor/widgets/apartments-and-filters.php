<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if (! defined('ABSPATH')) exit; // Exit if accessed directly


class Moore_Elementor_Apartments_And_Filters extends Widget_Base
{
    // Previous methods remain unchanged
    public function get_name()
    {
        return 'moore_elementor_apartments_and_filters';
    }


    public function get_title()
    {
        return esc_html__('Apartamentos y filtros', 'moore');
    }


    public function get_icon()
    {
        return ' eicon-filter';
    }


    public function get_categories()
    {
        return ['moore'];
    }

    public function get_script_depends()
    {
        // Carousel
        wp_enqueue_style('nouislider', get_template_directory_uri() . '/assets/libs/nouislider.min.css');
        wp_enqueue_script('nouislider', get_template_directory_uri() . '/assets/libs/nouislider.min.js', array('jquery'), null, true);
        return ['moore-elementor-apartments-and-filters'];
    }

    // Controls remain unchanged
    protected function register_controls()
    {
        // Your existing controls code remains unchanged
        /* START SECTION ADDITIONAL */
        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => esc_html__('Additional Options', 'moore'),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'     => esc_html__('Posts Per Page', 'moore'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5,
            ]
        );

        $this->add_control(
            'text_button',
            [
                'label' => esc_html__('Text Button', 'moore'),
                'type' => Controls_Manager::TEXT,
                'default' =>  esc_html__('Load More', 'moore'),
            ]
        );

        $this->end_controls_section();

        // Remaining control sections remain unchanged
        // (section_heading_style, section_date_style, section_square_style, etc.)
    }

    // Helper function remains unchanged
    private function get_apartment_max_values() {
		// Build query args for apartments
		$args = array(
			'post_type'      => 'ova_apartments',
			'posts_per_page' => -1,
			'fields'         => 'ids' // Only get post IDs for efficiency
		);

		// If on a category page, filter by current category
		if ( is_tax('category') || is_category() ) {
			$current_category = get_queried_object();
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $current_category->term_id,
				)
			);
		}

		// Get apartments based on the constructed query
		$all_apartments = get_posts($args);

		$max_area      = 0;
		$max_price     = 0;
		$max_area_name = '';
		$max_price_name = '';

		foreach ( $all_apartments as $apartment_id ) {
			// Check for area
			$area = (float) get_post_meta( $apartment_id, 'ova_apartment_area', true );
			if ( $area > $max_area ) {
				$max_area      = $area;
				$max_area_name = get_the_title( $apartment_id );
			}

			// Check for price
			$price = (float) get_post_meta( $apartment_id, 'ova_apartment_total', true );
			if ( $price > $max_price ) {
				$max_price      = $price;
				$max_price_name = get_the_title( $apartment_id );
			}
		}

		// Add some padding to max values (10% more)
		$max_area  = ceil( $max_area * 1.1 );
		$max_price = ceil( $max_price * 1.1 );

		return array(
			'max_area_name'  => $max_area_name,
			'max_area'       => $max_area,
			'max_price_name' => $max_price_name,
			'max_price'      => $max_price,
		);
	}

    // Fixed render method
    protected function render()
    {
        $settings = $this->get_settings();

        $text_button    = $settings['text_button'];
        $posts_per_page = $settings['posts_per_page'];

        // Get range price, area
        $range_area_min = isset($settings['range_area_min']) ? $settings['range_area_min'] : 0;
        $range_area_max = isset($settings['range_area_max']) ? $settings['range_area_max'] : 0;
        $range_price_min = isset($settings['range_price_min']) ? $settings['range_price_min'] : 0;
        $range_price_max = isset($settings['range_price_max']) ? $settings['range_price_max'] : 0;

        // Get list locations
        $location_args = array(
            'post_type' => 'ova_apartments',
            'posts_per_page' => -1 // Get all to ensure we have all locations
        );
        
        // Add category filter for locations if we're on a category page
        if (is_tax('category') || is_category()) {
            $current_category = get_queried_object();
            $location_args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $current_category->term_id
                )
            );
        }
        
        $locations = get_posts($location_args);
        $unique_locations = array();

        foreach ($locations as $apartment) {
            $location = get_post_meta($apartment->ID, 'ova_apartment_location', true);
            if (!empty($location) && !in_array($location, $unique_locations)) {
                $unique_locations[] = $location;
            }
        }

        // Get features
        $features_args = array(
            'taxonomy' => 'features_apartment',
            'orderby' => 'name',
            'order'   => 'ASC'
        );
        $features = get_categories($features_args);

        // Query args
        $args = array(
            'post_type' => 'ova_apartments',
            'posts_per_page' => $posts_per_page,
            'orderby' => 'name',
            'order' => 'ASC'
        );

        // Add category filter if we're on a category page
        // Fix: Check both is_tax('category') and is_category() to cover all cases
        if (is_tax('category') || is_category()) {
            $current_category = get_queried_object();
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $current_category->term_id
                )
            );
        }

        $max_values = $this->get_apartment_max_values();
        $range_area_max = $max_values['max_area'];
        $range_price_max = $max_values['max_price'];

        $apartments = new \WP_Query($args);
        $number_results_found = $apartments->found_posts;
		
		$area_name = $max_values['max_area_name'];
		$price_name = $max_values['max_price_name'];
?>

        <div class="ova-rooms-filter" data-range_area_min="0"
            data-range_area_max="<?php echo esc_attr($range_area_max); ?>"
            data-range_price_min="0"
            data-range_price_max="<?php echo esc_attr($range_price_max); ?>">
            <!-- Form Filter -->
            <form action="<?php echo esc_url(home_url('/')); ?>" method="post" id="rooms-filter">
				<?php if ( is_tax('category') || is_category() ): ?>
					<input type="hidden" name="current_category" value="<?php echo esc_attr( $current_category->term_id ); ?>">
				<?php endif; ?>
				<div class="select-filter">
                    <select name="location" id="location">
                        <option value="all"><?php esc_html_e('Localización', 'moore'); ?></option>
                        <?php foreach ($unique_locations as $location): ?>
                            <option value="<?php echo esc_attr($location); ?>">
                                <?php echo esc_html($location); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select name="features" id="features">
                        <option value="all"><?php esc_html_e('Características', 'moore'); ?></option>
                        <?php foreach ($features as $feature): ?>
                            <option value="<?php echo esc_attr($feature->slug); ?>">
                                <?php echo esc_html($feature->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
					
					<a href="/operaciones-finalizadas" class="new-filter" id="new-filter">
						Operaciones finalizadas
                    </a>
                </div>

                <div class="option-filter">
                    <div class="area-value-filter">
                        <div id="slider-range-area">
                            <input type="hidden" name="min-value-area" id="range-area-start">
                            <input type="hidden" name="max-value-area" id="range-area-end">
                        </div>
                        <p>
                            <?php esc_html_e('Tamaño', 'moore'); ?>
                            ( <?php esc_html_e('M', 'moore'); ?><sub>2</sub> )
                        </p>
                    </div>

                    <div class="clear-filter" id="clear-filter">
                        <input type="button" value="Limpiar filtros">
                    </div>

                    <div class="price-value-filter">
                        <div id="slider-range-price">
                            <input type="hidden" name="min-value-price" id="range-price-start">
                            <input type="hidden" name="max-value-price" id="range-price-end">
                        </div>
                        <p>
                            <?php esc_html_e('Precio ( € )', 'moore'); ?>
                        </p>
                    </div>
                </div>
                
                <?php if (is_tax('category') || is_category()): ?>
                <input type="hidden" name="current_category" value="<?php echo esc_attr($current_category->term_id); ?>">
                <?php endif; ?>
            </form>

            <!-- Results count -->
            <h4 class="results-found">
                <span class="number-results-found"><?php echo esc_html($number_results_found); ?></span>
                <?php esc_html_e(' Result Found', 'moore'); ?>
            </h4>

            <!-- Results -->
            <div class="results-filter">
                <?php if ($apartments->have_posts()): while ($apartments->have_posts()): $apartments->the_post();
                        $apartment_id = get_the_ID();
                        $title = get_the_title();
                        $area = get_post_meta($apartment_id, 'ova_apartment_tamano', true);
                        $price = get_post_meta($apartment_id, 'ova_apartment_price', true);
                        $location = get_post_meta($apartment_id, 'ova_apartment_location', true);
                        $permalink = get_permalink();
                ?>
                        <div class="ova-box-feature2">
                            <div class="img">
                                <a href="<?php echo esc_url($permalink); ?>">
                                    <?php
                                    $gallery_ids = get_post_meta($apartment_id, 'apartment_gallery_ids', true);
                                    if ($gallery_ids) {
                                        $first_image_id = explode(',', $gallery_ids)[0];
                                        $image_url = wp_get_attachment_image_url($first_image_id, 'full');
                                        if ($image_url) {
                                            echo '<img src="' . esc_url($image_url) . '" class="box-feature2-img" alt="' . esc_attr($title) . '">';
                                        }
                                    }
                                    ?>
                                </a>
                            </div>

                            <div class="info">
								<a href="<?php echo esc_url($permalink); ?>">
                                <h2 class="title">    
                                        <?php echo esc_html($title); ?>
                                </h2>
								</a>
								<a href="<?php echo esc_url($permalink); ?>">
                                <p class="sub-title">
                                        <?php echo esc_html($area); ?> | <?php echo esc_html($price); ?> | <?php echo esc_html($location); ?>
                                </p>
								</a>	
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <?php if (!empty($text_button)): ?>
                <div class="button-loadmore" data-post_per_page="<?php echo esc_attr($posts_per_page); ?>"
                    data-paged="2" data-number_results_found_filter="<?php echo esc_attr($number_results_found); ?>">
                    <p class="text-button">
                        <?php echo esc_html($text_button); ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

<?php
    }
}
$widgets_manager->register(new Moore_Elementor_Apartments_And_Filters());