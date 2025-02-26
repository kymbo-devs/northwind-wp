<?php

class Moore_Elementor {
	
	function __construct() {
            
		// Register Header Footer Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'moore_add_category' ) );

	    add_action( 'elementor/frontend/after_register_scripts', array( $this, 'moore_enqueue_scripts' ) );
		
		add_action( 'elementor/widgets/register', array( $this, 'moore_include_widgets' ) );
		
		add_filter( 'elementor/controls/animations/additional_animations', array( $this, 'moore_add_animations'), 10 , 0 );

        add_action( 'elementor/element/tabs/section_tabs_style/before_section_start', array( $this, 'moore_tabs_custom' ), 10, 2 );

		add_action( 'elementor/element/accordion/section_title_style/before_section_start', array( $this, 'moore_accordion_custom' ), 10, 2 );

		add_action( 'elementor/element/counter/section_number/before_section_start', array( $this, 'moore_counter_custom' ), 10, 2 );

		add_action( 'elementor/element/text-editor/section_style/before_section_start', array( $this, 'moore_text_editor_custom' ), 10, 2 );

		add_action( 'elementor/widget/render_content', array( $this, 'moore_render_content' ), 10, 2 );

		add_action( 'elementor/element/social-icons/section_social_hover/after_section_end', array( $this, 'moore_social_icons_custom' ), 10, 2 );
		
		// Remove animations style from Elementor
		add_action( 'wp_enqueue_scripts', array( $this, 'moore_remove_animations_styles' ) );
	}

	
	function moore_add_category(  ) {

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'hf',
	        [
	            'title' => __( 'Header Footer', 'moore' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'moore',
	        [
	            'title' => __( 'Moore', 'moore' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	}

	function moore_enqueue_scripts(){
        
        $files = glob(get_theme_file_path('/assets/js/elementor/*.js'));
        
        foreach ($files as $file) {
            $file_name = wp_basename($file);
            $handle    = str_replace(".js", '', $file_name);
            $src       = get_theme_file_uri('/assets/js/elementor/' . $file_name);
            if (file_exists($file)) {
                wp_register_script( 'moore-elementor-' . $handle, $src, ['jquery'], false, true );
            }
        }


	}

	function moore_include_widgets( $widgets_manager ) {
        $files = glob(get_theme_file_path('elementor/widgets/*.php'));
        foreach ($files as $file) {
            $file = get_theme_file_path('elementor/widgets/' . wp_basename($file));
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }

    function moore_add_animations(){
    	$animations = array(
            'Moore' => array(
                'ova-move-up' 		=> esc_html__('Move Up', 'moore'),
                'ova-move-down' 	=> esc_html__( 'Move Down', 'moore' ),
                'ova-move-left'     => esc_html__('Move Left', 'moore'),
                'ova-move-right'    => esc_html__('Move Right', 'moore'),
                'ova-scale-up'      => esc_html__('Scale Up', 'moore'),
                'ova-flip'          => esc_html__('Flip', 'moore'),
                'ova-helix'         => esc_html__('Helix', 'moore'),
                'ova-popup'			=> esc_html__( 'PopUp','moore' )
            ),
        );

        return $animations;
    }
    // Ova tabs custom 
    function moore_tabs_custom( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_tabs',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Tabs', 'moore' ),
			]
		);
		    // Position tabs & tab title
			$element->add_control(
				'z_index',
				[
					'label' => __( 'Z index', 'moore' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 0,
					'max' => 999,
					'step' => 1,
					'default' => 3,
					'selectors' => [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper' => 'z-index: {{VALUE}}',
	                ],
				]
			);

			$element->add_control(
				'position_section',
				[
					'label' => __( 'Position', 'moore' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'default',
				]
			);

			$element->add_responsive_control(
	            'ova_tabs_positon',
	            [
	                'label' 	=> esc_html__( 'Tabs Position', 'moore' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
						'unset' => [
	                        'title' => esc_html__( 'Default', 'moore' ),
	                        'icon' 	=> ' eicon-navigation-horizontal',
	                    ],
	                    'relative' => [
	                        'title' => esc_html__( 'Relative', 'moore' ),
	                        'icon' 	=> 'eicon-bullet-list',
	                    ],	
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-tabs' => 'position: {{VALUE}}',
	                ],
	            ]
	        );

			$element->add_responsive_control(
	            'ova_tabs_title_positon',
	            [
	                'label' 	=> esc_html__( 'Title Position', 'moore' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
						'unset' => [
	                        'title' => esc_html__( 'Default', 'moore' ),
	                        'icon' 	=> ' eicon-navigation-horizontal',
	                    ],
	                    'absolute' => [
	                        'title' => esc_html__( 'Absolute', 'moore' ),
	                        'icon' 	=> 'eicon-bullet-list',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper' => 'position: {{VALUE}}',
	                ],
	            ]
	        );

			$element->add_responsive_control(
				'ova_tabs_bottom',
				[
					'label' 	=> esc_html__( 'Bottom', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'range' => [
						'px' => [
							'min' => -50,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$element->add_responsive_control(
				'ova_tabs_left',
				[
					'label' 	=> esc_html__( 'Left', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'range' => [
						'px' => [
							'min' => -50,
							'max' => 500,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper' => 'left: {{SIZE}}{{UNIT}};',
					],
				]
			);

             // Title tabs 
			$element->add_control(
				'title_section',
				[
					'label' => __( 'Title', 'moore' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'default',
				]
			);

            $element->add_control(
				'ova_tabs_underline',
				[
					'label' 	=> esc_html__( 'Underline Color', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tab-title' => 'text-decoration-color: {{VALUE}};',
					],
				]
			);

			$element->add_control(
				'ova_tabs_underline_active',
				[
					'label' 	=> esc_html__( 'Underline Color Active', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tab-title.elementor-active' => 'text-decoration-color: {{VALUE}};',
					],
				]
			);

			$element->add_responsive_control(
				'ova_tabs_underline_offset',
				[
					'label' 	=> esc_html__( 'Underline Offset', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' => -25,
							'max' => 25,
							'step' => 1,
						],
					],
					'default' => [
						'size' => 5,
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tab-title.elementor-active' => 'text-underline-offset: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .elementor-tabs .elementor-tab-title' => 'text-underline-offset: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$element->add_control(
				'ova_tabs_title_bg',
				[
					'label' 	=> esc_html__( 'Background Color', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tab-title' => 'background-color: {{VALUE}};',
					],
				]
			);

			//  tabs title border radius
			$element->add_responsive_control(
		        'active_title_border_radius',
		        [
		            'label' 		=> esc_html__( 'Active Border Radius', 'moore' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}} .elementor-tabs .elementor-tab-title.elementor-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		        ]
		    );
			
			$element->add_responsive_control(
		        'title_border_radius',
		        [
		            'label' 		=> esc_html__( 'Border Radius', 'moore' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}} .elementor-tabs .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		        ]
		    );
            //  end tabs title border radius
            $element->add_responsive_control(
		        'active_title_padding',
		        [
		            'label' 		=> esc_html__( 'Active Padding', 'moore' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}} .elementor-tabs .elementor-tab-title.elementor-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		         ]
		    );

			$element->add_responsive_control(
		        'title_padding',
		        [
		            'label' 		=> esc_html__( 'Padding', 'moore' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}} .elementor-tabs .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		         ]
		    );

			$element->add_responsive_control(
		        'title_margin',
		        [
		            'label' 		=> esc_html__( 'Margin', 'moore' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}} .elementor-tabs .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		         ]
		    );

             // Content tabs style
            $element->add_control(
				'content_section',
				[
					'label' => __( 'Content', 'moore' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'default',
				]
			);
			$element->add_responsive_control(
		        'content_padding',
		        [
		            'label' 		=> esc_html__( 'Padding', 'moore' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}} .elementor-tabs .elementor-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		         ]
		    );

	        $element->add_responsive_control(
	            'content_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'moore' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$element->end_controls_section();
	}
    // Ova accordion custom 
	function moore_accordion_custom( $element, $args ) {
    	/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_accordion',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Accordion', 'moore' ),
			]
		);

			$element->add_responsive_control(
	            'ova_accordion_display',
	            [
	                'label' 	=> esc_html__( 'Display', 'moore' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'list-item' => [
	                        'title' => esc_html__( 'List-item', 'moore' ),
	                        'icon' 	=> 'eicon-editor-list-ul',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'display: {{VALUE}}',
	                ],
	            ]
	        );

			// Accordion item options
	        $element->add_control(
				'accordion_item_options',
				[
					'label' 	=> esc_html__( 'Item Options', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ova_accordion_display!' => '',
					],
				]
			);

				$element->add_group_control(
		            \Elementor\Group_Control_Border::get_type(), [
		                'name' 		=> 'accordion_item_border',
		                'selector' 	=> '{{WRAPPER}} .elementor-accordion .elementor-accordion-item',
		                'separator' => 'before',
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_control(
					'marker_options',
					[
						'label' 	=> esc_html__( 'Marker Options', 'moore' ),
						'type' 		=> \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
						'condition' => [
							'ova_accordion_display!' => '',
						],
					]
				);

				$element->add_control(
		            'marker_color',
		            [
		                'label' 	=> esc_html__( 'Color', 'moore' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title::marker' => 'color: {{VALUE}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

				$element->add_responsive_control(
					'item_width',
					[
						'label' 	=> esc_html__( 'Width', 'moore' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
						'default' 	=> [
							'unit' 	=> 'px',
						],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'size_units' 	=> [ '%', 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title::marker' => 'font-size: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'ova_accordion_display!' => '',
						],
					]
				);

			// Title options
			$element->add_control(
				'title_options',
				[
					'label' 	=> esc_html__( 'Title Options', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ova_accordion_display!' => '',
					],
				]
			);

				$element->add_responsive_control(
		            'title_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'moore' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

			// Icon options
		    $element->add_control(
				'icon_options',
				[
					'label' 	=> esc_html__( 'Icon Options', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ova_accordion_display!' => '',
					],
				]
			);

		    	$element->add_responsive_control(
		            'icon_display',
		            [
		                'label' 	=> esc_html__( 'Display', 'moore' ),
		                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
		                'options' 	=> [
		                    'flex' => [
		                        'title' => esc_html__( 'Center', 'moore' ),
		                        'icon' 	=> 'eicon-h-align-center',
		                    ],
		                ],
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'display: {{VALUE}};align-items: center;justify-content: center;position: relative;',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' 		=> 'icon_typography',
						'selector' 	=> '{{WRAPPER}} .elementor-accordion .elementor-tab-title i',
						'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
					]
				);

				$element->add_responsive_control(
					'icon_top',
					[
						'label' 	=> esc_html__( 'Top', 'moore' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
						'default' 	=> [
							'unit' 	=> 'px',
						],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
						'range' => [
							'px' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'size_units' 	=> [ 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'top: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
					]
				);

				$element->add_responsive_control(
					'icon_left',
					[
						'label' 	=> esc_html__( 'Left', 'moore' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
						'default' 	=> [
							'unit' 	=> 'px',
						],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
						'range' => [
							'px' => [
								'min' => -300,
								'max' => 300,
							],
						],
						'size_units' 	=> [ 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'left: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
					]
				);

		    	$element->add_responsive_control(
					'icon_width',
					[
						'label' 	=> esc_html__( 'Width', 'moore' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
						'default' 	=> [
							'unit' 	=> 'px',
						],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'size_units' 	=> [ 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
					]
				);

		        $element->add_control(
		            'icon_background',
		            [
		                'label' 	=> esc_html__( 'Background', 'moore' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'background-color: {{VALUE}};',
		                ],
		                'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_control(
		            'icon_active_background',
		            [
		                'label' 	=> esc_html__( 'Active Background ', 'moore' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active i' => 'background-color: {{VALUE}};',
		                ],
		                'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_responsive_control(
		            'icon_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'moore' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
		            ]
		        );


		    // Content options
	        $element->add_control(
				'content_options',
				[
					'label' 	=> esc_html__( 'Content Options', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ova_accordion_display!' => '',
					],
				]
			);

				$element->add_group_control(
		            \Elementor\Group_Control_Border::get_type(), [
		                'name' 		=> 'accordion_content_border',
		                'selector' 	=> '{{WRAPPER}} .elementor-accordion .elementor-tab-content',
		                'separator' => 'before',
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_responsive_control(
		            'content_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'moore' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_responsive_control(
		            'item_content_margin',
		            [
		                'label' 		=> esc_html__( 'Item Margin', 'moore' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		$element->end_controls_section();
    }

	// Ova counter custom 
    function moore_counter_custom( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_tabs',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Tabs', 'moore' ),
			]
		);

			$element->add_responsive_control(
				'number_family',
				[
					'label' 	=> esc_html__( 'Number Font', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::CHOOSE,
					'options' 	=> [
						'var(--secondary-font)' => [
							'title' => esc_html__( 'Secondary Font', 'moore' ),
							'icon'  => esc_html__( 'eicon-font', 'moore' ),
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper .elementor-counter-number' => 'font-family: {{VALUE}};',
						'{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper .elementor-counter-number-prefix' => 'font-family: {{VALUE}};',
					],
				]
			);

			$element->add_responsive_control(
		        'title_padding',
		        [
		            'label' 		=> esc_html__( 'Title Padding', 'moore' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}} .elementor-counter .elementor-counter-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		         ]
		    );

		$element->end_controls_section();
	}

	// Ova text-editor custom 
    function moore_text_editor_custom( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_tabs',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Tabs', 'moore' ),
			]
		);

			$element->add_control(
				'title_section',
				[
					'label' => __( 'Text Editor', 'moore' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'default',
				]
			);

			$element->add_control(
				'link_color',
				[
					'label' 	=> esc_html__( 'Link Color', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} p a' => 'color: {{VALUE}};',
					],
				]
			);

			$element->add_control(
				'link_hover_color',
				[
					'label' 	=> esc_html__( 'Link Color Hover', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} p a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$element->add_control(
				'link_active_color',
				[
					'label' 	=> esc_html__( 'Link Color Active', 'moore' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} p a:active' => 'color: {{VALUE}};',
					],
				]
			);

			$element->add_responsive_control(
				'text_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'moore' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em' ],
					'selectors' 	=> [
					'{{WRAPPER}}  p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$element->add_responsive_control(
		        'text_padding',
		        [
		            'label' 		=> esc_html__( 'Padding', 'moore' ),
		            'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		            'size_units' 	=> [ 'px', '%', 'em' ],
		            'selectors' 	=> [
		             '{{WRAPPER}}  p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            ],
		         ]
		    );

		$element->end_controls_section();
	}
    
    // Ova social icons custom 
	function moore_social_icons_custom ( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_social_icons',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Social Icon', 'moore' ),
			]
		);

			$element->add_responsive_control(
	            'ova_social_icons_display',
	            [
	                'label' 	=> esc_html__( 'Display', 'moore' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'inline-block' => [
	                        'title' => esc_html__( 'Block', 'moore' ),
	                        'icon' 	=> 'eicon-h-align-left',
	                    ],
	                    'inline-flex' => [
	                        'title' => esc_html__( 'Flex', 'moore' ),
	                        'icon' 	=> 'eicon-h-align-center',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-icon.elementor-social-icon' => 'display: {{VALUE}}',
	                ],
	            ]
	        );

		$element->end_controls_section();
	}

	// Render Content
	function moore_render_content( $content, $widget ) {

		// If header left element
	   if ( 'moore_elementor_header_left' === $widget->get_name() ) {
	   	$header_left_width = apply_filters( 'moore_header_left_width', '120px' );
	   	$content .= "<style>@media(min-width: 768px){ html{ padding-left: ".$header_left_width."; } } </style>";
	   }
	   return $content;
	}

	// Remove animations style from Elementor
	public function moore_remove_animations_styles() {
		// Deregister the stylesheet by handle
	    foreach ( $this->moore_add_animations() as $animations ) {
	    	if ( !empty( $animations ) && is_array( $animations ) ) {
	    		foreach ( array_keys( $animations ) as $animation ) {
	    			wp_deregister_style( 'e-animation-'.$animation );
	    			wp_enqueue_style( 'e-animation-'.$animation, MOORE_URI.'/assets/scss/none.css', array(), null);
	    		}
	    	}
	    }
	}
}

return new Moore_Elementor();





