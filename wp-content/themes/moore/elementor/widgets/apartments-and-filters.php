<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Apartments_And_Filters extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_apartments_and_filters';
	}

	
	public function get_title() {
		return esc_html__( 'Apartamentos y filtros', 'moore' );
	}

	
	public function get_icon() {
		return ' eicon-filter';
	}

	
	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_script_depends() {
		// Carousel
		wp_enqueue_style('nouislider', get_template_directory_uri().'/assets/libs/nouislider.min.css');
		wp_enqueue_script('nouislider', get_template_directory_uri().'/assets/libs/nouislider.min.js', array('jquery'),null,true);
		return [ 'moore-elementor-apartments-and-filters' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		/*****************************************************************
						START SECTION ADDITIONAL
		******************************************************************/

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'moore' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' 	=> esc_html__( 'Posts Per Page', 'moore' ),
				'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 5,
			]
		);

		$this->add_control(
			'text_button',
			[
				'label' => esc_html__( 'Text Button', 'moore' ),
				'type' => Controls_Manager::TEXT,
				'default' =>  esc_html__( 'Load More', 'moore' ),
				
			]
		);

		$this->add_control(
			'title_area',
			[
				'label' => __( 'Range Area', 'moore' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'default',
			]
		);
		
		$this->add_control(
			'range_area_min',
			[
				'label' => __( 'Min', 'moore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => 0,
			]
		);

		$this->add_control(
			'range_area_max',
			[
				'label' => __( 'Max', 'moore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => 200,
			]
		);

		$this->add_control(
			'title_price',
			[
				'label' => __( 'Range Price', 'moore' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'default',
			]
		);

		$this->add_control(
			'range_price_min',
			[
				'label' => __( 'Min', 'moore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => 0,
			]
		);
		$this->add_control(
			'range_price_max',
			[
				'label' => __( 'Max', 'moore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => 200,
			]
		);

		$this->end_controls_section();

		// *******section heading result found style *****//
		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__( 'Heading Result', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .ova-rooms-filter .results-found',
			]
		);

		$this->add_control(
			'color_heading',
			[
				'label' => esc_html__( 'Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .results-found' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_heading_hover',
			[
				'label' => esc_html__( 'Color Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .results-found:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_heading',
			[
				'label' => esc_html__( 'Padding', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .results-found' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_heading',
			[
				'label' => esc_html__( 'Margin', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .results-found' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	$this->end_controls_section();
	// *******end heading result style *****//

	 // *******section date style *****//
	$this->start_controls_section(
		'section_date_style',
		[
			'label' => esc_html__( 'Date', 'moore' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'selector' => '{{WRAPPER}} .ova-rooms-filter .room .date .room-date',
			]
		);

		$this->add_control(
			'color_date',
			[
				'label' => esc_html__( 'Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .date .room-date' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_date_hover',
			[
				'label' => esc_html__( 'Color Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .date:hover .room-date' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_date',
			[
				'label' => esc_html__( 'Padding', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .date .room-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	$this->end_controls_section();
	// *******end content date style *****//

	 // *******section square *****//
	 $this->start_controls_section(
		'section_square_style',
		[
			'label' => esc_html__( 'Square', 'moore' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'square_typography',
				'selector' => '{{WRAPPER}} .ova-rooms-filter .room .plan .square',
			]
		);

		$this->add_control(
			'color_square',
			[
				'label' => esc_html__( 'Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .plan .square' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_square_hover',
			[
				'label' => esc_html__( 'Color Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .plan:hover .square' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_square',
			[
				'label' => esc_html__( 'Padding', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .plan .square' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	$this->end_controls_section();
	// *******end square style *****//
	// *******section bedrooms and floor *****//
	$this->start_controls_section(
		'section_bed_floor_style',
		[
			'label' => esc_html__( 'Bedrooms & Floor', 'moore' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Bedrooms Typography', 'moore' ),
				'name' => 'bed_typography',
				'selector' => '{{WRAPPER}} .ova-rooms-filter .room .bed-floor .bedrooms',
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Floor Typography', 'moore' ),
				'name' => 'floor_typography',
				'selector' => '{{WRAPPER}} .ova-rooms-filter .room .bed-floor .floor',
			]
		);

		$this->add_control(
			'color_bed_floor',
			[
				'label' => esc_html__( 'Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .bed-floor .bedrooms' => 'color : {{VALUE}};',
					'{{WRAPPER}} .ova-rooms-filter .room .bed-floor .floor' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_bed_floor_hover',
			[
				'label' => esc_html__( 'Color Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .bed-floor:hover .floor' => 'color : {{VALUE}};',
					'{{WRAPPER}} .ova-rooms-filter .room .bed-floor:hover .bedrooms' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_bed_floor',
			[
				'label' => esc_html__( 'Padding', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .bed-floor' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	$this->end_controls_section();
	 // *******section price *****//
	 $this->start_controls_section(
		'section_price_style',
		[
			'label' => esc_html__( 'Price', 'moore' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .ova-rooms-filter .room .price .total_price',
			]
		);

		$this->add_control(
			'color_price',
			[
				'label' => esc_html__( 'Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .price .total_price' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_price_hover',
			[
				'label' => esc_html__( 'Color Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .price:hover .total_price' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_price',
			[
				'label' => esc_html__( 'Padding', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .price .total_price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// *******end price style *****//
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icons', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'size_icon',
			[
				'label' => esc_html__( 'Size', 'moore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .icon_group .icons i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'color_icon',
			[
				'label' => esc_html__( 'Icon Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .icon_group .icons i' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bgcolor_icon',
			[
				'label' => esc_html__( 'Background Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .icon_group .icons' => 'background-color : {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'color_icon_hover',
			[
				'label' => esc_html__( 'Icon Color Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .icon_group .icons:hover i' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bgcolor_icon_hover',
			[
				'label' => esc_html__( 'Background Color Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-rooms-filter .room .icon_group .icons:hover' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// *******end square style *****//

		/****************************  END SECTION ADDITIONAL *********************/
	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings();

		$text_button    = $settings['text_button']; 
		$posts_per_page = $settings['posts_per_page'];

		// Get range price, area
		$range_area_min = $settings['range_area_min'];
		$range_area_max = $settings['range_area_max'];
		$range_price_min = $settings['range_price_min'];
		$range_price_max = $settings['range_price_max'];

		// Get list locations
		$location_args = array(
			'post_type' => 'ova_apartments',
			'posts_per_page' => -1
		);
		$locations = get_posts($location_args);
		$unique_locations = array();

		foreach($locations as $apartment) {
			$location = get_post_meta($apartment->ID, 'ova_apartment_location', true);
			if(!empty($location) && !in_array($location, $unique_locations)) {
				$unique_locations[] = $location;
			}
		}

		// Get list regimens
		$regimens = array();
		$all_apartments = get_posts($location_args);
		foreach($all_apartments as $apartment) {
			$regimen = get_post_meta($apartment->ID, 'ova_apartment_regimen', true);
			if(!empty($regimen) && !in_array($regimen, $regimens)) {
				$regimens[] = $regimen;
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
		if(is_tax('category')) {
			$current_category = get_queried_object();
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'term_id',
					'terms' => $current_category->term_id
				)
			);
		}

		$apartments = new \WP_Query($args);
		$number_results_found = $apartments->found_posts;
		?>

		<div class="ova-rooms-filter" data-range_area_min="<?php echo esc_attr($range_area_min); ?>" 
			 data-range_area_max="<?php echo esc_attr($range_area_max); ?>" 
			 data-range_price_min="<?php echo esc_attr($range_price_min); ?>" 
			 data-range_price_max="<?php echo esc_attr($range_price_max); ?>">

			<!-- Form Filter -->
			<form action="<?php home_url('/'); ?>" method="post" id="rooms-filter">
				<div class="select-filter">
					<select name="regimen" id="regimen">
						<option value="all"><?php esc_html_e('Régimen', 'moore'); ?></option>
						<?php foreach($regimens as $regimen): ?>
							<option value="<?php echo esc_attr($regimen); ?>">
								<?php echo esc_html($regimen); ?>
							</option>
						<?php endforeach; ?>
					</select>

					<select name="location" id="location">
						<option value="all"><?php esc_html_e('Localización', 'moore'); ?></option>
						<?php foreach($unique_locations as $location): ?>
							<option value="<?php echo esc_attr($location); ?>">
								<?php echo esc_html($location); ?>
							</option>
						<?php endforeach; ?>
					</select>

					<select name="features" id="features">
						<option value="all"><?php esc_html_e('Features', 'moore'); ?></option>
						<?php foreach($features as $feature): ?>
							<option value="<?php echo esc_attr($feature->slug); ?>">
								<?php echo esc_html($feature->name); ?>
							</option>
						<?php endforeach; ?>
					</select>
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
						<input type="button" value="Clear Filter">
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
			</form>

			<!-- Results count -->
			<h4 class="results-found">
				<span class="number-results-found"><?php echo esc_html($number_results_found); ?></span>
				<?php esc_html_e(' Result Found', 'moore'); ?>
			</h4>

			<!-- Results -->
			<div class="results-filter">
				<?php if($apartments->have_posts()): while($apartments->have_posts()): $apartments->the_post();
					$apartment_id = get_the_ID();
					$title = get_the_title();
					$area = get_post_meta($apartment_id, 'ova_apartment_tamano', true);
					$price = get_post_meta($apartment_id, 'ova_apartment_precio', true);
					$location = get_post_meta($apartment_id, 'ova_apartment_location', true);
				?>
					<div class="ova-box-feature2">
						<div class="img">
							<?php 
							$gallery_ids = get_post_meta($apartment_id, 'apartment_gallery_ids', true);
							if($gallery_ids) {
								$first_image_id = explode(',', $gallery_ids)[0];
								$image_url = wp_get_attachment_image_url($first_image_id, 'full');
								if($image_url) {
									echo '<img src="'.esc_url($image_url).'" class="box-feature2-img" alt="'.esc_attr($title).'">';
								}
							}
							?>
						</div>

						<div class="info">
							<h2 class="title"><?php echo esc_html($title); ?></h2>
							<p class="sub-title">
								<?php echo esc_html($area); ?> m² | <?php echo esc_html($price); ?> € | <?php echo esc_html($location); ?>
							</p>
						</div>
					</div>
				<?php 
				endwhile;
				wp_reset_postdata();
				endif; 
				?>
			</div>

			<?php if(!empty($text_button)): ?>
				<div class="button-loadmore" data-post_per_page="<?php echo esc_attr($posts_per_page); ?>" 
					 data-paged="2" data-number_results_found="<?php echo esc_attr($number_results_found); ?>">
					<p class="text-button">
						<?php echo esc_html($text_button); ?>
					</p>
				</div>
			<?php endif; ?>

			<div class="button-loadmore-nodata">
				<p class="text-button-nodata">
					<?php esc_html_e('No Data', 'moore'); ?>
				</p>
			</div>
		</div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Apartments_And_Filters() );