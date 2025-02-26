<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Moore_Elementor_Choice_Language extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_choice_language';
	}

	
	public function get_title() {
		return esc_html__( 'Choice Language', 'moore' );
	}

	
	public function get_icon() {
		return 'eicon-post-list';
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
				'current_lang',
				[
					'label' => esc_html__( 'Current Language', 'moore' ),
					'type' 	=> Controls_Manager::HEADING,
				]
			);

			$this->add_control(
	            'type',
	            [
	                'label' 	=> esc_html__( 'Type', 'moore' ),
	                'type' 		=> Controls_Manager::SELECT,
	                'options' 	=> [
	                    'v1' => esc_html__( 'Type 1', 'moore' ),
	                    'v2' => esc_html__( 'Type 2', 'moore' ),
	                ],
	                'default' 	=> 'v1',
	            ]
	        );

			$this->add_control(
				'flag_title',
				[
					'label' 	=> esc_html__( 'Nation', 'moore' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'English', 'moore' ),
				]
			);


			$this->add_control(
				'dropdown_lang',
				[
					'label' => esc_html__( 'Dropdown Language', 'moore' ),
					'type' 	=> Controls_Manager::HEADING,
				]
			);

			$repeater = new Repeater();

				$repeater->add_control(
					'flag_title_items',
					[
						'label'   => esc_html__( 'Nation', 'moore' ),
						'type'    => Controls_Manager::TEXT,
						'default' => 'Type your title here',
					]
				);


			$this->add_control(
				'language_lists',
				[
					'label' 	=> esc_html__( 'Language', 'moore' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'flag_title_items' => 'ES',
						],
					],
				]
			);

		$this->end_controls_section();
		/* End content */

		/* Begin Current Language Style */
		$this->start_controls_section(
			'current_language_style',
			[
				'label' => esc_html__( 'Current Language', 'moore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs( 'tabs_current_language_style' );
				
				$this->start_controls_tab(
		            'tab_current_language_normal',
		            [
		                'label' => esc_html__( 'Normal', 'moore' ),
		            ]
		        );

		        	$this->add_control(
						'current_language_bg_normal',
						[
							'label' 	=> esc_html__( 'Background', 'moore' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .switch-lang-v1' 				=> 'background-color: {{VALUE}};',
								'{{WRAPPER}} .switch-lang-v2 .current-lang' => 'background-color: {{VALUE}};',
							],
						]
					);

		        	$this->add_control(
						'current_language_color_normal',
						[
							'label' 	=> esc_html__( 'Color', 'moore' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .switch-lang-v1 .current-lang .lang-text' => 'color: {{VALUE}};',
								'{{WRAPPER}} .switch-lang-v2 .current-lang .lang-text' => 'color: {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_current_language_hover',
		            [
		                'label' => esc_html__( 'Hover', 'moore' ),
		            ]
		        );

		        	$this->add_control(
						'current_language_bg_hover',
						[
							'label' 	=> esc_html__( 'Background', 'moore' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .switch-lang-v1:hover' 				=> 'background-color: {{VALUE}};border-color: {{VALUE}};',
								'{{WRAPPER}} .switch-lang-v2:hover .current-lang' 	=> 'background-color: {{VALUE}};border-color: {{VALUE}};',
							],
						]
					);

		        	$this->add_control(
						'current_language_color_hover',
						[
							'label' 	=> esc_html__( 'Color', 'moore' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .switch-lang-v1:hover .current-lang .lang-text' => 'color: {{VALUE}};',
								'{{WRAPPER}} .switch-lang-v2:hover .current-lang .lang-text' => 'color: {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'current_language_typography',
					'selector' 	=> '{{WRAPPER}} .switch-lang-v1 .current-lang .lang-text',
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'current_language_typography_v2',
					'selector' 	=> '{{WRAPPER}} .switch-lang-v2 .current-lang .lang-text',
					'condition' => [
	                    'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'current_language_border_v2',
	                'selector' 	=> '{{WRAPPER}} .switch-lang-v2 .current-lang',
	                'separator' => 'before',
	                'condition' => [
	                    'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_control(
	            'current_language_border_radius_v2',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'moore' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .switch-lang-v2 .current-lang' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                    'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_control(
	            'current_language_border_radius_v2_hover',
	            [
	                'label' 		=> esc_html__( 'Border Radius Hover', 'moore' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .switch-lang-v2:hover .current-lang' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                    'type' 	=> 'v2',
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'content_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'moore' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .switch-lang-v2 .current-lang' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                    'type' 	=> 'v2',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End Current Language Style */

		/* Begin Icon Style */
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon', 'moore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs( 'tabs_icon_style' );
				
				$this->start_controls_tab(
		            'tab_icon_normal',
		            [
		                'label' => esc_html__( 'Normal', 'moore' ),
		            ]
		        );

		        	$this->add_control(
						'icon_color_normal',
						[
							'label' 	=> esc_html__( 'Color', 'moore' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .switch-lang-v1 .current-lang i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .switch-lang-v2 .current-lang i' => 'color: {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_icon_hover',
		            [
		                'label' => esc_html__( 'Hover', 'moore' ),
		            ]
		        );

		        	$this->add_control(
						'icon_color_hover',
						[
							'label' 	=> esc_html__( 'Color', 'moore' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .switch-lang-v1:hover .current-lang i' => 'color: {{VALUE}};',
								'{{WRAPPER}} .switch-lang-v2:hover .current-lang i' => 'color: {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography',
					'selector' 	=> '{{WRAPPER}} .switch-lang-v1 .current-lang i',
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography_v2',
					'selector' 	=> '{{WRAPPER}} .switch-lang-v2 .current-lang i',
					'condition' => [
	                    'type' 	=> 'v2',
	                ],
				]
			);

		$this->end_controls_section();
		/* End icon Style */

		/* Begin Dropdown Language Style */
		$this->start_controls_section(
			'dropdown_language_style',
			[
				'label' => esc_html__( 'Dropdown Language', 'moore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs( 'tabs_dropdown_language_style' );
				
				$this->start_controls_tab(
		            'tab_dropdown_language_normal',
		            [
		                'label' => esc_html__( 'Normal', 'moore' ),
		            ]
		        );

					$this->add_control(
						'dropdown_language_bg_normal',
						[
							'label' 	=> esc_html__( 'Background', 'moore' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .switch-lang-v1 .lang-dropdown .selecting-lang' => 'background-color: {{VALUE}};',
								'{{WRAPPER}} .switch-lang-v2 .lang-dropdown .selecting-lang' => 'background-color: {{VALUE}};',
							],
						]
					);

		        	$this->add_control(
						'dropdown_language_color_normal',
						[
							'label' 	=> esc_html__( 'Color', 'moore' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .switch-lang-v1 .lang-dropdown .selecting-lang .lang-text' => 'color: {{VALUE}};',
								'{{WRAPPER}} .switch-lang-v2 .lang-dropdown .selecting-lang .lang-text' => 'color: {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_dropdown_language_hover',
		            [
		                'label' => esc_html__( 'Hover', 'moore' ),
		            ]
		        );

		        	$this->add_control(
						'dropdown_language_bg_hover',
						[
							'label' 	=> esc_html__( 'Background', 'moore' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .switch-lang-v1 .lang-dropdown .selecting-lang:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
								'{{WRAPPER}} .switch-lang-v2 .lang-dropdown .selecting-lang:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
							],
						]
					);

		        	$this->add_control(
						'dropdown_language_color_hover',
						[
							'label' 	=> esc_html__( 'Color', 'moore' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .switch-lang-v1 .lang-dropdown .selecting-lang:hover .lang-text' => 'color: {{VALUE}};',
								'{{WRAPPER}} .switch-lang-v2 .lang-dropdown .selecting-lang:hover .lang-text' => 'color: {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'dropdown_language_typography',
					'selector' 	=> '{{WRAPPER}} .switch-lang-v1 .lang-dropdown .selecting-lang .lang-text',
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'dropdown_language_typography_v2',
					'selector' 	=> '{{WRAPPER}} .switch-lang-v2 .lang-dropdown .selecting-lang .lang-text',
					'condition' => [
	                    'type' => 'v2',
	                ],
				]
			);

			$this->add_responsive_control(
	            'dropdown_language_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'moore' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .switch-lang-v2 .lang-dropdown .selecting-lang' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                    'type' 	=> 'v2',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End Dropdown Language Style */
		
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();
        
		$type 		= $settings['type'];
		$languages 	= $settings['language_lists'];
		 ?>
        
		    <div class="switch-lang-<?php echo esc_html( $type ); ?>">
				<div class="current-lang">
					<p class="lang-text"><?php echo esc_html( $settings['flag_title'] );?></p>
					<?php if ( $type == 'v1' ): ?>
						<i class="fas fa-angle-down"></i>
					<?php else: ?>
						<i class="ovaicon-download"></i>
					<?php endif; ?>
				</div>
				<div class="lang-dropdown">
					<?php foreach ( $languages as $items ) : ?>
						<div class="selecting-lang">
							<p class="lang-text"><?php echo esc_html( $items['flag_title_items'] );?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		 	
		<?php
	}

	
}
$widgets_manager->register( new Moore_Elementor_Choice_Language() );