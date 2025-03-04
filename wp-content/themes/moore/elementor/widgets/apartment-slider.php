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
			<style>
				.ova-apartments-slider {
				position: relative;
				}

				.ova-apartments-slider .owl-stage-outer {
				padding-bottom: 90px;
				}

				/* First .slide-apartments-slider block */
				.ova-apartments-slider .slide-apartments-slider {
				position: relative;
				}

				.ova-apartments-slider .slide-apartments-slider:hover .owl-nav {
				opacity: 1;
				transition: all 0.3s ease;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item {
				transition: all 0.3s ease;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item {
				position: relative;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item:hover .client_info:before {
				opacity: 0.9;
				transition: all 0.3s ease;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item:hover .apartments-slider-img img {
				transition: all 0.3s ease;
				transform: scale(1.2, 1.2);
				-webkit-transform: scale(1.2, 1.2);
				-moz-transform: scale(1.2, 1.2);
				-o-transform: scale(1.2, 1.2);
				-ms-transform: scale(1.2, 1.2);
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .apartments-slider-img {
				overflow: hidden;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .apartments-slider-img img {
				transition: all 0.3s ease;
				display: block;
				width: 100%;
				height: calc(100vh - 150px);
				object-fit: cover;
				object-position: center;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info {
				position: absolute;
				display: block;
				width: 100%;
				height: 100%;
				top: 0;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info:before {
				content: '';
				position: absolute;
				top: 0;
				display: block;
				width: 100%;
				height: 100%;
				background: linear-gradient(180deg, rgba(47, 47, 47, 0) 50%, #2F2F2F 100%);
				-webkit-transition: all 0.3s ease;
				-moz-transition: all 0.3s ease;
				-o-transition: all 0.3s ease;
				transition: all 0.3s ease;
				opacity: 1;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info {
				position: absolute;
				width: 100%;
				padding-left: 12%;
				padding-right: 12%;
				bottom: -90px;
				-webkit-transition: all 0.3s ease;
				-moz-transition: all 0.3s ease;
				-o-transition: all 0.3s ease;
				transition: all 0.3s ease;
				}

				@media screen and (max-width: 530px) {
				.ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info {
					padding-left: 30px;
					padding-right: 30px;
				}
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .title {
				text-align: center;
				margin: 0;
				font-size: 40px;
				line-height: 56px;
				padding-bottom: 5px;
				font-weight: 400;
				text-transform: uppercase;
				color: #fafafa;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .sub-title {
				text-align: center;
				margin: 0;
				font-size: 14px;
				padding-top: 5px;
				font-weight: 500;
				line-height: 21px;
				text-transform: uppercase;
				color: #fafafa;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-dots {
				text-align: center;
				margin-top: 30px;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-dots .owl-dot {
				outline: none;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-dots .owl-dot span {
				width: 10px;
				height: 10px;
				margin: 5px;
				background-color: var(--heading);
				display: block;
				-webkit-backface-visibility: visible;
				transition: opacity 0.2s ease;
				border-radius: 30px;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-dots .owl-dot.active span {
				width: 15px;
				border-radius: 5px;
				opacity: 1;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav {
				transition: all 0.3s ease;
				opacity: 0;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav .owl-prev,
				.ova-apartments-slider .slide-apartments-slider .owl-nav .owl-next {
				position: absolute;
				top: 43.5%;
				max-width: 50px;
				min-height: 50px;
				width: 100%;
				background-color: rgba(0, 0, 0, 0.3);
				border-radius: 50%;
				transition: all 0.3s ease;
				font-size: 22px;
				color: #fff;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav .owl-prev i,
				.ova-apartments-slider .slide-apartments-slider .owl-nav .owl-next i {
				-webkit-backface-visibility: visible;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav .owl-prev {
				left: -15px;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav .owl-prev:hover {
				background-color: rgba(0, 0, 0, 0.7);
				}

				@media screen and (max-width: 1024px) {
				.ova-apartments-slider .slide-apartments-slider .owl-nav .owl-prev {
					left: 10px;
				}
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav .owl-next {
				right: -15px;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav .owl-next:hover {
				background-color: rgba(0, 0, 0, 0.7);
				}

				@media screen and (max-width: 1024px) {
				.ova-apartments-slider .slide-apartments-slider .owl-nav .owl-next {
					right: 10px;
				}
				}

				/* Second .slide-apartments-slider block */
				.ova-apartments-slider .slide-apartments-slider .owl-nav {
				position: absolute;
				width: 100%;
				top: 50%;
				transform: translateY(-50%);
				margin: 0;
				padding: 0 30px;
				pointer-events: none;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav button {
				pointer-events: all;
				width: 50px;
				height: 50px;
				background: rgba(47, 47, 47, 0.8);
				border-radius: 50%;
				transition: all 0.3s ease;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav button:hover {
				background: var(--e-global-color-primary);
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav button i {
				color: #fafafa;
				font-size: 20px;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav button.owl-prev {
				float: left;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-nav button.owl-next {
				float: right;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item {
				position: relative;
				overflow: hidden;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item:hover .apartments-slider-img img {
				transform: scale(1.1);
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item:hover .client_info:before {
				opacity: 0.9;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .apartments-slider-img img {
				transition: all 0.3s ease;
				height: 600px;
				object-fit: cover;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info:before {
				background: linear-gradient(180deg, rgba(47, 47, 47, 0) 0%, rgba(47, 47, 47, 0.8) 100%);
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info {
				bottom: 60px;
				padding: 0 60px;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .title {
				font-family: var(--primary-font);
				margin-bottom: 10px;
				}

				.ova-apartments-slider .slide-apartments-slider .owl-item .item .client_info .info .sub-title {
				font-family: var(--primary-font);
				letter-spacing: 1px;
				}

				/* Fraction counter */
				.ova-apartments-slider .fraction-counter {
				position: absolute;
				bottom: 30px;
				right: 30px;
				background: rgba(47, 47, 47, 0.8);
				color: #fafafa;
				padding: 8px 15px;
				border-radius: 4px;
				font-size: 14px;
				font-weight: 500;
				z-index: 2;
				}

				.ova-apartments-slider .fraction-counter .current {
				color: var(--e-global-color-primary);
				}

			</style>
		</section>
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Apartment_Slider() );