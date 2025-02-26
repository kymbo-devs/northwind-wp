<?php
// Creating the widget 
class ova_category_apartment_widget extends WP_Widget {

    function __construct() {

        $widget_ops = array(
            'classname'                   => 'widget_categories',
            'description'                 => esc_html__( 'Get list category apartment', 'ova-framework' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'cat_apartments', esc_html__( 'Categories Apartment' ), $widget_ops );
    }

    public function widget( $args, $instance ) {
        
        $title = apply_filters( 'widget_title', $instance['title'] );

        $title = ! empty( $title ) ? $title : esc_html__( 'Categories', 'ova-framework' );

        $count = ! empty( $instance['count'] ) ? '1' : '0';

        echo $args['before_widget'];

        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $args_cat = array(
           'taxonomy' => 'cat_apartments',
           'orderby' => 'name',
           'show_count' => $count
        );


        $categories = get_categories($args_cat);

        echo ovafr_get_template( 'widgets/category_widget.php' , array( 'categories' => $categories,'count'=> $count ) );

        echo $args['after_widget'];

    }

    public function form( $instance ) {
       
        // Defaults.
        $instance     = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $count        = isset( $instance['count'] ) ? (bool) $instance['count'] : false;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>

        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>"<?php checked( $count ); ?> />
            <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Show post counts' ); ?></label></p>

        <?php 
    }

    public function update( $new_instance, $old_instance ) {
        $instance            = $old_instance;
        $instance['title']   = sanitize_text_field( $new_instance['title'] );
        $instance['count']   = ! empty( $new_instance['count'] ) ? 1 : 0;
        

        return $instance;
    }

} 

function ova_apartment_load_widget() {
    register_widget( 'ova_category_apartment_widget' );
}

add_action( 'widgets_init', 'ova_apartment_load_widget' );