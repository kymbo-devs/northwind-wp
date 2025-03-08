<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Moore_Elementor_Map_Widget extends Widget_Base {

	// Widget name
	public function get_name() {
		return 'ova_map_widget';
	}

	// Widget title
	public function get_title() {
		return __( 'OVA Map Widget', 'moore' );
	}

	// Widget icon in Elementor panel
	public function get_icon() {
		return 'eicon-map-pin';
	}

	// Widget category – adjust as needed
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register widget controls.
	 *
	 * In this case we are not using any controls for the iframe,
	 * since the iframe is always loaded from the current post meta.
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'moore' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		// No controls are needed for the map iframe.
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 */
	protected function render() {
		global $post;
		$iframe = '';

		// Retrieve the iframe from the current post's meta field.
		if ( isset( $post->ID ) ) {
			$iframe = get_post_meta( $post->ID, 'ova_apartment_iframe_mapa', true );
		}

		// Output the iframe HTML if available.
		if ( ! empty( $iframe ) ) {
			echo '<div class="ova-map-widget">';
				echo $iframe;
			echo '</div>';
		}
	}

	/**
	 * Render widget output in the Elementor editor.
	 *
	 * Since post meta may not be available in editor preview,
	 * we show a simple placeholder message.
	 */
	protected function content_template() {
		?>
		<#
		// In the editor, we cannot reliably retrieve post meta.
		print( '<div class="ova-map-widget"><?php _e( "Map will be loaded from post meta on the live page.", "moore" ); ?></div>' );
		#>
		<?php
	}
}

// Finally, register the widget
$widgets_manager->register( new Moore_Elementor_Map_Widget() );


class Moore_Elementor_Apartment_Fields extends Widget_Base {

    public function get_name() {
        return 'moore_elementor_apartment_fields';
    }

    public function get_title() {
        return esc_html__( 'Apartment Fields', 'moore' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return [ 'moore' ]; // Adjust to your category slug
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'moore' ),
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Section Title', 'moore' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Apartment Details', 'moore' ),
            ]
        );

        $this->end_controls_section();

        // Style section
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'moore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_title_typography',
                'label' => esc_html__( 'Section Title Typography', 'moore' ),
                'selector' => '{{WRAPPER}} .moore-apartment-fields-title',
            ]
        );

        // Item typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_typography',
                'label' => esc_html__( 'Item Typography', 'moore' ),
                'selector' => '{{WRAPPER}} .moore-apartment-fields-list .field-item',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $post_id  = get_the_ID();

        // 1) Define which meta keys you want to display, their label, and icon.
        //    Replace meta_key with the actual keys you have from your OVA meta fields.
        $apartment_fields = [
            [
				'meta_key' => 'ova_apartment_floor',
				'label'    => esc_html__( 'Piso', 'moore' ),
				'icon'     => 'fa fa-building-o',
			],
			[
				'meta_key' => 'ova_apartment_bedrooms',
				'label'    => esc_html__( 'Habitaciones', 'moore' ),
				'icon'     => 'fa fa-bed',
			],
			[
				'meta_key' => 'ova_apartment_area',
				'label'    => esc_html__( 'Área (m²)', 'moore' ),
				'icon'     => 'fa fa-arrows-alt',
			],
			[
				'meta_key' => 'ova_apartment_date',
				'label'    => esc_html__( 'Fecha', 'moore' ),
				'icon'     => 'fa fa-calendar',
			],
			[
				'meta_key' => 'ova_apartment_regimen',
				'label'    => esc_html__( 'Régimen', 'moore' ),
				'icon'     => 'fa fa-balance-scale',
			],
			[
				'meta_key' => 'ova_apartment_direccion',
				'label'    => esc_html__( 'Dirección', 'moore' ),
				'icon'     => 'fa fa-map-marker',
			],
			[
				'meta_key' => 'ova_apartment_location',
				'label'    => esc_html__( 'Locación', 'moore' ),
				'icon'     => 'fa fa-map',
			],
			[
				'meta_key' => 'ova_apartment_direccion_2',
				'label'    => esc_html__( 'Dirección 2', 'moore' ),
				'icon'     => 'fa fa-map-signs',
			],
			[
				'meta_key' => 'ova_apartment_estado',
				'label'    => esc_html__( 'Estado', 'moore' ),
				'icon'     => 'fa fa-info-circle',
			],
			[
				'meta_key' => 'ova_apartment_habitaciones',
				'label'    => esc_html__( 'Habitaciones', 'moore' ),
				'icon'     => 'fa fa-home',
			],
			[
				'meta_key' => 'ova_apartment_tamano',
				'label'    => esc_html__( 'Tamaño', 'moore' ),
				'icon'     => 'fa fa-arrows',
			],
			[
				'meta_key' => 'ova_apartment_ano_edificacion',
				'label'    => esc_html__( 'Año Edificación', 'moore' ),
				'icon'     => 'fa fa-calendar-check-o',
			],
		];

        // 2) Print the section title if set
        if ( ! empty( $settings['section_title'] ) ) {
            echo '<h3 class="moore-apartment-fields-title">' . esc_html( $settings['section_title'] ) . '</h3>';
        }

        // 3) Start our container for the 2-column list
        echo '<div class="moore-apartment-fields-list">';

        // 4) Loop over each defined field, check if it has a value, and display
        foreach ( $apartment_fields as $field ) {
            $value = get_post_meta( $post_id, $field['meta_key'], true );

            // If empty, skip
            if ( empty( $value ) ) {
                continue;
            }

            // Output each item
            echo '<div class="field-item">';
            echo '  <div class="field-icon"><span class="' . esc_attr( $field['icon'] ) . '"></span></div>';
            echo '  <div class="field-text">';
            // You can display either the label or the actual meta value or both.
            // For example: "Precio: 200.000 €"
            // Below, we show "Label: Value"
            echo '    <strong>' . esc_html( $field['label'] ) . ':</strong> ' . esc_html( $value );
            echo '  </div>';
            echo '</div>';
        }

        // Close the container
        echo '</div>';

        // 5) Add some quick inline CSS for 2 columns (adjust as needed)
        ?>
        <style>
            .moore-apartment-fields-list {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-gap: 15px 30px; /* row gap x column gap */
            }
            .moore-apartment-fields-list .field-item {
                display: flex;
                align-items: center;
            }
            .moore-apartment-fields-list .field-icon {
                margin-right: 8px;
                font-size: 20px; /* Adjust for Dashicons or your icon size */
            }
        </style>
        <?php
    }
}

// Finally, register the widget
$widgets_manager->register( new Moore_Elementor_Apartment_Fields() );

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Moore_Elementor_Post_Taxonomies extends Widget_Base {

    public function get_name() {
        return 'moore_elementor_post_taxonomies';
    }

    public function get_title() {
        return esc_html__( 'Post Taxonomies', 'moore' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return [ 'moore' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'moore' ),
            ]
        );

        $this->add_control(
            'show_features',
            [
                'label' => esc_html__( 'Show Features', 'moore' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'features_title',
            [
                'label' => esc_html__( 'Features Title', 'moore' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Features', 'moore' ),
                'condition' => [
                    'show_features' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_categories',
            [
                'label' => esc_html__( 'Show Categories', 'moore' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'categories_title',
            [
                'label' => esc_html__( 'Categories Title', 'moore' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Categories', 'moore' ),
                'condition' => [
                    'show_categories' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style section
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'moore' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'moore' ),
                'selector' => '{{WRAPPER}} .taxonomy-section-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_typography',
                'label' => esc_html__( 'Item Typography', 'moore' ),
                'selector' => '{{WRAPPER}} .taxonomy-item',
            ]
        );

        $this->end_controls_section();
    }

   protected function render() {
    $settings = $this->get_settings_for_display();
    $post_id = get_the_ID();

    // Outer UL wrapper for the taxonomy fields list
    echo '<ul class="moore-taxonomy-fields-list">';

    // Features
    if ($settings['show_features'] === 'yes') {
        $features = get_the_terms($post_id, 'features_apartment');
        if ($features && !is_wp_error($features)) {
            if ($settings['features_title']) {
                echo '<h3 class="moore-taxonomy-fields-title">' . esc_html($settings['features_title']) . '</h3>';
            }
            // UL for features grid
            echo '<ul class="taxonomy-fields-grid">';
            foreach ($features as $feature) {
                $icon_url = get_term_meta($feature->term_id, 'ova_feature_icon', true);
                echo '<li class="field-item">';
                    if ($icon_url) {
                        echo '<div class="field-icon"><img src="' . esc_url(wp_get_attachment_url($icon_url)) . '" alt="' . esc_attr($feature->name) . '"></div>';
                    } else {
                        echo '<div class="field-icon"><span class="fa fa-dot-circle-o"></span></div>';
                    }
                    echo '<div class="field-text">' . esc_html($feature->name) . '</div>';
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    // Categories
    if ($settings['show_categories'] === 'yes') {
        $categories = get_the_terms($post_id, 'category');
        if ($categories && !is_wp_error($categories)) {
            if ($settings['categories_title']) {
                echo '<h3 class="moore-taxonomy-fields-title">' . esc_html($settings['categories_title']) . '</h3>';
            }
            // UL for categories grid
            echo '<ul class="taxonomy-fields-grid">';
            foreach ($categories as $category) {
                $icon_url = get_term_meta($category->term_id, 'ova_category_icon', true);
                echo '<li class="field-item">';
                    if ($icon_url) {
                        echo '<div class="field-icon"><img src="' . esc_url(wp_get_attachment_url($icon_url)) . '" alt="' . esc_attr($category->name) . '"></div>';
                    } else {
                        echo '<div class="field-icon"><span class="fa fa-dot-circle-o"></span></div>';
                    }
                    echo '<div class="field-text">' . esc_html($category->name) . '</div>';
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    echo '</ul>';

    // Updated styles to match apartment fields with ULs
    ?>
    <style>
        /* Common Widget Styles
        .moore-apartment-fields-title,
        .moore-taxonomy-fields-title {
            color: #2c3338;
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 20px;
            padding: 0;
            line-height: 1.3;
        }*/

        /* Apartment Fields Grid */
        .moore-apartment-fields-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px 30px;
            margin-bottom: 30px;
        }

        .moore-apartment-fields-list .field-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background: #fff;
            border: 1px solid #2f2f2f;
            border-radius: 4px;
            transition: all 0.2s ease-in-out;
        }

        .moore-apartment-fields-list .field-item:hover {
            border-color: #000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .moore-apartment-fields-list .field-icon {
            margin-right: 12px;
            color: #2f2f2f;
            width: 24px;
            text-align: center;
        }

        .moore-apartment-fields-list .field-text {
            color: #000;
            line-height: 1.4;
        }

        .moore-apartment-fields-list .field-text strong {
            color: #000;
            font-weight: 600;
            margin-right: 5px;
        }

        /* Taxonomy Fields Styling */
        .moore-taxonomy-fields-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .taxonomy-fields-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 15px 30px;
            margin: 0 0 30px;
            padding: 0;
            list-style: none;
        }

        .taxonomy-fields-grid .field-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background: #fff;
            border: 1px solid #dcdcde;
            border-radius: 4px;
            transition: all 0.2s ease-in-out;
        }

        .taxonomy-fields-grid .field-item:hover {
            border-color: #000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .taxonomy-fields-grid .field-icon {
            margin-right: 12px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .taxonomy-fields-grid .field-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .taxonomy-fields-grid .field-icon .fa {
            color: #000;
            font-size: 18px;
        }

        .taxonomy-fields-grid .field-text {
            color: #2f2f2f;
            font-size: 14px;
            line-height: 1.4;
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .moore-apartment-fields-list,
            .taxonomy-fields-grid {
                grid-template-columns: 1fr;
                grid-gap: 15px;
            }
            
            .moore-apartment-fields-title,
            .moore-taxonomy-fields-title {
                font-size: 16px;
                margin-bottom: 15px;
            }
        }
    </style>
    <?php
	}
}

$widgets_manager->register(new Moore_Elementor_Post_Taxonomies());
