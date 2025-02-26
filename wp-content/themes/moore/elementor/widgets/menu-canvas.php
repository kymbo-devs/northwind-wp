<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Moore_Elementor_Canvas_Menu extends Widget_Base {

	public function get_name() {
		return 'moore_elementor_menu_canvas';
	}

	public function get_title() {
		return esc_html__( 'Menu Canvas', 'moore' );
	}

	public function get_icon() {
		return ' eicon-menu-bar';
	}

	public function get_categories() {
		return [ 'hf' ];
	}

	public function get_script_depends() {
		return [ 'moore-elementor-menu-canvas' ];
	}
	

	protected function register_controls() {


		/* Global Section *******************************/
		/***********************************************/
		$this->start_controls_section(
			'section_menu_type',
			[
				'label' => esc_html__( 'Global', 'moore' ),
			]
		);


			$menus = \wp_get_nav_menus();
			$list_menu = array();
			foreach ($menus as $menu) {
				$list_menu[$menu->slug] = $menu->name;
			}

			$this->add_control(
				'menu_slug',
				[
					'label' => esc_html__( 'Select Menu', 'moore' ),
					'type' => Controls_Manager::SELECT,
					'options' => $list_menu,
					'default' => '',
					'prefix_class' => 'elementor-view-',
				]
			);

			$this->add_control(
				'menu_dir',
				[
					'label' => esc_html__( 'Menu Direction', 'moore' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'dir_left' => [
							'title' => esc_html__( 'Left', 'moore' ),
							'icon' => 'eicon-text-align-right',
						],
						'dir_right' => [
							'title' => esc_html__( 'Right', 'moore' ),
							'icon' => 'eicon-text-align-left',
						],
					],
					'default' => 'dir_left'
				]
			);
			
		$this->end_controls_section();	


		/* Parent Menu Section *******************************/
		/***********************************************/
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Style', 'moore' ),
			]
		);
			
			
			
			$this->add_control(
				'btn_color',
				[
					'label' => esc_html__( 'Button', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .menu-toggle:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .menu-toggle span:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .menu-toggle:after' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'background_btn_color',
				[
					'label' => esc_html__( 'Background Button', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} button.menu-toggle:hover' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'bg_color',
				[
					'label' => esc_html__( 'Menu Background', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .container-menu' => 'background-color: {{VALUE}};',
					],
					'separator' => 'before'
				]
			);


			$this->add_control(
				'text_color',
				[
					'label' => esc_html__( 'Link', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} ul li a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'text_color_hover',
				[
					'label' => esc_html__( 'Link Hover', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} ul li a:hover' => 'color: {{VALUE}};',
					]
					
				]
			);

			$this->add_control(
				'text_color_active',
				[
					'label' => esc_html__( 'Link Active', 'moore' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} ul li.current-menu-item > a' => 'color: {{VALUE}};',
						'{{WRAPPER}} ul li.current-menu-ancestor > a' => 'color: {{VALUE}};',
						'{{WRAPPER}} ul li.current-menu-parent > a' => 'color: {{VALUE}};',
					]
					
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography',
					'selector'	=> '{{WRAPPER}} ul li a'
				]
			);

		$this->end_controls_section();
		
	}

	
	protected function render() {
		
		$settings = $this->get_settings();
		
		?>

		<nav class="menu-canvas">
            <button class="menu-toggle">
            	<span></span>
            </button>
            <nav class="container-menu <?php echo  esc_attr( $settings['menu_dir'] ); ?>" >
	            <div class="close-menu">
	            	<i class="ovaicon-cancel"></i>
	            </div>
				<?php
					wp_nav_menu( [
						'theme_location'  => $settings['menu_slug'],
						'container_class' => 'primary-navigation',
						'menu'              => $settings['menu_slug'],

					] );
				?>
			</nav>
			<div class="site-overlay"></div>
        </nav>
		

	<?php }
	
}


$widgets_manager->register( new Moore_Elementor_Canvas_Menu() );


