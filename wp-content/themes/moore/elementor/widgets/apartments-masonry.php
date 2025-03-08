<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Moore_Elementor_Apartments_Masonry extends Widget_Base {

	
	public function get_name() {
		return 'moore_elementor_apartments_masonry';
	}

	public function get_title() {
		return esc_html__( 'Apartments Masonry', 'moore' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_script_depends() {
		wp_enqueue_script('masonry', get_template_directory_uri().'/assets/libs/masonry.min.js', array('jquery'), false, true );
		return [ 'moore-elementor-apartments-masonry' ];
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
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'title',
				[
					'label'   => esc_html__( 'Title', 'moore' ),
					'type'    => Controls_Manager::TEXT,
					'default' =>  esc_html__( 'Apartment ', 'moore' ),
				]
			);

			$repeater->add_control(
				'sub_title',
				[
					'label'   => esc_html__( 'Sub Title', 'moore' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'From 96.42M', 'moore' ),
				]
			);
            
			$repeater->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'moore' ),
					'type' => Controls_Manager::URL,
					'dynamic' => [
						'active' => true,
					],
					'default' => [
						'url' => '#',
					],
					'placeholder' => esc_html__( 'https://your-link.com', 'moore' ),
					'show_label' => true,
				]
			);

			$repeater->add_control(
				'image',
				[
					'label'   => esc_html__( 'Choose Image', 'moore' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			
			$repeater->add_responsive_control(
				'image_width',
				[
					'label' 		=> esc_html__( 'Width', 'moore' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 500,
							'step' 	=> 10,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-masonry .grid {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$repeater->add_responsive_control(
				'image_padding',
				[
					'label'      => esc_html__( 'Padding', 'moore' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-apartments-masonry .grid {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Items Apartments', 'moore' ),
					'type'		=> Controls_Manager::REPEATER,
					'fields'  	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'title' 		=> esc_html__('Apartment ', 'moore'),
							'sub_title' 	=> esc_html__('From 96.42M', 'moore'),
							'link'          => esc_html__( '#', 'moore' ),
						],
						[
							'title' 		=> esc_html__('Apartment ', 'moore'),
							'sub_title' 	=> esc_html__('From 96.42M', 'moore'),
							'link'          => esc_html__( '#', 'moore' ),
						],
						[
							'title' 		=> esc_html__('Apartment ', 'moore'),
							'sub_title' 	=> esc_html__('From 96.42M', 'moore'),
							'link'          => esc_html__( '#', 'moore' ),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

			$this->add_responsive_control(
				'grid_sizer',
				[
					'label' 		=> esc_html__( 'Grid Sizer', 'moore' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 500,
							'step' 	=> 10,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-masonry .grid .grid-sizer' => 'width: {{SIZE}}{{UNIT}}',
					],
					'description' => 'Default grid sizer is 33% (3 columns)'
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__( 'Image', 'moore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'image_margin',
				[
					'label'      => esc_html__( 'Margin', 'moore' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-apartments-masonry .grid .grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'moore' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'content_bg_hover',
				[
					'label'     => esc_html__( 'Background Hover', 'moore' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-masonry .grid .grid-item .apartments .apartments-container:before' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_opacity',
				[
					'label' => esc_html__( 'Opacity', 'moore' ),
					'type' 	=> Controls_Manager::SLIDER,
					
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1,
							'step' 	=> 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-masonry .grid .grid-item:hover .apartments .apartments-container:before' => 'opacity: {{SIZE}}',
					],
				]
			);

			$this->add_responsive_control(
	            'content_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'moore' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'left' 	=> [
	                        'title' => esc_html__( 'Left', 'moore' ),
	                        'icon' 	=> 'eicon-text-align-left',
	                    ],
	                    'center' 	=> [
	                        'title' => esc_html__( 'Center', 'moore' ),
	                        'icon' 	=> 'eicon-text-align-center',
	                    ],
	                    'right' 	=> [
	                        'title' => esc_html__( 'Right', 'moore' ),
	                        'icon' 	=> 'eicon-text-align-right',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .ova-apartments-masonry .grid .grid-item .apartments .apartments-container .content .title' => 'text-align: {{VALUE}}',
	                    '{{WRAPPER}} .ova-apartments-masonry .grid .grid-item .apartments .apartments-container .content .sub-title' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

			$this->add_responsive_control(
				'content_bottom',
				[
					'label' 		=> esc_html__( 'Bottom', 'moore' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'default' => [
						'unit' => 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 500,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-masonry .grid .grid-item:hover .apartments .apartments-container .content' => 'bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'moore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'title_typography',
					'selector' => '{{WRAPPER}} .ova-apartments-masonry .grid .grid-item .apartments .apartments-container .content .title',
				]
			);

			$this->add_control(
				'title_color',
				[
					'label'     => esc_html__( 'Color', 'moore' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-masonry .grid .grid-item .apartments .apartments-container .content .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label'      => esc_html__( 'Margin', 'moore' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-apartments-masonry .grid .grid-item .apartments .apartments-container .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'moore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'sub_title_typography',
					'selector' => '{{WRAPPER}} .ova-apartments-masonry .grid .grid-item .apartments .apartments-container .content .sub-title',
				]
			);

			$this->add_control(
				'sub_title_color',
				[
					'label'     => esc_html__( 'Color', 'moore' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-apartments-masonry .grid .grid-item .apartments .apartments-container .content .sub-title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'sub_title_margin',
				[
					'label'      => esc_html__( 'Margin', 'moore' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .ova-apartments-masonry .grid .grid-item .apartments .apartments-container .content .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		
		
	}

	// Render Template Here
	protected function render() {
    // Get the current apartment post ID.
    $current_post_id = get_the_ID();
    
    // Retrieve categories for the current post.
    $categories = get_the_category( $current_post_id );
    if ( empty( $categories ) ) {
        return; // No category assigned – nothing to query.
    }
    
    // Collect category IDs.
    $category_ids = array();
    foreach ( $categories as $cat ) {
        $category_ids[] = $cat->term_id;
    }
    
    // Query for 3 random apartments in the same categories (excluding the current post).
    $args = array(
        'post_type'      => 'ova_apartments',
        'posts_per_page' => 3,
        'orderby'        => 'rand',
        'post__not_in'   => array( $current_post_id ),
        'tax_query'      => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $category_ids,
            ),
        ),
    );
    $apartments_query = new WP_Query( $args );
    
    if ( $apartments_query->have_posts() ) {
        ?>
        <div class="ova-apartments-masonry">
            <div class="grid">
                <div class="grid-sizer"></div>
                <?php
                while ( $apartments_query->have_posts() ) {
                    $apartments_query->the_post();
                    $post_id   = get_the_ID();
                    $title     = get_the_title();
                    $permalink = get_permalink();
                    
                    // Retrieve meta fields for the subtitle.
                    $precio   = get_post_meta( $post_id, 'ova_apartment_precio', true );
                    $tamano   = get_post_meta( $post_id, 'ova_apartment_tamano', true );
                    $location = get_post_meta( $post_id, 'ova_apartment_location', true );
                    
                    // Build the subtitle string "PRECIO | TAMANO | LOCATION".
                    $subtitle_parts = array_filter( array( $precio, $tamano, $location ) );
                    $subtitle = implode( ' | ', $subtitle_parts );
                    
                    // Get the first image:
                    // First try to get the gallery IDs from custom meta, similar to your slider widget.
                    $first_image_url = '';
                    $gallery_ids = get_post_meta( $post_id, 'apartment_gallery_ids', true );
                    if ( ! empty( $gallery_ids ) ) {
                        $ids = explode( ',', $gallery_ids );
                        $first_image_id = reset( $ids );
                        $first_image_url = wp_get_attachment_url( $first_image_id );
                    }
                    // Fallback: try to use the featured image.
                    if ( empty( $first_image_url ) ) {
                        $first_image_url = get_the_post_thumbnail_url( $post_id, 'full' );
                    }
                    ?>
                    <a href="<?php echo esc_url( $permalink ); ?>">
                        <div class="grid-item">
                            <div class="apartments">
                                <?php if ( $first_image_url ) : ?>
                                    <img src="<?php echo esc_url( $first_image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>">
                                <?php endif; ?>
                                <div class="apartments-container">
                                    <div class="content">
                                        <h2 class="title"><?php echo esc_html( $title ); ?></h2>
                                        <p class="sub-title"><?php echo esc_html( $subtitle ); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }
}
	
}
$widgets_manager->register( new Moore_Elementor_Apartments_Masonry() );