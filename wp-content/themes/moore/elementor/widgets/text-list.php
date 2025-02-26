<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Text_List extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_text_list';
	}

	
	public function get_title() {
		return esc_html__( 'Text List', 'moore' );
	}

	
	public function get_icon() {
		return 'eicon-editor-list-ul';
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
				'label' => esc_html__( 'Text List', 'moore' ),
			]
		);	
			
			
			// Add Class control
		    $this->add_control(
				'view',
				[
					'label' => esc_html__( 'Layout', 'moore' ),
					'type' => Controls_Manager::CHOOSE,
					'default' => 'block',
					'options' => [
						'block' => [
							'title' => esc_html__( 'Default', 'moore' ),
							'icon' => 'eicon-editor-list-ul',
						],
						'inline-flex' => [
							'title' => esc_html__( 'Inline', 'moore' ),
							'icon' => 'eicon-ellipsis-h',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-text-list' => 'display : {{VALUE}};',	
					],
				]
			);
            
			$repeater = new \Elementor\Repeater();
            
			$repeater->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'moore' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'https://your-link.com', 'moore' ),
					'show_label' => true,
				]
			);

			$repeater->add_control(
				'content',
				[
					'label' => esc_html__( 'Content', 'moore' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' =>  esc_html__( 'Add Text Content', 'moore' ),
					
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
							'link'    => esc_html__( '', 'moore' ),
							'content' => esc_html__( 'laundry and valet service', 'moore' ),
						],
						[	
							'link'    => esc_html__( '', 'moore' ),
							'content' => esc_html__( 'High-speed WiFi access', 'moore' ),
						],
						[	
							'link'    => esc_html__( '', 'moore' ),
							'content' => esc_html__( 'Luxury furnishings', 'moore' ),
						],
						[	
							'link'    => esc_html__( '', 'moore' ),
							'content' => esc_html__( 'Private condominium reception', 'moore' ),
						],
						[	
							'link'    => esc_html__( '', 'moore' ),
							'content' => esc_html__( 'catering facilities', 'moore' ),
						],
					],
					'title_field' => '{{{ content }}}',
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
					'selector' => '{{WRAPPER}} .ova-text-list .item',
				]
			);

			$this->add_control(
				'color_items',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-text-list .item' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_items_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-text-list .item:hover' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_line_items_hover',
				[
					'label' => esc_html__( 'Color Line Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-text-list .item:before' => 'background-color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-text-list .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-text-list .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();
        // *******end content items style *****//

	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

        $items               =    $settings['items'];
		 ?>
        <div class="ova-text-list">
		    <?php 
		       foreach( $items as $item ) { 
				   $link    = $item['link'];
				   $content = $item['content'];
				  
			?>
			<?php if ( $link['url'] != '') : ?>
			<?php $nofollow = ( isset( $link['nofollow'] ) && $link['nofollow'] ) ? ' rel="nofollow"' : ''; ?>
			<a href="<?php echo esc_url( $link['url'] ); ?> " <?php echo ( isset( $link['is_external'] ) && $link['is_external'] !== '' ) ? ' target="_blank"' : '' ?>  <?php echo esc_attr( $nofollow ); ?>>
		    <?php endif; ?>

			    <?php if( !empty( $item['content'] ) ) : ?>
				    <p class="item">
						<?php echo esc_html($item['content']);?>
				   </p>
				<?php endif ?>

            <?php if ( $link['url'] != '' ) : ?>
			</a>
		    <?php endif; ?>

			<?php } ?>
		</div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Text_List() );