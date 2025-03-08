<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Header Banner widget.
 *
 * @since 1.0.0
 */
class Moore_Elementor_Header_Banner extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'moore_elementor_header_banner';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Header Banner', 'moore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-archive-title';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'hf' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'moore' ),
			]
		);

		$this->add_control(
			'header_boxed_content',
			[
				'label'   => esc_html__( 'Display Boxed Content', 'moore' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$this->add_control(
			'header_bg_source',
			[
				'label'   => esc_html__( 'Display Background by Feature Image in Post/Page', 'moore' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		// Set the overlay color to black with 20% opacity.
		$this->add_control(
			'cover_color',
			[
				'label'       => esc_html__( 'Background Cover Color', 'moore' ),
				'type'        => Controls_Manager::COLOR,
				'default'     => 'rgba(0,0,0,0.2)', // changed from 0.51 to 0.2 opacity
				'description' => esc_html__( 'Overlay color applied over the background image', 'moore' ),
				'selectors'   => [
					'{{WRAPPER}} .cover_color' => 'background-color: {{VALUE}};',
				],
				'separator'   => 'after'
			]
		);

		// Title controls.
		$this->add_control(
			'show_title',
			[
				'label'    => esc_html__( 'Show Title', 'moore' ),
				'type'     => Controls_Manager::SWITCHER,
				'default'  => 'yes',
				'selector' => '{{WRAPPER}} .header_banner_el .header_title',
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'moore' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#343434',
				'selectors' => [
					'{{WRAPPER}} .header_banner_el .header_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Title Padding', 'moore' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .header_banner_el .header_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Choose Title Format', 'moore' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'  => esc_html__( 'H1', 'moore' ),
					'h2'  => esc_html__( 'H2', 'moore' ),
					'h3'  => esc_html__( 'H3', 'moore' ),
					'h4'  => esc_html__( 'H4', 'moore' ),
					'h5'  => esc_html__( 'H5', 'moore' ),
					'h6'  => esc_html__( 'H6', 'moore' ),
					'div' => esc_html__( 'DIV', 'moore' ),
				],
				'default' => 'h1'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'header_title',
				'label'    => esc_html__( 'Title Typo', 'moore' ),
				'selector' => '{{WRAPPER}} .header_banner_el .header_title',
			]
		);

		// Breadcrumbs controls.
		$this->add_control(
			'show_breadcrumbs',
			[
				'label'    => esc_html__( 'Show Breadcrumbs', 'moore' ),
				'type'     => Controls_Manager::SWITCHER,
				'default'  => 'yes',
				'selector' => '{{WRAPPER}} .header_breadcrumbs',
				'separator'=> 'before'
			]
		);
		
		$this->add_control(
			'breadcrumbs_color',
			[
				'label'     => esc_html__( 'Breadcrumbs Color', 'moore' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#343434',
				'selectors' => [
					'{{WRAPPER}} .header_banner_el ul.breadcrumb li'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .header_banner_el ul.breadcrumb li a'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .header_banner_el ul.breadcrumb a'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .header_banner_el ul.breadcrumb li .separator i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'breadcrumbs_color_hover',
			[
				'label'     => esc_html__( 'Breadcrumbs Color hover', 'moore' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#343434',
				'selectors' => [
					'{{WRAPPER}} .header_banner_el ul.breadcrumb li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'header_breadcrumbs_typo',
				'label'    => esc_html__( 'Breadcrumbs Typography', 'moore' ),
				'selector' => '{{WRAPPER}} .header_banner_el ul.breadcrumb li',
			]
		);

		$this->add_responsive_control(
			'breadcrumbs_padding',
			[
				'label'      => esc_html__( 'Breadcrumbs Padding', 'moore' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .header_banner_el .header_breadcrumbs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Alignment control.
		$this->add_responsive_control(
			'align',
			[
				'label'     => esc_html__( 'Alignment', 'moore' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [ 'title' => esc_html__( 'Left', 'moore' ), 'icon' => 'eicon-text-align-left' ],
					'center' => [ 'title' => esc_html__( 'Center', 'moore' ), 'icon' => 'eicon-text-align-center' ],
					'right'  => [ 'title' => esc_html__( 'Right', 'moore' ), 'icon' => 'eicon-text-align-right' ],
				],
				'selectors' => [
					'{{WRAPPER}} .wrap_header_banner'              => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .wrap_header_banner ul.breadcrumb'  => 'width: auto; display: initial;'
				],
				'default'   => 'center',
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			'class',
			[
				'label' => esc_html__( 'Class', 'moore' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings   = $this->get_settings();
		$class_bg   = $attr_style = '';

		if ( $settings['header_bg_source'] == 'yes' ) {
			$header_bg_source = '';

			// Check if on a taxonomy archive page.
			if ( is_tax() || is_category() ) {
				$term = get_queried_object();
				error_log("term id:" . $term->term_id);
				// Get the featured image from term meta.
				$header_bg_source = get_term_meta( $term->term_id, 'ova_category_featured_image', true );
			}

			// Fallback: if taxonomy image is not set, use the post featured image.
			if ( empty( $header_bg_source ) ) {
				$current_id      = moore_get_current_id();
				$header_bg_source = get_the_post_thumbnail_url( $current_id, 'full' );
			}

			if ( $header_bg_source ) {
				$class_bg   = 'bg_feature_img';
				$attr_style = 'style="background: url(' . esc_url( $header_bg_source ) . ') center/cover no-repeat;"';
			}
		}

		$align = isset( $settings['align'] ) ? $settings['align'] : '';

		// Inline CSS for proper overlay positioning.
		?>
		<style>
			.wrap_header_banner {
				position: relative;
			}
			.wrap_header_banner .cover_color {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				z-index: 1;
			}
			.wrap_header_banner .header_banner_el {
				position: relative;
				z-index: 2;
			}
		</style>
		<!-- Banner wrapper -->
		<div class="wrap_header_banner <?php echo esc_attr( $class_bg ) . ' ' . esc_attr( $align ); ?>" <?php echo $attr_style; ?>>

			<?php if ( $settings['header_boxed_content'] == 'yes' ) { ?>
				<div class="row_site"><div class="container_site">
			<?php } ?>

				<!-- Overlay element -->
				<div class="cover_color"></div>

				<div class="header_banner_el <?php echo esc_attr( $settings['class'] ); ?>">
					<?php if ( $settings['show_title'] == 'yes' ) { ?>
						<?php add_filter( 'moore_show_singular_title', '__return_false' ); ?>
						<?php $title_tag = $settings['title_tag']; ?>
						<<?php echo esc_html( $title_tag ); ?> class="header_title">
							<?php echo get_template_part( 'template-parts/parts/breadcrumbs_title' ); ?>
						</<?php echo esc_html( $title_tag ); ?>>
					<?php } ?>

					<?php if ( $settings['show_breadcrumbs'] == 'yes' ) { ?>
						<div class="header_breadcrumbs">
							<?php echo get_template_part( 'template-parts/parts/breadcrumbs' ); ?>
						</div>
					<?php } ?>
				</div>

			<?php if ( $settings['header_boxed_content'] == 'yes' ) { ?>
				</div></div>
			<?php } ?>

		</div>
		<?php
	}
}

$widgets_manager->register( new Moore_Elementor_Header_Banner() );
