<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Moore_Elementor_Blog extends Widget_Base {

	public function get_name() {
		return 'moore_elementor_blog';
	}

	public function get_title() {
		return esc_html__( 'Blog', 'moore' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'moore' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}

	protected function register_controls() {

		$args = array(
		    'orderby' => 'name',
		    'order' => 'ASC'
		);

		$categories 	= get_categories($args);
		$cate_array 	= array();
		$arrayCateAll 	= array( 'all' => esc_html__( 'All categories', 'moore' ) );
		if ($categories) {
			foreach ( $categories as $cate ) {
				$cate_array[$cate->cat_name] = $cate->slug;
			}
		} else {
			$cate_array[ esc_html__( 'No content Category found', 'moore' ) ] = 0;
		}



		//SECTION CONTENT
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'moore' ),
			]
		);

			$this->add_control(
				'category',
				[
					'label' => esc_html__( 'Category', 'moore' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array_merge($arrayCateAll,$cate_array),
				]
			);

			$this->add_control(
				'total_count',
				[
					'label' => esc_html__( 'Post Total', 'moore' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 3,
				]
			);

			$this->add_control(
				'number_column',
				[
					'label' => esc_html__( 'Columns', 'moore' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'columns3',
					'options' => [
						'columns2' => esc_html__( '2 Columns', 'moore' ),
						'columns3' => esc_html__( '3 Columns', 'moore' ),
						'column4' => esc_html__( '4 Columns', 'moore' ),
					]
				]
			);
            
            $this->add_control(
				'orderby',
				[
					'label' => esc_html__('Order By', 'moore'),
					'type' => Controls_Manager::SELECT,
					'default' => 'ID',
					'options' => [
						'ID'	 => esc_html__('ID', 'moore'),
						'title'	 => esc_html__('Title', 'moore'),
						'rand' 	 => esc_html__('Random', 'moore'),
					]
				]
			);	

			$this->add_control(
				'order_by',
				[
					'label' => esc_html__('Order', 'moore'),
					'type' => Controls_Manager::SELECT,
					'default' => 'desc',
					'options' => [
						'asc' => esc_html__('Ascending', 'moore'),
						'desc' => esc_html__('Descending', 'moore'),
					]
				]
			);		

			$this->add_control(
				'text_readmore',
				[
					'label' => esc_html__( 'Text Read More', 'moore' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__('Read More', 'moore'),
					'condition' => [
						'show_read_more' => 'yes',
					],
				]
			);

			$this->add_control(
				'show_short_desc',
				[
					'label' => esc_html__( 'Show Short Description', 'moore' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'moore' ),
					'label_off' => esc_html__( 'Hide', 'moore' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);		

			$this->add_control(
				'show_date',
				[
					'label' => esc_html__( 'Show Date', 'moore' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'moore' ),
					'label_off' => esc_html__( 'Hide', 'moore' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'show_author',
				[
					'label' => esc_html__( 'Show Author', 'moore' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'moore' ),
					'label_off' => esc_html__( 'Hide', 'moore' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);


			$this->add_control(
				'show_title',
				[
					'label' => esc_html__( 'Show Title', 'moore' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'moore' ),
					'label_off' => esc_html__( 'Hide', 'moore' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);


			$this->add_control(
				'show_read_more',
				[
					'label' => esc_html__( 'Show Read More', 'moore' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'moore' ),
					'label_off' => esc_html__( 'Hide', 'moore' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

		$this->end_controls_section();
		//END SECTION CONTENT


		//SECTION TAB STYLE TITLE
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ova-blog .post-title',
			]
		);

		$this->add_control(
			'color_title',
			[
				'label' => esc_html__( 'Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .post-title' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_title_hover',
			[
				'label' => esc_html__( 'Color Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .post-title:hover' => 'color : {{VALUE}};',
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
					'{{WRAPPER}} .ova-blog .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE


		$this->start_controls_section(
			'section_short_desc',
			[
				'label' => esc_html__( 'Short Description', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'short_desc_typography',
				'selector' => '{{WRAPPER}} .ova-blog .short_desc p',
			]
		);

		$this->add_control(
			'color_short_desc',
			[
				'label' => esc_html__( 'Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .short_desc p' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_short_desc_hover',
			[
				'label' => esc_html__( 'Color Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .short_desc p:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_short_desc',
			[
				'label' => esc_html__( 'Margin', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .short_desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE

		$this->start_controls_section(
			'section_meta',
			[
				'label' => esc_html__( 'Meta', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .ova-blog .item .post-meta .item-meta .right, {{WRAPPER}} .ova-blog .item .post-meta .item-meta .right a',
			]
		);

		$this->add_control(
			'text_color_meta',
			[
				'label' => esc_html__( 'Text Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .post-meta .item-meta .right' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_meta',
			[
				'label' => esc_html__( 'Margin', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .post-meta .item-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//SECTION TAB STYLE READMORE
		$this->start_controls_section(
			'section_readmore',
			[
				'label' => esc_html__( 'Read More', 'moore' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_read_more' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'selector' => '{{WRAPPER}} .ova-blog .item .read-more',
			]
		);

		$this->add_control(
			'color_readmore',
			[
				'label' => esc_html__( 'Color', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .read-more' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_readmore_hover',
			[
				'label' => esc_html__( 'Color Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .read-more:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_color_readmore',
			[
				'label' => esc_html__( 'Background', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .read-more' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_color_readmore_hover',
			[
				'label' => esc_html__( 'Background Hover', 'moore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .read-more:hover' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_readmore',
			[
				'label' => esc_html__( 'Margin', 'moore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE READMORE

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings 		= $this->get_settings_for_display();
		
		$category 		= $settings['category'];
		$total_count 	= $settings['total_count'];
		$order 			= $settings['order_by'];
		$orderby        = $settings['orderby'];
		$number_column 	= $settings['number_column'];

		$text_readmore  = $settings['text_readmore'];
		$show_date 		= $settings['show_date'];
		$show_author 	= $settings['show_author'];
		$show_title 	= $settings['show_title'];
		$show_short_desc= $settings['show_short_desc'];
		$show_read_more = $settings['show_read_more'];


		$args = [];
		if ($category == 'all') {
			$args=[
				'post_type' => 'post',
				'posts_per_page' => $total_count,
				'order' => $order,
				'orderby' => $orderby 
			];
		} else {
			$args=[
				'post_type' => 'post', 
				'category_name'=>$category,
				'posts_per_page' => $total_count,
				'order' => $order,
				'orderby' => $orderby,
				'fields'	=> 'ids'
			];
		}

		$blog = new \WP_Query($args);

		?>
		
		<ul class="ova-blog ">
			<?php
				if($blog->have_posts()) : while($blog->have_posts()) : $blog->the_post();
			?>
			
				<li class="item <?php echo esc_attr( $number_column ) ?>">

					<?php if(has_post_thumbnail()){ ?>
						
                      <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					    <div class="media">
				        	<?php 
				        		$thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id() , 'moore_thumbnail' );
				        	?>
				        	<img src="<?php echo esc_url( $thumbnail ) ?>" alt="<?php the_title(); ?>">
							
				        </div>
					  </a>

			        <?php } ?>
					

					<?php if( $show_title == 'yes' ){ ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<h2 class="post-title">
								<?php the_title(); ?>
							</h2>
						</a>
				    <?php } ?>

				    <?php if( $show_short_desc == 'yes' ){ ?>
					    <div class="short_desc">
					    	<?php echo moore_custom_text( get_the_excerpt(), 20 ); ?>
					    </div>
					<?php } ?>

					<ul class="post-meta">
					    	
					    	<?php if( $show_date == 'yes' ){ ?>
							    <li class="item-meta post-date">
							        <span class="right date">
							        	<?php the_time( get_option( 'date_format' ));?>
							        </span>
							    </li>
						    <?php } ?>

						    <?php if( $show_author == 'yes' ){ ?>
								<li class="item-meta wp-author">
								    <span class="right post-author">
							        		<?php the_author_meta( 'display_name' ); ?>
								    </span>
							    </li>
							<?php } ?>
							
					</ul>

				    <?php if( $show_read_more == 'yes' ){ ?>
					    <a class="read-more" href="<?php the_permalink(); ?>">
					    	<?php  echo esc_html( $text_readmore ); ?>
					    </a>
				    <?php }?>
					
				</li>	
					
			<?php
				endwhile; endif; wp_reset_postdata();
			?>
		</ul>
		
		
		<?php
	}
}

$widgets_manager->register( new Moore_Elementor_Blog() );
