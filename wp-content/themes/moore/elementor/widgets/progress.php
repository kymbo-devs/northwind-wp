<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Progress extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_progress';
	}

	
	public function get_title() {
		return esc_html__( 'Progress', 'moore' );
	}

	
	public function get_icon() {
		return 'eicon-date';
	}

	
	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_script_depends() {
		return [ '' ];
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
				'image',
				[
					'label' => __( 'Choose Image', 'moore' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' =>  Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'class_icon',
				[
					'label' => esc_html__( 'Icon', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' =>  esc_html__( 'fas fa-plus', 'moore' ),
					
				]
			);

			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Link Icon', 'moore' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'https://your-link.com', 'moore' ),
					'show_label' => true,
				]
			);

			$this->add_control(
				'day',
				[
					'label' => esc_html__( 'Days', 'moore' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 24,
					'min' => 1,
					'max' => 31,
					'step' => 1,
				]
			);

            $this->add_control(
				'month',
				[
					'label' => esc_html__( 'Month', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'February',
				]
			);
			
			$this->add_control(
				'year',
				[
					'label' => esc_html__( 'Year', 'moore' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 2021,
					'min' => 1890,
					'max' => 2050,
					'step' => 1,
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' => esc_html__( 'Alignment', 'moore' ),
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
						'{{WRAPPER}} .ova-progress' => 'text-align: {{VALUE}};',
					],
					'default'	=> 'center',
					'separator' => 'before'
				]
			);

		$this->end_controls_section();

		 //***********	BEGIN STYLE SECTION	 **********//
		 $this->start_controls_section(
			'section_day_style',
			[
				'label' => esc_html__( 'Days', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'day_typography',
					'selector' => '{{WRAPPER}} .ova-progress .day',
				]
			);

			$this->add_control(
				'color_day',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .day' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_day_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress:hover .day' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_day',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-progress .day' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_day',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-progress .day' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_month_style',
			[
				'label' => esc_html__( 'Month', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'month_typography',
					'selector' => '{{WRAPPER}} .ova-progress .month',
				]
			);

			$this->add_control(
				'color_month',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .month' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_month_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress:hover .month' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_month',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-progress .month' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_month',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-progress .month' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_year_style',
			[
				'label' => esc_html__( 'Year', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'year_typography',
					'selector' => '{{WRAPPER}} .ova-progress .year',
				]
			);

			$this->add_control(
				'color_year',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .year' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_year_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress:hover .year' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_year',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-progress .year' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_year',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-progress .year' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'color_icon',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .icon i' => 'color : {{VALUE}};',
					],
				]
		    );
            
			$this->add_control(
				'color_icon_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .icon:hover i' => 'color : {{VALUE}};',
					],
				]
			);    
            
			$this->add_control(
				'bgcolor_icon',
				[
					'label' => esc_html__( 'Background Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .icon ' => 'background-color : {{VALUE}};',
					],
				]
		    );

			$this->add_control(
				'bgcolor_icon_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .icon:hover ' => 'background-color : {{VALUE}};',
					],
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
						'{{WRAPPER}} .ova-progress .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			
		$this->end_controls_section();
		
	}

	// Render Here
	protected function render() {

		$settings = $this->get_settings();
        $day               =    $settings['day'];
		$month             =    $settings['month'];
		$year              =    $settings['year'];
		$class_icon        =    $settings['class_icon'];
		$url 	           =    $settings['image']['url'];
		$alt               =    esc_html__( 'progress', 'moore' );
		$link              =    $settings['link'];
		if ( empty( $url ) ) {
			return;
		}
		 ?>
        
		<?php if ( $link['url'] != '' ) : ?>
	    <?php $nofollow = ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? ' rel="nofollow"' : ''; ?>
		<a href="<?php echo esc_url( $link['url'] ); ?> " <?php echo ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? ' target="_blank"' : '' ?>  <?php echo esc_attr( $nofollow ); ?>>
		 <?php endif; ?>
		<div class="ova-progress">

				<div class="image">
					<img src="<?php echo esc_attr($url) ;?>" alt="<?php echo esc_attr($alt); ?>">

					<?php if (!empty($class_icon)) : ?>
                        <?php if ( $link['url'] != '' ) : ?>
						<div class="icon">
							<i class="<?php echo esc_html($class_icon); ?>"></i>
					    </div>
						<?php endif; ?>
					<?php endif; ?>	
				</div>  

				<div class="info">
                    <?php if (!empty($day)) : ?>

						<p class="day">
							<?php echo esc_html($day); ?>
						</p>

					<?php endif; ?>

					<?php if (!empty($month)) : ?>

						<p class="month">
							<?php echo esc_html($month); ?>
						</p>

					<?php endif; ?>

					<?php if (!empty($year)) : ?>

						<p class="year">
							<?php echo esc_html($year); ?>
						</p>

					<?php endif; ?>
				</div>

		</div>
		<?php if ( $link['url'] =! '') : ?>
	    </a>
		<?php endif; ?>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Progress() );