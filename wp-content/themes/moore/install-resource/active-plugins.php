<?php

require_once (MOORE_URL.'/install-resource/class-tgm-plugin-activation.php');

// Register required plugins
add_action( 'tgmpa_register', 'moore_register_required_plugins' );
function moore_register_required_plugins() {
    $plugins = array(
        array(
            'name'                     => esc_html__('Elementor','moore'),
            'slug'                     => 'elementor',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Contact Form 7','moore'),
            'slug'                     => 'contact-form-7',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Widget importer exporter','moore'),
            'slug'                     => 'widget-importer-exporter',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('One click demo import','moore'),
            'slug'                     => 'one-click-demo-import',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('CMB2','moore'),
            'slug'                     => 'cmb2',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('Recent Posts Widget with Thumbnails','moore'),
            'slug'                     => 'recent-posts-widget-with-thumbnails',
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__('OvaTheme Framework','moore'),
            'slug'                     => 'ova-framework',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install-resource/plugins/ova-framework.zip',
            'version'                  => '1.0.2'    
        ),
        array(
            'name'                     => esc_html__('Image Map Pro Wordpress','moore'),
            'slug'                     => 'image-map-pro-wordpress',
            'required'                 => true,
            'source'                   => get_template_directory() . '/install-resource/plugins/image-map-pro-wordpress.zip'
        )
    );

    $config = array(
        'id'           => 'moore',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    moore_tgmpa( $plugins, $config );
}

// Before import demo data
add_action( 'ocdi/before_content_import', 'moore_before_content_import' );
function moore_before_content_import() { 
    // Update option elementor cpt support
    $post_types = array('post','page','ova_framework_hf_el');
    update_option( 'elementor_cpt_support', $post_types );
}

add_action( 'ocdi/after_import', 'moore_after_import_setup' );
function moore_after_import_setup() {
    // Assign menus to their locations.
    $primary = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

    if ( !is_wp_error( $primary ) ) {
        set_theme_mod( 'nav_menu_locations', [
            'primary' => $primary->term_id
        ]);
    }

    // Assign front page and posts page (blog page).
    $front_page_id = moore_get_page_by_title( 'Home 1' );
    $blog_page_id  = moore_get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    // Config Elementor
    update_option( 'elementor_disable_color_schemes', 'yes' );
    update_option( 'elementor_disable_typography_schemes', 'yes' );
    update_option( 'elementor_css_print_method', 'internal' );
    update_option( 'elementor_load_fa4_shim', 'yes' );

    // Update customize
    moore_replace_url_in_customize();
    
    // After import replace URLs
    moore_replace_url_after_import();

    // Replace image URLs
    $upload_dir = wp_get_upload_dir();
    $base_url   = $upload_dir['baseurl'];
    moore_replace_url_after_import( $base_url, 'https://ovatheme.nyc3.cdn.digitaloceanspaces.com/moore' );
}

// Import files
add_filter( 'ocdi/import_files', 'moore_import_files' );
function moore_import_files() {
    return array(
        array(
            'import_file_name'             => 'Demo Import',
            'categories'                   => array( 'Category 1', 'Category 2' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/demo-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/widgets.wie',
            'local_import_customizer_file'   => trailingslashit( get_template_directory() ) . 'install-resource/demo-import/customize.dat'
        )
    );
}

// Get page by title
if ( !function_exists( 'moore_get_page_by_title' ) ) {
    function moore_get_page_by_title( $page_title, $output = OBJECT, $post_type = 'page' ) {
        global $wpdb;

        if ( is_array( $post_type ) ) {
            $post_type           = esc_sql( $post_type );
            $post_type_in_string = "'" . implode( "','", $post_type ) . "'";
            $sql                 = $wpdb->prepare(
                "
                SELECT ID
                FROM $wpdb->posts
                WHERE post_title = %s
                AND post_type IN ($post_type_in_string)
            ",
                $page_title
            );
        } else {
            $sql = $wpdb->prepare(
                "
                SELECT ID
                FROM $wpdb->posts
                WHERE post_title = %s
                AND post_type = %s
            ",
                $page_title,
                $post_type
            );
        }

        $page = $wpdb->get_var( $sql );

        if ( $page ) {
            return get_post( $page, $output );
        }

        return null;
    }
}

// Replace url in customize
if ( !function_exists( 'moore_replace_url_in_customize' ) ) {
    function moore_replace_url_in_customize() {
        $demo_url = apply_filters( 'moore_demo_url', 'https://demo.ovatheme.com/moore' );

        // Get theme mods
        $theme_mods = get_theme_mods();

        if ( !empty( $theme_mods ) ) {
            foreach ( $theme_mods as $key => $val ) {
                if ( is_string( $val ) && str_contains( $val, $demo_url ) ) {
                    $val = str_replace( $demo_url, get_site_url(), $val );

                    // Update theme mod
                    set_theme_mod( $key, $val );
                }
            }
        }
    }
}

// Replace url after import demo data
if ( !function_exists('moore_replace_url_after_import') ) {
    function moore_replace_url_after_import( $site_url = '', $demo_url = '' ) {
        global $wpdb;

        // Site URL
        if ( !$site_url ) {
            $site_url = apply_filters( 'moore_site_url', get_site_url() );
        }

        // Demo URL
        if ( !$demo_url ) {
            $demo_url = apply_filters( 'moore_demo_url', 'https://demo.ovatheme.com/moore' );
        }

        // Replace in option value
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->options} " .
                "SET `option_value` = REPLACE(`option_value`, %s, %s);",
                $demo_url,
                $site_url
            )
        );

        // Replace in posts
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->posts} " .
                "SET `post_content` = REPLACE(`post_content`, %s, %s), `guid` = REPLACE(`guid`, %s, %s);",
                $demo_url,
                $site_url,
                $demo_url,
                $site_url
            )
        );

        // Replace in meta value
        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->postmeta} " .
                "SET `meta_value` = REPLACE(`meta_value`, %s, %s) " .
                "WHERE `meta_key` <> '_elementor_data';",
                $demo_url,
                $site_url
            )
        );

        // Elementor Data
        $escaped_from       = str_replace( '/', '\\/', $demo_url );
        $escaped_to         = str_replace( '/', '\\/', $site_url );
        $meta_value_like    = '[%'; // meta_value LIKE '[%' are json formatted

        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->postmeta} " .
                'SET `meta_value` = REPLACE(`meta_value`, %s, %s) ' .
                "WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE %s;",
                $escaped_from,
                $escaped_to,
                $meta_value_like
            )
        );
    }
}