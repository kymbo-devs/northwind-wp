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

		$text_button    = $settings['text_button'] ; 
	    $posts_per_page = $settings['posts_per_page'];
		// get range price, area
		$range_area_min = $settings['range_area_min'];
		$range_area_max = $settings['range_area_max'];
		$range_price_min = $settings['range_price_min'];
		$range_price_max = $settings['range_price_max'];
        // get list type room
        $type_args = array(
			'taxonomy' => 'category',
			'orderby' => 'name',
			'order'   => 'ASC'
		);
		$type_room 		= get_categories( $type_args );
		$type_room_data = array();

		if ( $type_room ) {
			foreach ( $type_room as $type ) {
				$type_room_data[$type->slug] = $type->cat_name;
			}
		} else {
			$type_room_data["No content Category found"] = 0;
		}

        // get list feature room
		$features_args = array(
			'taxonomy' => 'features_apartment',
			'orderby' => 'name',
			'order'   => 'ASC'
		);
		$features_room 		= get_categories( $features_args );
		$features_room_data = array();

		if ( $features_room ) {
			foreach ( $features_room as $features ) {
				$features_room_data[$features->slug] = $features->cat_name;
			}
		} else {
			$features_room_data[''] = esc_html__('Features Room Not Found', 'moore');
		}

        // args
		$args = array(
			'post_type' => 'ova_apartments',
			'posts_per_page' => $posts_per_page,
			'orderby'       => 'name',
			'order'         => 'ASC'
		);
		
		if ( ( 'all' != $features_room_data ) && ( 'all' != $type_room_data ) ) {
			$args['tax_query'] = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $type_room_data,
				),
				array(
					'taxonomy' => 'features_apartment',
					'field'    => 'slug',
					'terms'    => $features_room_data,
				),
			);
		};

		$rooms = new \WP_Query( $args );
        $number_results_found = $rooms->found_posts;

		 ?>

        <div class="ova-rooms-filter" data-range_area_min = "<?php echo esc_attr( $range_area_min ) ;?>"  data-range_area_max = "<?php echo esc_attr( $range_area_max ) ;?>" data-range_price_min = "<?php echo esc_attr( $range_price_min ) ;?>" data-range_price_max = "<?php echo esc_attr( $range_price_max ) ;?>"> 
		  <!-- Form Filter -->
			<form action="<?php home_url('/'); ?>"  method="post" id="rooms-filter">

				<div class="select-filter">
					<select name="type" id="type">
					    <option value="all">
						    <?php esc_html_e( 'Type', 'moore' ); ?>
						</option>
						<?php foreach ($type_room_data as $type_slug => $type_room_value) : ?>

						 <option value="<?php echo esc_html( $type_slug ); ?>">
						    <?php echo esc_html( $type_room_value ) ;?>
						</option>

						<?php endforeach; ?>
					</select>

					<div class="floor">
						<span class="label-floor"><?php echo esc_html_e( 'Floor', 'moore' );?></span>
						<div class="floor-number">
							<input type="number" min = "0" max="50" placeholder ="1" name="floor-from" id="from" value="1">
							<span class="label-to"><?php echo esc_html_e( 'to', 'moore' );?></span>
							<input type="number"  min = "50" max="100" placeholder ="20" name="floor-to" id="to" value="20">
						</div>
					</div>

					<select name="rooms" id="rooms">
					    <option value="all">
							<?php esc_html_e( 'Rooms', 'moore' ); ?> 
						</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4+</option>
					</select>

					<select name="features" id="features" >
					    <option value="all">
							<?php esc_html_e( 'Features', 'moore' ); ?> 
						</option>
						<?php foreach ($features_room_data as $features_slug => $features_room_value) : ?>
							<option value="<?php echo esc_html( $features_slug ); ?>">
							<?php echo esc_html( $features_room_value ) ;?>
							</option>
						<?php endforeach; ?>
					</select>  
				</div>
				
                <div class="option-filter">
					<div class="area-value-filter">

						 <div id="slider-range-area">
							<input type="hidden" name="min-value-area"  id="range-area-start">
							<input type="hidden" name="max-value-area"  id="range-area-end">
						</div>
						<p>
							 <?php esc_html_e( 'Area', 'moore' ); ?>
							 ( <?php esc_html_e( 'M', 'moore' ); ?><sub>2</sub> )
					    </p>

					</div>

                    <div class="clear-filter" id="clear-filter">
					    <input type="button" value="Clear Filter">
					</div>

				    <div class="price-value-filter">

						<div id="slider-range-price">
							<input type="hidden" name="min-value-price" id="range-price-start">
							<input type="hidden" name="max-value-price"  id="range-price-end">
						</div>
						<p>
						   <?php esc_html_e( 'Price ( M )', 'moore' ); ?>	
					    </p>
					</div>
				</div>

			</form>
            <!-- heading results found -->
				<h4 class="results-found">
					<span class="number-results-found"></span>
					<?php esc_html_e( ' Result Found', 'moore' ); ?> 
				</h4>
			<!-- end heading results -->
			<div class="results-filter">

				<!-- the rooms loop -->
				<?php if ( $rooms->have_posts() ) : ?>
					<?php while ( $rooms->have_posts() ) : $rooms->the_post(); 
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
					    $size_file_layout = file_exists( $path ) ? size_format( filesize( $path ), 1 ) : '';
					?>
						<!-- div room -->
						
						<div class="ova-box-feature2">

							<div class="img">
								<img src="<?php echo esc_url( $url );?>" class="box-feature2-img" alt="<?php echo esc_attr( $alt ); ?>">

								<?php if ($show_view_all ==='yes') : ?>
									<?php if ( !empty ($text)) : ?>

									<div class="button">
										<p class="text"><?php echo esc_html($text); ?></p>
									</div>

									<?php endif; ?>
								<?php endif; ?>

							</div>
						
							<div class="info">

								<?php if ( !empty ($title)) : ?>
									<h2 class="title">
											<?php echo esc_html($title); ?>
									</h2>
								<?php endif; ?>
								
								<?php if ( !empty ($subtitle)) : ?>
									<p  class="sub-title">
										<?php echo esc_html($subtitle) ; ?>
									</p>
								<?php endif; ?>

							</div>

						</div>
						
					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
				<!-- end of the loop -->	
	
			</div>

		     <!-- rigth popup on click div room -->
					<div class="right">
						<div class="content">
							<div class="btn">
								<button class="room-toggle">
									<i class="ovaicon-cancel"></i>
								</button>
							</div>	
							<div class="room-popup">
								<p class="total_price_popup"></p>
								<h2 class="title-popup"></h2>
								<div class="date">
									<span>
									    <?php echo esc_html_e( 'No:','moore');?>
									</span>
									<p class="date-popup">
									   
							        </p>
							    </div>
			
								<div class="square-bed-floor">
									<p class="square-popup"></p>
									<p class="bedrooms-popup"></p>
									<p class="floor-popup"></p>
								</div>

								<div class="icon_group_popup"></div>

								<img src="#" alt="<?php echo the_title();?>" class="room-image-popup">

								<div class="download">

									<a href="#" rel="nofollow" class="url-send-request-popup">
										<div class="btn-send-request">
											<?php echo esc_html_e('Send Request','moore'); ?>
										</div>
									</a>
									<a href="<?php echo esc_url( $url_file_layout ); ?>" rel="nofollow" target="_blank" class="url-file-layout-popup">
										<span class="info-file">
											<?php echo esc_html_e('Download Layout','moore');?>
										</span>
									</a> 
									<div class="info-file">
										<?php if( $size_file_layout ){ ?>
											<?php echo esc_html_e('PDF','moore');?>
											<span class="size-file-layout-popup">
												<?php echo esc_html( $size_file_layout );?>
											</span>
										<?php } ?>
								    </div>
								</div>

							</div>

						</div>

						<div class="site-overlay"></div>
					</div> 
				<!-- end rigth popup -->	
			
            <?php if( !empty( $text_button ) ) :?>
					<div class="button-loadmore" data-post_per_page="<?php echo esc_attr($posts_per_page); ?>" data-paged="2" data-number_results_found="<?php echo esc_attr($number_results_found); ?>">
						<p class="text-button">
							<?php echo esc_html( $text_button ); ?>
						</p>
					</div>
			<?php endif; ?>

            <div class="button-loadmore-nodata">
					<p class="text-button-nodata">
						<?php esc_html_e( 'No Data', 'moore' ); ?> 
					</p>
			</div>

		</div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Apartments_And_Filters() );