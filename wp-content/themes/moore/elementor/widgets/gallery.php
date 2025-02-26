<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Moore_Elementor_Gallery extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_gallery';
	}

	public function get_title() {
		return esc_html__( 'Gallery', 'moore' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_script_depends() {
		wp_enqueue_style('fancybox', get_template_directory_uri().'/assets/libs/fancybox.css');
		wp_enqueue_script('fancybox', get_template_directory_uri().'/assets/libs/fancybox.js', array('jquery'),null,true);
		wp_enqueue_script('masonry', get_template_directory_uri().'/assets/libs/masonry.min.js', array('jquery'), false, true );
		
		return [ 'moore-elementor-gallery' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'moore' ),
			]
		);	

			$this->add_control(
				'id_gallery',
				[
					'label' => esc_html__( 'ID', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => time(),
				]
			);

			// Add Class control
			$repeater = new \Elementor\Repeater();

			$default_icon = 'fas fa-plus';

			$repeater->add_control(
				'class_icon',
				[
					'label' 	=> esc_html__( 'Class Icon', 'moore' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> $default_icon,
				]
			);

			$repeater->add_control(
				'caption',
				[
					'label'   => esc_html__( 'Caption Image', 'moore' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( '', 'moore' ),
				]
			);

			$repeater->add_control(
				'image',
				[
					'label'   => esc_html__( 'Gallery Image', 'moore' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'image_popup',
				[
					'label'   => esc_html__( 'Popup Image', 'moore' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_responsive_control(
				'image_width',
				[
					'label' 		=> esc_html__( 'Width', 'moore' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 500,
							'step' 	=> 10,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$repeater->add_responsive_control(
				'image_padding',
				[
					'label'      => esc_html__( 'Padding', 'moore' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-gallery .grid {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Items Gallery', 'moore' ),
					'type'		=> Controls_Manager::REPEATER,
					'fields'  	=> $repeater->get_controls(),
					'default' 	=> [
						[
							
							'class_icon' 	=> $default_icon,
						],
						[
							
							'class_icon' 	=> $default_icon,
						],
						[
							
							'class_icon' 	=> $default_icon,
						],
					],
				]
			);

			$this->add_responsive_control(
				'grid_sizer',
				[
					'label' 		=> esc_html__( 'Grid Sizer', 'moore' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 500,
							'step' 	=> 10,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-sizer' => 'width: {{SIZE}}{{UNIT}}',
					],
					'description' => 'Default grid sizer is 33% (3 columns)'
				]
			);

			$this->add_control(
				'show_view_all',
				[
					'label' => esc_html__( 'Show View All', 'moore' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'moore' ),
					'label_off' => esc_html__( 'Hide', 'moore' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

			$this->add_control(
				'text',
				[
					'label' => esc_html__( 'Text Button', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'View All', 'moore' ),
					'condition' => [
						'show_view_all' => 'yes',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__( 'Image', 'moore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'image_margin',
				[
					'label'      => esc_html__( 'Margin', 'moore' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon', 'moore' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'icon_typography',
					'selector' => '{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-icon i',
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label'     => esc_html__( 'Color', 'moore' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-icon i' => 'color : {{VALUE}};',
					],
				]
			);
			
			$this->add_responsive_control(
				'icon_top',
				[
					'label' => esc_html__( 'Top', 'moore' ),
					'type' 	=> Controls_Manager::SLIDER,
					'size_units' => [ '%', 'px' ],
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
							'min' 	=> 0,
							'max' 	=> 500,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-icon' => 'top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'icon_right',
				[
					'label' => esc_html__( 'Right', 'moore' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ '%', 'px' ],
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
							'min' => 0,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .gallery-container .gallery-icon' => 'right: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();
        // View All Button Style
		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__( 'Text Button', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_view_all' => 'yes',
				],
			]
		);
			$this->add_control(
				'color_text',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .button .show-view-all' => 'color : {{VALUE}};',
					],
				]
		    );
            
			$this->add_control(
				'bgcolor_text',
				[
					'label' => esc_html__( 'Background Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .button ' => 'background-color : {{VALUE}};',
					],
				]
		    );

			$this->add_control(
				'color_text_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .button:hover .show-view-all' => 'color : {{VALUE}};',
					],
				]
			);    

			$this->add_control(
				'bgcolor_text_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery .grid .grid-item .gallery-fancybox .button:hover ' => 'background-color : {{VALUE}};',
					],
				]
		    );
			
		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		// Get list item
		$tabs 		=  $settings['tab_item'];

        $group          =  $settings['id_gallery'];
		$show_view_all  =  $settings['show_view_all'];
		$text           =  $settings['text'] ;
		?>

		<?php if ( $tabs && is_array( $tabs ) ): ?>
	        <div class="ova-gallery">
	        	<div class="grid">
	        		<div class="grid-sizer"></div>
	  				<?php foreach ( $tabs as $key => $items ): 
	  					$img_url 	= $items['image']['url'];
	  					$img_popup 	= $items['image_popup']['url'];
	  					$img_alt 	= isset( $items['image']['alt'] ) ? $items['image']['alt'] : esc_html('Gallery','moore');
	  					$caption 	= $items['caption'];
	  					$item_id 	= 'elementor-repeater-item-' . $items['_id'];
	  					$icon 		= $items['class_icon'];

	  					if ( ! $caption ) {
	  						$caption = $img_alt;
	  					}
	  				?>
	  					<div class="grid-item <?php echo esc_attr( $item_id ); ?><?php if ( 0 == $key ) echo esc_attr(' grid-item-fisrt'); ?>">
	  						<a class="gallery-fancybox" data-src="<?php echo esc_url( $img_popup ); ?>" 
	  							data-fancybox="<?php echo esc_attr( $group ); ?>" 
	  							data-caption="<?php echo esc_attr( $caption ); ?>">

	  							<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $caption ); ?>">

								<?php if ( $show_view_all != 'yes' ) : ?>
	  							<div class="gallery-container">

									<?php if ( $icon ): ?>
										<div class="gallery-icon">
											<i class="<?php echo esc_attr( $icon ); ?>"></i>
										</div>
									<?php endif; ?>

		  						</div>
								<?php else : ?>

									<?php if ( $text ): ?>
										<div class="button">
											<p class="show-view-all">
											    <?php echo esc_html( $text ); ?>
											</p>
										</div>
									<?php endif; ?>

							    <?php endif; ?>

	  						</a>
	  					</div>
	  				<?php endforeach; ?>
	        	</div>

			</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register( new Moore_Elementor_Gallery() );