<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Apartment_Slider extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_apartment_slider';
	}

	
	public function get_title() {
		return esc_html__( 'Apartment Slider', 'moore' );
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
	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings();
		
		// Get current post ID
		$post_id = get_the_ID();
		
		// Get gallery IDs from post meta
		$gallery_ids = get_post_meta($post_id, 'apartment_gallery_ids', true);
		
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
		$data_options['rtl']                = is_rtl() ? true : false;
		?>

		<section class="ova-apartments-slider">
			<div class="slide-apartments-slider owl-carousel owl-theme" data-options="<?php echo esc_attr(json_encode($data_options)) ?>">
				<?php 
				if(!empty($gallery_ids)) : 
					$ids = explode(',', $gallery_ids);
					foreach ($ids as $attachment_id) : 
						$image = wp_get_attachment_image_src($attachment_id, 'full');
						if ($image) :
							$img_url = $image[0];
							$img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
				?>
						<div class="item">
							<div class="apartments-slider-img">
								<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
							</div>
						</div>
				<?php 
						endif;
					endforeach; 
				endif; 
				?>
			</div>
		</section>
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Apartment_Slider() );