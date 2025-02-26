<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Moore_Elementor_Instagram extends Widget_Base {

	public function get_name() {
		return 'moore_elementor_instagram';
	}

	public function get_title() {
			return esc_html__( 'Instagram', 'moore' );
	}

	public function get_icon() {
		return ' eicon-instagram-post';
	}

	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_script_depends() {
		wp_enqueue_style( 'carousel', get_template_directory_uri().'/assets/libs/owl.carousel.min.css' );
		wp_enqueue_script( 'carousel', get_template_directory_uri().'/assets/libs/owl.carousel.min.js', array('jquery'), false, true );
		return [ 'moore-elementor-instagram' ];
	}

	protected function register_controls() {


		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'moore' ),
			]
		);

		$this->add_control(
			'token',
			[
				'label' => esc_html__( 'Token', 'moore' ),
				'type' => Controls_Manager::TEXT,
				'description' => 'How to Get Instagram Access Token <a href="https://www.instagram.com/developer/authentication/" target="_blank" rel="nofollow">Click Here</a>'
			]
		);

		$this->add_control(
			'hashtag',
			[
				'label' => esc_html__( 'Hashtag', 'moore' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		

		

		$this->add_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'moore' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 30,
				'default' => 500,
			]
		);

		$this->add_control(
			'number_photo',
			[
				'label' => esc_html__( 'Number Photos', 'moore' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'default' => 15,
			]
		);

		$this->add_control(
			'overlay',
			[
				'label' => esc_html__( 'Overlay Color', 'moore' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-instagram .item .overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		

		$this->add_control(
			'show_follow',
			[
				'label' => esc_html__( 'Show Follow', 'moore' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'follow_style',
			[
				'label' => esc_html__( 'Follow', 'moore' ),
				'tab' => \Elementor\Controls_Manager::HEADING,
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'follow_version',
			[
				'label' => esc_html__( 'Follow', 'moore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Version 1', 'moore' ),
					'version_2' => esc_html__( 'Version 2', 'moore' ),
				],
			]
		);

		$this->add_control(
			'icon_follow_style',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Icon', 'moore' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'text_icon',
			[
				'label' => esc_html__( 'Social Icons', 'moore' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'default' => 'fa fa-instagram',
			]
		);

		$this->add_control(
			'icon_follow_size',
			[
				'label' => esc_html__( 'Icon Size', 'moore' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .follow .icon_follow' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_follow_color',
			[
				'label'  => esc_html__( 'Icon Color', 'moore' ),
				'type'   => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .follow .icon_follow' => 'color: {{VALUE}}',
				],
				'default' => '#b9a271',
			]
		);

		$this->add_responsive_control(
			'icon_follow_margin',
			[
				'label' => esc_html__( 'Margin', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .follow i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => esc_html__( 'Title', 'moore' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Text', 'moore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Follow', 'moore' ),
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'moore' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .follow .title' => 'color: {{VALUE}}',
				],
				'default' => '#020202',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .follow .title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .follow .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'description_style',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Description', 'moore' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Text', 'moore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'on instagrams', 'moore' ),
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'moore' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .follow .description' => 'color: {{VALUE}}',
				],
				'default' => '#bfbfbf',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .follow .description',
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' => esc_html__( 'Margin', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .follow .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'content_follow_padding',
			[
				'label' => esc_html__( 'Padding', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .follow a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'show_follow',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slide',
			[
				'label' => esc_html__( 'Slide', 'moore' ),
				'tab' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'show_nav',
			[
				'label' => esc_html__( 'Show Nav', 'moore' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'moore' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => esc_html__( 'Pause on Hover', 'moore' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'moore' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
			]
		);

		$this->add_control(
			'item_margin',
			[
				'label' => esc_html__( 'Margin', 'moore' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__( 'Autoplay Speed (ms)', 'moore' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop', 'moore' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'lazy_load',
			[
				'label' => esc_html__( 'Lazy Load', 'moore' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$html = '';


		// Slide
		
		$instagram_slide = [
			'autoplayTimeout'    => absint( $settings['autoplay_speed'] ),
			'margin'             => absint( $settings['item_margin'] ),
			'autoplay'           => ( 'yes' === $settings['autoplay'] ),
			'loop'               => ( 'yes' === $settings['loop'] ),
			'autoplayHoverPause' => ( 'yes' === $settings['pause_on_hover'] ),
			'lazyLoad'           => ( 'yes' === $settings['lazy_load'] ),
			'nav'                => ( 'yes' === $settings['show_nav'] ),
			'navText'            => [
				'<i class="fa fa-angle-left" aria-hidden="true"></i>',
				'<i class="fa fa-angle-right" aria-hidden="true"></i>'
			],
			'dots' => false,
			'smartSpeed' => 1000,
			'responsive' => [
				'0' => [
					'items' => absint(1),
				],
				'700' => [
					'items' => absint(2),
				],
				'900' => [
					'items' => absint(3),
				],
				'1300' => [
					'items' => absint(4),
				],
				'1600' => [
					'items' => absint( $settings['items'] ),
				]
			]
		];
		
		$this->add_render_attribute( 'slide', [
			'data-instagram_slide' => wp_json_encode( $instagram_slide),
		] );

		// Get Token Instagram
		$access_token = $settings['token'];

		$hashtag = $settings['hashtag'];
		
		$i =0;
		?>
		<?php if ($access_token != '') {

			// Get Data Instagram
			$number_photo  = absint( $settings['number_photo'] );

			
			$json_link    = "https://graph.instagram.com/me/media?fields=username,caption,media_url&access_token={$access_token}";
			
			$args = array(
				'timeout' => 60,
				'sslverify' => false
			);

			$result = wp_remote_get( $json_link, $args );

			

			if( is_array( $result ) && ! is_wp_error( $result ) ) {

				$obj = json_decode( str_replace( '%22', '&rdquo;', $result['body'] ), true );

				$user_name    = isset( $obj['data']['0']['username'] ) ? $obj['data']['0']['username'] : '' ;

			?>

				<div class="ova-instagram">

					<?php if( $settings['show_follow'] == 'yes') { ?>
						<div class="follow <?php echo esc_attr($settings['follow_version']) ?>">
							<a href="//instagram.com/<?php echo esc_attr($user_name) ?>">

								<i class="<?php echo esc_attr($settings['text_icon']) ?> icon_follow text-center"></i>

								<div class="title second_font text-center">
									<?php echo esc_html($settings['title']) ?>
								</div>

								<div class="description text-center">
									<?php echo esc_html($settings['description']) ?>
								</div>
							</a>
						</div>
					<?php } ?> 

					<div class="slide owl-carousel owl-theme" <?php echo ''.$this->get_render_attribute_string( 'slide' ) ?> >
						<?php 
						if( isset($obj['data']) && $obj['data'] ){
							foreach ($obj['data'] as $post){ 

								if( $i == $number_photo ) break;

								$pic_text          = isset( $post['caption'] ) ? $post['caption'] : '';
								$pic_link          = $post['media_url'];
								$pic_src           = $post['media_url'];

								

								if ( $hashtag != '') {
									
								?>
								
									<?php if( strpos($pic_text, $hashtag) !== false ){ ?>
									<div class="item" >
										<div class="image <?php if( ($i !=0) && ($i % 4) == 1) echo "image-bottom" ;elseif(($i !=0) && ($i % 4) == 3) echo "image-top";?>" style="background-image: url('<?php echo esc_attr($pic_src) ?>'); height: <?php echo esc_attr( $settings['height'] ).'px' ?>"></div>
										<div class="overlay" >
											<a href="<?php echo esc_attr($pic_link) ?>" target="_blank">
												<i class="linkToIns <?php if( ($i !=0) && ($i % 4) == 1) echo "bottom" ;elseif(($i !=0) && ($i % 4) == 3) echo "top";?>">
													<?php esc_html_e( 'Instagram', 'moore' ); ?>
												</i>
											</a>
										</div>
									</div>

									<?php $i++; } ?>
								
								<?php }else{ ?>

									<div class="item" >
										<div class="image <?php if( ($i !=0) && ($i % 4) == 1) echo "image-bottom" ;elseif(($i !=0) && ($i % 4) == 3) echo "image-top";?>" style="background-image: url('<?php echo esc_attr($pic_src) ?>'); height: <?php echo esc_attr( $settings['height'] ).'px' ?>"></div>
										<div class="overlay" >
											<a href="<?php echo esc_attr($pic_link) ?>" target="_blank">
											    <i class="linkToIns <?php if( ($i !=0) && ($i % 4) == 1) echo "bottom" ;elseif(($i !=0) && ($i % 4) == 3) echo "top";?>">
											    	<?php esc_html_e( 'Instagram', 'moore' ); ?>
											    </i>
											</a>
										</div>
									</div>

								<?php $i++; }
							}
						} ?>
					</div>
				</div>
		<?php } } ?>
		<?php
		
	}
}

$widgets_manager->register( new Moore_Elementor_Instagram() );


