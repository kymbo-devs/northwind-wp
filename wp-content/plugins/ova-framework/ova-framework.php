<?php
/**
Plugin Name: OvaTheme Framework
Plugin URI: https://themeforest.net/user/ovatheme/portfolio
Description: A plugin to create custom Post Type, Shortcode, Elementor
Version:  1.0.2
Author: Ovatheme
Author URI: https://themeforest.net/user/ovatheme
License:  GPL2
Text Domain: ova-framework
Domain Path: /languages 
*/

if (!function_exists('OvaFramework')) {

    class OvaFramework {

    	
        function __construct() {

            if (!defined('OVA_PLUGIN_PATH')) {
                define( 'OVA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );   
            }
            if (!defined('OVA_PLUGIN_URI')) {
                define( 'OVA_PLUGIN_URI', plugin_dir_url( __FILE__ ) ); 
            }

            load_plugin_textdomain( 'ova-framework', false, basename( dirname( __FILE__ ) ) .'/languages' );
            

            /* Custom Post Type */
            include OVA_PLUGIN_PATH.'inc/class-hf-builder.php';

            // Metabox
            include OVA_PLUGIN_PATH.'inc/class-metaboxes.php';

            // Shortcode
            include OVA_PLUGIN_PATH.'inc/class-shortcode.php';

            // Rooms
            include OVA_PLUGIN_PATH.'rooms/class-register-cpt.php';
            include OVA_PLUGIN_PATH.'rooms/class-cmb2-customize.php';

            // Apartments
            include OVA_PLUGIN_PATH.'apartments/class-reg-cpt.php';
            include OVA_PLUGIN_PATH.'apartments/class-category-widget.php';
            
            // Get template
            include OVA_PLUGIN_PATH.'inc/get-template-function.php';

        

            add_action( 'admin_enqueue_scripts', array( $this, 'ova_admin_scripts' ) );

            // Share Social in Single Post
            add_filter( 'ova_share_social', array( $this, 'moore_content_social' ), 2, 10 );

            add_filter( 'upload_mimes', array( $this, 'ova_upload_mimes' ), 1, 10);

            add_filter( 'widget_text', 'do_shortcode' );
            
        }
        
        function ova_admin_scripts() {

            wp_enqueue_script( 'script', OVA_PLUGIN_URI. 'assets/js/admin/script.js', array('jquery'), null, true );
            wp_enqueue_style( 'style', OVA_PLUGIN_URI. 'assets/css/admin/style.css', array(), null );
            
             
        }


        public function moore_content_social( $link, $title ) {
            $html = '<ul class="share-social-icons clearfix">
                
                        <li><a class="share-ico ico-facebook" target="_blank" href="http://www.facebook.com/sharer.php?u='.$link.'"><i class="fab fa-facebook-f"></i></a></li>
                        
                        <li><a class="share-ico ico-twitter" target="_blank" href="https://twitter.com/share?url='.$link.'&amp;text='.urlencode($title).'&amp;hashtags=simplesharebuttons"><i class="fab fa-twitter"></i></a></li>
                        
                        <li><a class="share-ico ico-tumblr" target="_blank" href="http://www.tumblr.com/share/link?url='.$link.'&amp;title='.$title.'"><i class="fab fa-tumblr"></i></a></li>                                 
                        
                        
                    </ul>';
            return $html;
        }

        public function ova_upload_mimes($mimes){
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        }
      

    }
}

return new OvaFramework();