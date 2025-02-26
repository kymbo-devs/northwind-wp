<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Room_List extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_room_list';
	}

	
	public function get_title() {
		return esc_html__( 'Room List', 'moore' );
	}

	
	public function get_icon() {
		return 'eicon-table-of-contents';
	}

	
	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_script_depends() {
		return [ 'moore-elementor-room-list' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Room List', 'moore' ),
			]
		);	
			
			$type_args = array(
				'taxonomy' => 'cat_room',
				'orderby' => 'name',
				'order'   => 'ASC'
			);
			$type_room 		= get_categories( $type_args );
			$type_room_all 	= array( 'all' => 'All');
			$type_room_data = array();

			if ( $type_room ) {
				foreach ( $type_room as $type ) {
					$type_room_data[$type->slug] = $type->cat_name;
				}
			} else {
				$type_room_data["No content Category found"] = 0;
			}

			$this->add_control(
				'type_room',
				[
					'label'   => esc_html__( 'Type Room', 'moore' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array_merge( $type_room_all, $type_room_data )
				]
			);

			$features_args = array(
				'taxonomy' => 'features_room',
				'orderby' => 'name',
				'order'   => 'ASC'
			);
			$features_room 		= get_categories( $features_args );
			$features_room_all 	= array( 'all' => 'All');
			$features_room_data = array();

			if ( $features_room ) {
				foreach ( $features_room as $features ) {
					$features_room_data[$features->slug] = $features->cat_name;
				}
			} else {
				$features_room_data[''] = esc_html__('Features Room Not Found', 'moore');
			}

			$this->add_control(
				'features_room',
				[
					'label'   => esc_html__( 'Features Room', 'moore' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array_merge( $features_room_all, $features_room_data )
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

		$this->end_controls_section();

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
					'selector' => '{{WRAPPER}} .ova-room-list .room .date .room-date',
				]
			);

			$this->add_control(
				'color_date',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .date .room-date' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_date_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .date:hover .room-date' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-room-list .room .date .room-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' => '{{WRAPPER}} .ova-room-list .room .plan .square',
				]
			);

			$this->add_control(
				'color_square',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .plan .square' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_square_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .plan:hover .square' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-room-list .room .plan .square' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' => '{{WRAPPER}} .ova-room-list .room .bed-floor .bedrooms',
					'separator' => 'before'
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Floor Typography', 'moore' ),
					'name' => 'floor_typography',
					'selector' => '{{WRAPPER}} .ova-room-list .room .bed-floor .floor',
				]
			);

			$this->add_control(
				'color_bed_floor',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .bed-floor .bedrooms' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-room-list .room .bed-floor .floor' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_bed_floor_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .bed-floor:hover .floor' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-room-list .room .bed-floor:hover .bedrooms' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-room-list .room .bed-floor' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' => '{{WRAPPER}} .ova-room-list .room .price .total_price',
				]
			);

			$this->add_control(
				'color_price',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .price .total_price' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_price_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .price:hover .total_price' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-room-list .room .price .total_price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-room-list .room .icon_group .icons i' => 'font-size: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-room-list .room .icon_group .icons i' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bgcolor_icon',
				[
					'label' => esc_html__( 'Background Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .icon_group .icons' => 'background-color : {{VALUE}};',
					],
				]
			);
            
			$this->add_control(
				'color_icon_hover',
				[
					'label' => esc_html__( 'Icon Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .icon_group .icons:hover i' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bgcolor_icon_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-room-list .room .icon_group .icons:hover' => 'background-color : {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
        // *******end square style *****//
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();
		$text_button    = $settings['text_button'] ; 
	    $posts_per_page = $settings['posts_per_page'];

		$args = array(
			'post_type' => 'ova_room',
			'posts_per_page' => $posts_per_page,
			'orderby'       => 'name',
			'order'         => 'ASC'
		);
		
		if ( ( 'all' != $settings['type_room'] ) && ( 'all' === $settings['features_room'] ) ) {
			$args['tax_query'] = array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'cat_room',
					'field'    => 'slug',
					'terms'    => array( $settings['type_room'] ),
				),
				array(
					'taxonomy' => 'features_room',
					'field'    => 'slug',
					'terms'    => array( $settings['features_room'] ),
				),
			);
		} elseif ( ( 'all' != $settings['features_room'] ) && ( 'all' === $settings['type_room'] ) ) {
			$args['tax_query'] = array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'cat_room',
					'field'    => 'slug',
					'terms'    => array( $settings['type_room'] ),
				),
				array(
					'taxonomy' => 'features_room',
					'field'    => 'slug',
					'terms'    => array( $settings['features_room'] ),
				),
			);
		} elseif ( ( 'all' != $settings['features_room'] ) && ( 'all' != $settings['type_room'] ) ) {
			$args['tax_query'] = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'cat_room',
					'field'    => 'slug',
					'terms'    => array( $settings['type_room'] ),
				),
				array(
					'taxonomy' => 'features_room',
					'field'    => 'slug',
					'terms'    => array( $settings['features_room'] ),
				),
			);
		};

		$rooms = new \WP_Query( $args );
		
		 ?>
        <div class="ova-room-list">

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
					$url_image_popup  = get_post_meta( $room_id, 'ova_mooreimage_popup', true );
					$url_send_request = get_post_meta( $room_id, 'ova_mooreurl_send_request', true );
					$url_file_layout  = get_post_meta( $room_id, 'ova_moorefile_layout', true );
					$path = str_replace( site_url('/'), ABSPATH, esc_url( $url_file_layout) );

					$size_file_layout = file_exists( $path ) ? size_format( filesize( $path ), 1 ) : '';
				?>
					<!-- div room -->
					<div class="room">
					
						<div class="date">
							<p class="room-date">
								<?php echo esc_html( $room_date ); ?>
							</p>
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
								<?php esc_html_e( 'Bedrooms', 'moore' ); ?> 
								<?php echo esc_html( $bedrooms ); ?>
							</p>
							<p class="floor">
								<?php esc_html_e( 'Floor', 'moore' ); ?>
								<?php echo esc_html( $floor ); ?>
							</p>
						</div>

						<div class="price">
							<p class="total_price">
								<?php echo esc_html( $total_price ); ?>
							</p>
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
					<!-- end div room -->
					
				<?php endwhile; ?>

				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		    <!-- end of the loop -->
            <!-- rigth popup on click div room -->
					<div class="right">
						<div class="content">
							<div class="btn">
								<button class="room-toggle">
									<i class="ovaicon-cancel"></i>
								</button>
							</div>
							<div class="room-popup">
								<p class="total_price_popup">
									<?php echo esc_html( $total_price ); ?>
								</p>
								<h2 class="title-popup">
									<?php the_title(); ?>
								</h2>
								<div class="date">
									<span>
									    <?php echo esc_html_e( 'No:','moore');?>
									</span>
									<p class="date-popup">
									    <?php echo esc_html( $room_date ); ?>
							        </p>
							    </div>
			
								<div class="square-bed-floor">
									<p class="square-popup">
										<?php echo esc_html( $square ); ?>
										<?php esc_html_e( 'M', 'moore' ); ?><sub>2</sub>
									</p>
									<p class="bedrooms-popup">
										<?php esc_html_e( 'Bedrooms', 'moore' ); ?> 
										<?php echo esc_html( $bedrooms ); ?>
									</p>
									<p class="floor-popup">
										<?php esc_html_e( 'Floor', 'moore' ); ?>
										<?php echo esc_html( $floor ); ?>
									</p>
								</div>

								<div class="icon_group_popup">
									<?php if(is_array( $icon_group )) :foreach( $icon_group as $icons ) : foreach( $icons as $icon): ?>
										<div class="icons">
											<i class="<?php echo esc_attr( $icon ) ; ?>"></i>
										</div>
									<?php endforeach; endforeach; endif;?>
								</div>

								<img src="<?php echo esc_url( $url_image_popup ); ?>" alt="<?php echo the_title();?>" class="room-image-popup">

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
		</div>

		<?php if( !empty( $text_button ) ) :?>
            <div class="button-room" data-post_per_page="<?php echo esc_attr($posts_per_page); ?>" data-paged="2" data-type_room="<?php echo esc_attr($settings['type_room']); ?>" data-features_room="<?php echo esc_attr($settings['features_room']); ?>">
				<p class="text-button">
					<?php echo esc_html( $text_button ); ?>
		        </p>
			</div>
		<?php endif; ?>	

		<div class="button-room-nodata">
			<p class="text-button-nodata">
			     <?php esc_html_e( 'No Data', 'moore' ); ?> 
	        </p>
		</div>

		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Room_List() );