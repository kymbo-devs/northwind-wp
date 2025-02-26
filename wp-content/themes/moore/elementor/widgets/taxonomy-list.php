<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

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

        echo '<div class="ova-text-list">';

        // Features
        if ($settings['show_features'] === 'yes') {
            $features = get_the_terms($post_id, 'features_apartment');
            if ($features && !is_wp_error($features)) {
                if ($settings['features_title']) {
                    echo '<h3 class="text-list-title">' . esc_html($settings['features_title']) . '</h3>';
                }
                echo '<ul class="text-list-items">';
                foreach ($features as $feature) {
                    $icon_url = get_term_meta($feature->term_id, 'ova_feature_icon', true);
                    echo '<li class="text-list-item">';
                    if ($icon_url) {
                        echo '<span class="icon"><img src="' . esc_url(wp_get_attachment_url($icon_url)) . '" alt="' . esc_attr($feature->name) . '"></span>';
                    } else {
                        echo '<span class="icon dot"></span>';
                    }
                    echo '<span class="text">' . esc_html($feature->name) . '</span>';
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
                    echo '<h3 class="text-list-title">' . esc_html($settings['categories_title']) . '</h3>';
                }
                echo '<ul class="text-list-items">';
                foreach ($categories as $category) {
                    $icon_url = get_term_meta($category->term_id, 'ova_category_icon', true);
                    echo '<li class="text-list-item">';
                    if ($icon_url) {
                        echo '<span class="icon"><img src="' . esc_url(wp_get_attachment_url($icon_url)) . '" alt="' . esc_attr($category->name) . '"></span>';
                    } else {
                        echo '<span class="icon dot"></span>';
                    }
                    echo '<span class="text">' . esc_html($category->name) . '</span>';
                    echo '</li>';
                }
                echo '</ul>';
            }
        }

        echo '</div>';

        // Add inline styles
        ?>
        <style>
            .ova-text-list .text-list-items {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .ova-text-list .text-list-item {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }
            .ova-text-list .icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 20px;
                height: 20px;
                margin-right: 10px;
            }
            .ova-text-list .icon img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }
            .ova-text-list .icon.dot:before {
                content: "•";
                font-size: 20px;
                line-height: 1;
            }
            .ova-text-list .text-list-title {
                margin-bottom: 15px;
            }
        </style>
        <?php
    }
}

$widgets_manager->register(new Moore_Elementor_Post_Taxonomies());