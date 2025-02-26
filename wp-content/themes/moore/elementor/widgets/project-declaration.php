<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Project_Declaration extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_project_declaration';
	}

	
	public function get_title() {
		return esc_html__( 'Project Declaration', 'moore' );
	}

	
	public function get_icon() {
		return 'eicon-download-kit';
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
				'title',
				[
					'label' => esc_html__( 'Title', 'moore' ),
					'type' => Controls_Manager::TEXTAREA,
					'row' => 5,
					'default' => esc_html__('Change in the project declaration from March 26, 2021','moore'),
				]
			);

			$this->add_control(
				'sub-title',
				[
					'label' => esc_html__( 'Sub-Title', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Fonchenko LLC', 'moore' ),
				]
			);
            
			$this->add_control(
				'date',
				[
					'label' => esc_html__( 'Date', 'moore' ),
					'type' 	=> Controls_Manager::TEXT,
					'default'=> '21.9.2021',
				]
			);

            $this->add_control(
				'file',
				[
					'label' => __( 'Upload file for Download', 'moore' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' =>  Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'info_file',
				[
					'label' => __( 'Info file', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'PDF, ', 'moore' ),
				]
			);

			$this->add_control(
				'text_button',
				[
					'label' => esc_html__( 'Text Button', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__('Download', 'moore'),
				]
			);
		   
		$this->end_controls_section();
        //SECTION TAB STYLE title
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
					'selector' => '{{WRAPPER}} .ova-project-declaration .title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration:hover .title' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-project-declaration .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-project-declaration .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();
        //SECTION TAB STYLE sub-title
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
					'selector' => '{{WRAPPER}} .ova-project-declaration .sub-title',
				]
			);

			$this->add_control(
				'color_sub_title',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .sub-title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_sub_title_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration:hover .sub-title' => 'color : {{VALUE}};',
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
						'{{WRAPPER}} .ova-project-declaration .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-project-declaration .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		 //SECTION TAB STYLE date
		 $this->start_controls_section(
			'section_date_style',
			[
				'label' => esc_html__( 'Date', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'date_typography',
					'selector' => '{{WRAPPER}} .ova-project-declaration .date',
				]
			);

			$this->add_control(
				'color_date_title',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .date' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_date_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration:hover .date' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_date',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_date',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		 //SECTION TAB STYLE info-file
		 $this->start_controls_section(
			'section_info_file_style',
			[
				'label' => esc_html__( 'Info File', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'info_file_typography',
					'selector' => '{{WRAPPER}} .ova-project-declaration  .info-file',
				]
			);

			$this->add_control(
				'color_info_file_title',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration  .info-file' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_info_file_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration:hover .info-file' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_info_file',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .info-file' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_info_file',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .info-file' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		//SECTION TAB STYLE button
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'button_typography',
					'selector' => '{{WRAPPER}} .ova-project-declaration  .button',
				]
			);

			$this->add_control(
				'color_button',
				[
					'label' => esc_html__( 'Color', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .button' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_button_hover',
				[
					'label' => esc_html__( 'Color Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .button:hover' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_color_button',
				[
					'label' => esc_html__( 'Background', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .button' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_color_button_hover',
				[
					'label' => esc_html__( 'Background Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration  .button:hover' => 'background-color : {{VALUE}};',
					],
				]
			);
            
			$this->add_control(
				'border_radius_button',
				[
					'label' => esc_html__( 'Border Radius', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_button',
				[
					'label' => esc_html__( 'Padding', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_button',
				[
					'label' => esc_html__( 'Margin', 'moore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-project-declaration .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		//END SECTION TAB STYLE button
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		$title          =    $settings['title'];
		$subtitle 	    =    $settings['sub-title'];
        $text_button    =    $settings['text_button'];
		// get url file
		$url           =     $settings['file']['url'];	
        // get date
        $date           =    $settings['date'];
        // get size of file
		$file           =    get_attached_file( $settings['file']['id']);
		$file_size      =    size_format( filesize($file),1 );
		$info_file      =    $settings['info_file'] .$file_size;
		 ?>
         
		 <div class="ova-project-declaration">

				<div class="info">

					<?php if ( !empty ($title)) : ?>
						<h3 class="title">
								<?php echo esc_html($title); ?>
						</h3>
					<?php endif; ?>

					<?php if ( !empty ($subtitle)) : ?>
						<p  class="sub-title">
							<?php echo esc_html($subtitle) ; ?>
						</p>
					<?php endif; ?>

					<?php if ( !empty ($date)) : ?>
						<p  class="date">
							<?php echo esc_html($date) ; ?>
						</p>
					<?php endif; ?>

				</div>

                 <div class="download">
                  
				 <a href="<?php echo esc_url( $url ); ?> " rel="nofollow" target="_blank">
					<div class="button">
						<?php echo esc_html($text_button); ?>
					</div>
				</a>
					<?php if( $info_file != '') : ?>
					  <span class="info-file">
						  <?php echo esc_html($info_file);?>
					  </span>
					<?php endif;?>

				 </div>
				

		</div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Project_Declaration() );