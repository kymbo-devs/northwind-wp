<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Box_Feature2 extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_box_feature2';
	}

	
	public function get_title() {
		return esc_html__( 'Box Feature2', 'moore' );
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
					'label' => esc_html__( 'Choose Image', 'moore' ),
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
				'title',
				[
					'label' => esc_html__( 'Title', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Dining & Nightlife', 'moore' ),
				]
			);

			$this->add_control(
				'sub-title',
				[
					'label' => esc_html__( 'Sub-Title', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( '9 Maiden Ln', 'moore' ),
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

		$this->end_controls_section();

		//******Info style*****/
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
					'selector' => '{{WRAPPER}} .ova-box-feature2 .title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature2 .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature2:hover .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_line_title_hover',
				[
					'label' => esc_html__( 'Color Line Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature2 .title:after' => 'background-color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-box-feature2 .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-box-feature2 .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'selector' => '{{WRAPPER}} .ova-box-feature2 .sub-title',
				]
			);

			$this->add_control(
				'color_sub_title',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature2 .sub-title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_sub_title_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature2:hover .sub-title' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-box-feature2 .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-box-feature2 .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

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
						'{{WRAPPER}} .ova-box-feature2 .button p' => 'color : {{VALUE}};',
					],
				]
		    );
            
			$this->add_control(
				'bgcolor_text',
				[
					'label' => esc_html__( 'Background Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature2 .button ' => 'background-color : {{VALUE}};',
					],
				]
		    );

			$this->add_control(
				'color_text_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature2 .button:hover p' => 'color : {{VALUE}};',
					],
				]
			);    

			$this->add_control(
				'bgcolor_text_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-box-feature2 .button:hover ' => 'background-color : {{VALUE}};',
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
		$subtitle 	         =    $settings['sub-title'];
		$show_view_all       =    $settings['show_view_all'];
		$text 	             =    $settings['text'];
		$url 	             =    $settings['image']['url'];
		if ( empty( $url ) ) {
			return;
		}
		$alt = $title ? $title : esc_html__('Box Feature2', 'moore' );
		$link                =    $this->get_link_url( $settings );

		 ?>
        <?php if ( $link ) : ?>
			<?php $nofollow = ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? ' rel="nofollow"' : ''; ?>
			<a href="<?php echo esc_url( $link['url'] ); ?> " <?php echo ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? ' target="_blank"' : '' ?>  <?php echo esc_attr( $nofollow ); ?>>
		 <?php endif; ?>
			<div class="ova-box-feature2">

				<div class="img">
					<img src="<?php echo esc_url( $url );?>" class="box-feature2-img" alt="<?php echo esc_attr( $alt ); ?>">

					<?php if ($show_view_all ==='yes') : ?>
						<?php if ( !empty ($text)) : ?>

						<div class="button">
							<p class="text"><?php echo esc_html($text); ?></p>
						</div>

						<?php endif; ?>
				    <?php endif; ?>

				</div>
              
				<div class="info">

					<?php if ( !empty ($title)) : ?>
						<h2 class="title">
								<?php echo esc_html($title); ?>
						</h2>
					<?php endif; ?>
                    
					<?php if ( !empty ($subtitle)) : ?>
						<p  class="sub-title">
							<?php echo esc_html($subtitle) ; ?>
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
$widgets_manager->register( new Moore_Elementor_Box_Feature2() );