<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Header_Left extends Widget_Base {

	
	public function get_name() {

		return 'moore_elementor_header_left';
	}

	
	public function get_title() {
		return esc_html__( 'Header Left', 'moore' );
	}

	
	public function get_icon() {
		return 'eicon-header';
	}

	
	public function get_categories() {
		return [ 'hf' ];
	}

	public function get_script_depends() {
		return [ 'moore-elementor-header-left' ];
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
				'link_to',
				[
					'label' => esc_html__( 'Link', 'moore' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'home' => esc_html__( 'Home Page', 'moore' ),
						'none' => esc_html__( 'None', 'moore' ),
						'custom' => esc_html__( 'Custom URL', 'moore' ),
					],
					'default' => 'home',

					
				]
			);

			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'moore' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'https://your-link.com', 'moore' ),
					'condition' => [
						'link_to' => 'custom',
					],
					'show_label' => false,
				]
			);
			$this->add_control(
				'logo',
				[
					'label' => esc_html__( 'Logo', 'moore' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'phone',
				[
					'label' => esc_html__( 'phone', 'moore' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'email',
				[
					'label' => esc_html__( 'Email', 'moore' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			
			$this->add_control(
				'top_content',
				[
					'label' => esc_html__( 'Shortcode - Top Content', 'moore' ),
					'type' => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'Example: [moore-elementor-template id="451"]', 'moore' )
				]
			);


			$menus = \wp_get_nav_menus();
			$list_menu = array();
			foreach ($menus as $menu) {
				$list_menu[$menu->slug] = $menu->name;
			}
          
			$this->add_control(
				'menu_slug',
				[
					'label' => esc_html__( 'Select Menu', 'moore' ),
					'type' => Controls_Manager::SELECT,
					'options' => $list_menu,
					'default' => '',
					'prefix_class' => 'elementor-view-',
				]
			);

            $this->add_responsive_control(
				'height_menu',
				[
					'label' => esc_html__( 'Height Menu', 'moore' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', '%' ],
					'range' => [
						'px' => [
							'min' => 100,
							'max' => 1000,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-header-left .right .container-menu' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'bottom_content',
				[
					'label' => esc_html__( 'Shortcode - Bottom Content', 'moore' ),
					'type' => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'Example: [moore-elementor-template id="451"]', 'moore' )
				]
			);

			// Add Class control
			$this->add_control(
				'class',
				[
					'label' => esc_html__( 'Class', 'moore' ),
					'type' => Controls_Manager::TEXT,
				]
			);

		$this->end_controls_section();

		
	}

	private function get_link_url( $settings ) {

		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'home' === $settings['link_to'] ) {
			return array( 'url' => home_url('/') );
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}

			return $settings['link'];
		}

		return false;
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();
		$class          = $settings['class'];
		$top_content    = $settings['top_content'];
		$bottom_content = $settings['bottom_content'];
		$phone          = $settings['phone'];
		$email          = $settings['email'];
		if ( empty( $settings['logo']['url'] ) ) {
			return;
		} 
		$link = $this->get_link_url( $settings );
		?>

			<div class="ova-header-left <?php echo esc_attr($class); ?>">
				
				<div class="left">

					<?php if ( $link ) : ?>
					<?php $nofollow = ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? ' rel="nofollow"' : ''; ?>
					<a href="<?php echo esc_url( $link['url'] ); ?> " <?php echo ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? ' target="_blank"' : '' ?>  <?php echo esc_attr( $nofollow ); ?>>
					<?php endif; ?>
						<div class="logo">
							<img src="<?php echo esc_url( $settings['logo']['url'] ); ?>" 
							alt="<?php bloginfo('name');  ?>" 
							class="logo_header_left"
							/>
						</div>
                    <?php if ( $link ) : ?>
					</a>
					<?php endif; ?>

					<div class="bottom">

					   <?php if( !empty($phone) ) : ?>
						<div class="phone">
							<?php echo esc_html($phone);?>
						</div>
                       <?php endif;?>

					   <?php if( !empty($email) ) : ?>
						<div class="mail">
						    <?php echo esc_html($email);?>
						</div>
					   <?php endif;?>
					   
						<div class="btn">
							<button class="header-menu-toggle">
				            	<i class="ovaicon-menu-1"></i>
				            </button>
						</div>

					</div>

					
				</div>

				<div class="right" id="right">
					<div class="content">
						
						<div class="top">
							<?php 
								echo do_shortcode( $top_content );
							?>

							<nav class="container-menu">    
					           <?php
									wp_nav_menu( [
										'theme_location'  => $settings['menu_slug'],
										'container_class' => 'primary-navigation',
										'menu'              => $settings['menu_slug'],
									] );
								?>
							</nav>
						</div>

						

						<div class="bottom">
							<?php 
								echo do_shortcode( $bottom_content );
							?>
						</div>	
					</div>
						

					<div class="header-left-site-overlay"></div>

				</div>



			</div>


		 	
		<?php


	}


}
$widgets_manager->register( new Moore_Elementor_Header_Left() );