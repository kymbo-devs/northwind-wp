<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Gallery_Simple extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_gallery_simple';
	}

	
	public function get_title() {
		return esc_html__( 'Gallery Simple', 'moore' );
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
		return [ 'moore-elementor-gallery-simple' ];
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
				'id_gallery_simple',
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
					'label'   => esc_html__( 'Gallery Simple Image', 'moore' ),
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

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Items Gallery Simple', 'moore' ),
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
				'gap',
				[
					'label' => esc_html__( 'Grid Gap', 'moore' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 150,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-simple ' => 'gap: {{SIZE}}{{UNIT}};',
					],
					'separator' => 'before',
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

			$this->add_responsive_control(
				'size_icon',
				[
					'label' => esc_html__( 'Size', 'moore' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 10,
							'max' => 500,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-simple  .grid-item  .gallery-simple-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->add_control(
				'icon_color',
				[
					'label'     => esc_html__( 'Color', 'moore' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-simple  .grid-item  .gallery-simple-icon i' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-gallery-simple  .grid-item  .gallery-simple-icon ' => 'top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'icon_left',
				[
					'label' => esc_html__( 'Left', 'moore' ),
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
						'{{WRAPPER}} .ova-gallery-simple .grid-item  .gallery-simple-icon ' => 'left: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();

	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();
		
		// Get list item
		$tabs 		    =  $settings['tab_item'];
      
		$group          =  $settings['id_gallery_simple'];
		
		 ?>
           
		   <?php if ( $tabs && is_array( $tabs ) ): ?>
	        <div class="ova-gallery-simple">
	        	
	  				<?php foreach ( $tabs as $key => $items ): 
	  					$img_url 	= $items['image']['url'];
	  					$img_popup 	= $items['image_popup']['url'];
	  					$img_alt 	= isset( $items['image']['alt'] ) ? $items['image']['alt'] : esc_html__('Gallery Simple','moore');
	  					$caption 	= $items['caption'];
	  					$icon 		= $items['class_icon'];

	  					if ( ! $caption ) {
	  						$caption = $img_alt;
	  					}
	  				?>
					<a class="gallery-simple-fancybox" data-src="<?php echo esc_url( $img_popup ); ?>" 
	  						data-fancybox="<?php echo esc_attr( $group ); ?>" 
	  						data-caption="<?php echo esc_attr( $caption ); ?>">
					    <div class="grid-item">

	  							<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $caption ); ?>">
	  				
									<?php if ( $icon ): ?>
										<div class="gallery-simple-icon">
											<i class="<?php echo esc_attr( $icon ); ?>"></i>
										</div>
									<?php endif; ?>	
					    </div>
					</a>

	  				<?php endforeach; ?>	

			</div>
		<?php
		endif;
		 	
	}

	
}
$widgets_manager->register( new Moore_Elementor_Gallery_Simple() );