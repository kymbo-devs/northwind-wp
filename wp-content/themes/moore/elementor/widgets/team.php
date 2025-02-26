<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Moore_Elementor_Team extends Widget_Base {
	
	public function get_name() {
		return 'moore_elementor_team';
	}
	
	public function get_title() {
		return esc_html__( 'Team', 'moore' );
	}
	
	public function get_icon() {
		return 'eicon-user-circle-o';
	}

	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_keywords() {
		return [ 'social', 'icon', 'team' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {
		/**
		 * CONTENT
		 */
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'moore' ),
			]
		);	
	     	// Add Class control
			 $this->add_control(
				'link_to',
				[
					'label' => esc_html__( 'Link', 'moore' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'none' => esc_html__( 'None', 'moore' ),
						'custom' => esc_html__( 'Custom URL', 'moore' ),
					],
					'default' => 'custom',
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
				'image',
				[
					'label' => esc_html__( 'Image Team', 'moore' ),
					'type' => Controls_Manager::MEDIA,
					'dynamic' => [
						'active' => true,
					],
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'separator' => 'before'
				]
			);
				
			$this->add_control(
				'name',
				[
					'label' => esc_html__( 'Name', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Johan Johnson ', 'moore' ),
				]
			);

			$this->add_control(
				'job',
				[
					'label' => esc_html__( 'Job', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Architect', 'moore' ),
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' => esc_html__( 'Text Alignment', 'moore' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'moore' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'moore' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'moore' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-team .info' => 'text-align: {{VALUE}};',
					],
					'default'	=> 'center',
					'separator' => 'before'
				]
			);

		$this->end_controls_section();
		// INFO Tab
		$this->start_controls_section(
			'section_style_info',
			[
				'label' => esc_html__( 'Info', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'Style Info' );

		$this->start_controls_tab(
			'info_normal',
			[
				'label' => esc_html__( 'Normal', 'moore' ),
			]
		);

			
			$this->add_control(
				'color_name',
				[
					'label' => esc_html__( 'Color Name', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-team .info .name' => 'color : {{VALUE}};'
					],
				]
			);
			$this->add_control(
				'color_job',
				[
					'label' => esc_html__( 'Color Job', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-team .info .job' => 'color : {{VALUE}};',
					],
				]
			);
			
		$this->end_controls_tab();

		$this->start_controls_tab(
			'info_hover',
			[
				'label' => esc_html__( 'Hover', 'moore' ),
			]
		);
				
			
			$this->add_control(
				'color_name_hover',
				[
					'label' => esc_html__( 'Color Name', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-team .info .name:hover' => 'color : {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'color_job_hover',
				[
					'label' => esc_html__( 'Color Job', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-team .info .job:hover' => 'color : {{VALUE}};',
					],
				]
			);

		$this->end_controls_tab();

	    $this->end_controls_tabs();
		    
		$this->end_controls_section();

	}
	private function get_link_url( $settings ) {

		if ( 'none' === $settings['link_to'] ) {
			return false;
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
        // get url image
		$url 	= $settings['image']['url'];
		if ( empty( $url ) ) {
			return;
		}

		// get 
		$name 	= $settings['name'];

		$job 	= $settings['job'];

		$alt_img = $name ? $name : esc_html__( 'team', 'moore' );
        $link                =    $this->get_link_url( $settings );

		 ?>
		 
         <?php if ( $link ) : ?>
			<?php $nofollow = ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? ' rel="nofollow"' : ''; ?>
			<a href="<?php echo esc_url( $link['url'] ); ?> " <?php echo ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? ' target="_blank"' : '' ?>  <?php echo esc_attr( $nofollow ); ?>>
		 <?php endif; ?>
			<div class="ova-team">
				<div class="img">
					<img src="<?php echo esc_url( $url );?>" class="team-img" alt="<?php echo esc_attr( $alt_img ); ?>">
				</div>

				<div class="info">

					<?php if ( !empty ($name)) : ?>
						<h2 class="name">
								<?php echo esc_html($name); ?>
						</h2>
					<?php endif; ?>

					<?php if ( !empty ($job)) : ?>
						<p  class="job">
							<?php echo esc_html($job) ; ?>
						</p>
					<?php endif; ?>

				</div>	
			</div>
		<?php if ( $link ) : ?>
			</a>
		<?php endif; ?>	

		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Team() );