<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Apartments_Slider extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_apartments_slider';
	}

	
	public function get_title() {
		return esc_html__( 'Apartments Slider', 'moore' );
	}

	
	public function get_icon() {
		return ' eicon-slider-album';
	}

	
	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_script_depends() {
		// Carousel
		wp_enqueue_style( 'carousel', get_template_directory_uri().'/assets/libs/owl.carousel.min.css' );
		wp_enqueue_script( 'carousel', get_template_directory_uri().'/assets/libs/owl.carousel.min.js', array('jquery'), false, true );
		return [ 'moore-elementor-apartments-slider' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'moore' ),
			]
		);	
			
			
			// Add Class control
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'moore' ),
					'type' => Controls_Manager::URL,
					'default' => [
						'url' => '#',
					],
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'https://your-link.com', 'moore' ),
				]
			);

			$repeater->add_control(
				'title',
				[
					'label'   => esc_html__( 'Title', 'moore' ),
					'type'    => Controls_Manager::TEXT,
					'default' =>  esc_html__( 'Apartment ', 'moore' ),
				]
			);

			$repeater->add_control(
				'sub_title',
				[
					'label'   => esc_html__( 'Sub Title', 'moore' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'From 96.42M', 'moore' ),
				]
			);

			$repeater->add_control(
				'image',
				[
					'label'   => esc_html__( 'Choose Image', 'moore' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Items Apartments', 'moore' ),
					'type'		=> Controls_Manager::REPEATER,
					'fields'  	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'title' 		=> esc_html__('Apartment ', 'moore'),
							'sub_title' 	=> esc_html__('From 96.42M', 'moore'),
							'link'          => esc_html__( '#', 'moore' ),
							
						],
						[
							'title' 		=> esc_html__('Apartment ', 'moore'),
							'sub_title' 	=> esc_html__('From 96.42M', 'moore'),
							'link'          => esc_html__( '#', 'moore' ),
							
						],
						[
							'title' 		=> esc_html__('Apartment ', 'moore'),
							'sub_title' 	=> esc_html__('From 96.42M', 'moore'),
							'link'          => esc_html__( '#', 'moore' ),
							
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

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
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'moore' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 24,
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'moore' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Number Item', 'moore' ),
					'default'     => 3,
				]
			);

	

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'moore' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'moore' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'moore' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'moore' ),
						'no'  => esc_html__( 'No', 'moore' ),
					],
					'frontend_available' => true,
				]
			);


			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'moore' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'moore' ),
						'no'  => esc_html__( 'No', 'moore' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'moore' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'moore' ),
						'no'  => esc_html__( 'No', 'moore' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'moore' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 3000,
					'step'      => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => esc_html__( 'Smart Speed', 'moore' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'dot_control',
				[
					'label'   => esc_html__( 'Show Dots', 'moore' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'moore' ),
						'no'  => esc_html__( 'No', 'moore' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'navText_control',
				[
					'label'   => esc_html__( 'Show navText', 'moore' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'moore' ),
						'no'  => esc_html__( 'No', 'moore' ),
					],
					'frontend_available' => true,
				]
			);

		$this->end_controls_section();

		/****************************  END SECTION ADDITIONAL *********************/
        $this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'moore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label'     => esc_html__( 'Color', 'moore' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label'      => esc_html__( 'Margin', 'moore' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'moore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'sub_title_typography',
					'selector' => '{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .sub-title',
				]
			);

			$this->add_control(
				'sub_title_color',
				[
					'label'     => esc_html__( 'Color', 'moore' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .sub-title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'sub_title_margin',
				[
					'label'      => esc_html__( 'Margin', 'moore' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
        
		$this->start_controls_section(
			'section_info_style',
			[
				'label' => esc_html__( 'Info', 'moore' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'info_bg',
				[
					'label'     => esc_html__( 'Background', 'moore' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info:before' => 'background-color : {{VALUE}};',
					],
				]
			);
            
			$this->add_responsive_control(
				'info_opacity',
				[
					'label' => esc_html__( 'Opacity', 'moore' ),
					'type' 	=> Controls_Manager::SLIDER,
					
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1,
							'step' 	=> 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info:before' => 'opacity: {{SIZE}}',
					],
				]
			);

			$this->add_responsive_control(
				'info_opacity_hover',
				[
					'label' => esc_html__( 'Opacity Hover', 'moore' ),
					'type' 	=> Controls_Manager::SLIDER,
					
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1,
							'step' 	=> 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item:hover .client_info:before' => 'opacity: {{SIZE}}',
					],
				]
			);

			$this->add_responsive_control(
	            'info_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'moore' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'left' 	=> [
	                        'title' => esc_html__( 'Left', 'moore' ),
	                        'icon' 	=> 'eicon-text-align-left',
	                    ],
	                    'center' 	=> [
	                        'title' => esc_html__( 'Center', 'moore' ),
	                        'icon' 	=> 'eicon-text-align-center',
	                    ],
	                    'right' 	=> [
	                        'title' => esc_html__( 'Right', 'moore' ),
	                        'icon' 	=> 'eicon-text-align-right',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .title' => 'text-align: {{VALUE}}',
	                    '{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .sub-title' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );
            
			
			$this->add_responsive_control(
				'info_bottom',
				[
					'label' 		=> esc_html__( 'Bottom', 'moore' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' 	=> -500,
							'max' 	=> 500,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> -100,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info' => 'bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'info_bottom_hover',
				[
					'label' 		=> esc_html__( 'Bottom Hover', 'moore' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' 	=> -500,
							'max' 	=> 500,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> -100,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-slider .slide-apartments-slider .owl-item .item:hover .client_info .info' => 'bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		$tab_item = $settings['tab_item'];
		

		$data_options['items']              = $settings['item_number'];
		$data_options['slideBy']            = $settings['slides_to_scroll'];
		$data_options['margin']             = $settings['margin_items'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplayTimeout']    = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];
		$data_options['nav']                = $settings['navText_control'] === 'yes' ? true : false;
		$data_options['dots']               = $settings['dot_control'] === 'yes' ? true : false;
		$data_options['rtl']				= is_rtl() ? true: false;

		 ?>

		<section class="ova-apartments-slider">

					<div class="slide-apartments-slider owl-carousel owl-theme " data-options="<?php echo esc_attr(json_encode($data_options)) ?>">
						<?php if(!empty($tab_item)) : foreach ($tab_item as $items) : 
                        
							$img_url 	= $items['image']['url'];
	  					    $img_alt 	= isset( $items['image']['alt'] ) ? $items['image']['alt'] : $items['title'];
	  					    $title 		= $items['title'];
	  					    $sub_title	= $items['sub_title'];
	  					    // get link
                            $link        = $items['link']['url'];
							$is_external = $items['link']['is_external'];
							$target      = ( $is_external == 'on' ) ? 'target="_blank"' : '';
							?>

								<div class="item">

								<?php if( $link != '') : ?>
									<a href="<?php echo esc_url($link) ; ?>" <?php echo ''.$target ;?>>
							    <?php endif; ?>
                                   <div class="apartments-slider-img">
								        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
								   </div>
									<div class="client_info">
	                                    
										<div class="info">

											    <?php if( $title != '' ) { ?>
												    <h3 class="title">
													   <?php echo esc_html($title) ?>
													</h3>
												<?php } ?>
												<?php if( $sub_title != '' ) { ?>
													<p class="sub-title">
														<?php echo esc_html($sub_title) ?>
													</p>
												<?php } ?>

										</div>
										<!-- end info -->
									</div>

								<?php if( $link != '') : ?>
									</a>
								<?php endif; ?>

								</div>	

						<?php endforeach; endif; ?>
					</div>

			</section>

		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Apartments_Slider() );