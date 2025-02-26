<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Package extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_package';
	}

	
	public function get_title() {
		return esc_html__( 'Package', 'moore' );
	}

	
	public function get_icon() {
		return ' eicon-image-box';
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
				'class_icon',
				[
					'label' => esc_html__( 'Icon', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' =>  esc_html__( 'flaticon-macro', 'moore' ),
					
				]
			);
			
			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'row' => 5,
					'default' => esc_html__('Classy Amenities','moore'),
				]
			);
            
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'content',
				[
					'label' => esc_html__( 'Content', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' =>  esc_html__( 'Conference Room', 'moore' ),
					
				]
			);

			$this->add_control(
				'items',
				[
					'label' => esc_html__( 'List Content', 'moore' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[	
							'content' => esc_html__( 'Conference Room', 'moore' ),
						],
						[	
							'content' => esc_html__( 'fast Wi-Fi', 'moore' ),
						],
						[	
							'content' => esc_html__( 'parking Services', 'moore' ),
						],
						[	
							'content' => esc_html__( 'Dining options', 'moore' ),
						],
						[	
							'content' => esc_html__( 'fitness centers', 'moore' ),
						],
						[	
							'content' => esc_html__( 'Eco-friendly', 'moore' ),
						]
					],
					'title_field' => '{{{ content }}}',
				]
			);

		$this->end_controls_section();

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
					'selector' => '{{WRAPPER}} .ova-package .title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-package .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-package:hover .title' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-package .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-package .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();
        // *******content items style *****//
		$this->start_controls_section(
			'section_items_style',
			[
				'label' => esc_html__( 'Items', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'items_typography',
					'selector' => '{{WRAPPER}} .ova-package .items',
				]
			);

			$this->add_control(
				'color_items',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-package .items' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_items_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-package .items:hover' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_line_items_hover',
				[
					'label' => esc_html__( 'Color Line Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-package .items:before' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_items',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-package .items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_items',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-package .items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();
        // *******end content items style *****//
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
						'{{WRAPPER}} .ova-package .icon i' => 'color : {{VALUE}};',
					],
				]
		    );
            
			$this->add_control(
				'color_icon_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-package:hover .icon i' => 'color : {{VALUE}};',
					],
				]
			);    
            
			$this->add_control(
				'bgcolor_icon',
				[
					'label' => esc_html__( 'Background Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-package .icon ' => 'background-color : {{VALUE}};',
					],
				]
		    );

			$this->add_control(
				'bgcolor_icon_hover',
				[
					'label' => esc_html__( 'Background Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-package:hover .icon ' => 'background-color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-package .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			
		$this->end_controls_section();

		$this->start_controls_section(
			'section_package_style',
			[
				'label' => esc_html__( 'Package', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);	

			$this->add_control(
				'background_color',
					[
						'label' => esc_html__( 'Background Color', 'moore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-package' => 'background-color : {{VALUE}};',
						],
					]
				);

			$this->add_control(
				'background_color_hover',
					[
						'label' => esc_html__( 'Background Color Hover', 'moore' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
						'{{WRAPPER}} .ova-package:hover' => 'background-color : {{VALUE}};',
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
		$class_icon          =    $settings['class_icon'];
		$url 	             =    $settings['image']['url'];
		if ( empty( $url ) ) {
			return;
		}
		$items               =    $settings['items'];
		$alt                 =    $title ? $title : esc_html__( 'package', 'moore' );
		$link                =    $this->get_link_url( $settings );

		 ?>
           
		   <?php if ( $link ) : ?>
				<?php $nofollow = ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? ' rel="nofollow"' : ''; ?>
				<a href="<?php echo esc_url( $link['url'] ); ?> " <?php echo ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? ' target="_blank"' : '' ?>  <?php echo esc_attr( $nofollow ); ?>>
		   <?php endif; ?>
            <div class="ova-package">

					<div class="image">
						<img src="<?php echo esc_attr($url) ;?>" alt="<?php echo esc_attr($alt); ?>">		
					</div>  
			    <?php if (!empty($class_icon)) : ?>

				     <div class="align-icon">
						<div class="icon">
							<i class="<?php echo esc_attr($class_icon)?>"></i>
						</div>
					 </div>

				<?php endif; ?>

				<div class="info">
                    <?php if (!empty($title)) : ?>

					<h3 class="title">
						<?php echo esc_html($title); ?>
				    </h3>
	
					<?php endif; ?>

					<?php if( !empty( $items ) ) : ?>
						<?php 
						foreach( $items as $item ) { 
						?>
						  <?php if( !empty( $item['content'] ) ) : ?>
							<p class="items">
						        <?php echo esc_html($item['content']);?>
							</p>
						  <?php endif ?>
						<?php } ?>
				    <?php endif ?>

				</div>

			</div>
		  <?php if ( $link ) : ?>
			</a>
		  <?php endif; ?>
		 	
		<?php
	}

}
$widgets_manager->register( new Moore_Elementor_Package() );