<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Box_Feature extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_box_feature';
	}

	
	public function get_title() {
		return esc_html__( 'Box Feature', 'moore' );
	}

	
	public function get_icon() {
		return 'eicon-info-box';
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
					'label' => __( 'Choose Image', 'moore' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' =>  Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
			
			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'row' => 5,
					'default' => esc_html__('Oakwood floors','moore'),
				]
			);  

			$this->add_control(
				'description',
				[
					'label' => esc_html__( 'Description', 'moore' ),
					'type' => Controls_Manager::TEXTAREA,
					'row' => 5,
					'default' => esc_html__('Quis nostrud exercitation ullamco laboris nisi aliquip ex ea commodo consequat','moore'),
				]
			);
            
			$this->add_control(
				'sub_title',
				[
					'label' => esc_html__( 'Sub-Title', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' =>  esc_html__( 'living room', 'moore' ),
					
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
						'{{WRAPPER}} .ova-box-feature' => 'text-align: {{VALUE}};',
					],
					'default'	=> 'center',
					'separator' => 'before'
				]
			);

		$this->end_controls_section();
        //***********	BEGIN STYLE SECTION	 **********//
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-box-feature .title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature:hover .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_title',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label' => esc_html__( 'Description', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'description_typography',
					'selector' => '{{WRAPPER}} .ova-box-feature .description',
				]
			);

			$this->add_control(
				'color_description',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature .description' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_description_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature:hover .description' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_description',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_description',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_sub_title_style',
			[
				'label' => esc_html__( 'Sub-Title', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'sub_title_typography',
					'selector' => '{{WRAPPER}} .ova-box-feature .sub-title',
				]
			);

			$this->add_control(
				'color_sub_title',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature .sub-title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_sub_title_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature:hover .sub-title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_sub_title',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_sub_title',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();
        
		$this->start_controls_section(
			'section_box_feature_style',
			[
				'label' => esc_html__( 'Box Feature', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);	

			$this->add_control(
				'background_color',
					[
						'label' => esc_html__( 'Background Color', 'moore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-box-feature' => 'background-color : {{VALUE}};',
						],
					]
				);

			$this->add_control(
				'background_color_hover',
					[
						'label' => esc_html__( 'Background Color Hover', 'moore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
						'{{WRAPPER}} .ova-box-feature:hover' => 'background-color : {{VALUE}};',
						],
					]
				);
			
			$this->add_control(
				'border_color',
					[
						'label' => esc_html__( 'Border Color', 'moore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-box-feature' => 'border-color : {{VALUE}};',
						],
					]
				);

			$this->add_responsive_control(
				'box_border_width',
				[
					'label' => esc_html__( 'Border Width', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature ' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
			$this->add_responsive_control(
				'box_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

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

		$title               =    $settings['title'];
		$sub_title           =    $settings['sub_title'];
		$description         =    $settings['description'];
		$url 	             =    $settings['image']['url'];
		if ( empty( $url ) ) {
			return;
		}
		$alt = $title ? $title : esc_html__( 'Box Feature', 'moore' );
		$link                =    $this->get_link_url( $settings );

		 ?>
        
		<?php if ( $link ) : ?>
			<?php $nofollow = ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? ' rel="nofollow"' : ''; ?>
			<a href="<?php echo esc_url( $link['url'] ); ?> " <?php echo ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? ' target="_blank"' : '' ?>  <?php echo esc_attr( $nofollow ); ?>>
		 <?php endif; ?>
            <div class="ova-box-feature">

					<div class="image">
						<img src="<?php echo esc_attr($url) ;?>" alt="<?php echo esc_attr($alt); ?>">		
					</div>  

				<div class="info">
                    <?php if (!empty($title)) : ?>

					<h3 class="title">
						<?php echo esc_html($title); ?>
				    </h3>

					<?php endif; ?>

					<?php if (!empty($description)) : ?>

						<p class="description">
							<?php echo esc_html($description); ?>
						</p>

					<?php endif; ?>

					<?php if (!empty($sub_title)) : ?>

						<p class="sub-title">
							<?php echo esc_html($sub_title); ?>
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
$widgets_manager->register( new Moore_Elementor_Box_Feature() );