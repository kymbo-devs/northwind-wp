<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVA_Rooms_custom_post_type' ) ) {

	class OVA_Rooms_custom_post_type{

		public function __construct() {
			add_action( 'init', array( $this, 'OVAROOMS_register_post_type_ova_room' ) );
			add_action( 'init', array( $this, 'OVAROOMS_register_taxonomy_ova_room' ) );
			add_action('admin_enqueue_scripts', array($this, 'load_media'));
			add_action('cat_room_add_form_fields', array($this, 'add_category_image'), 10, 2);
			add_action('created_cat_room', array($this, 'save_category_image'), 10, 2);
			add_action('cat_room_edit_form_fields', array($this, 'update_category_image'), 10, 2);
			add_action('edited_cat_room', array($this, 'updated_category_image'), 10, 2);
			add_action('features_room_add_form_fields', array($this, 'add_category_image'), 10, 2);
			add_action('created_features_room', array($this, 'save_category_image'), 10, 2);
			add_action('features_room_edit_form_fields', array($this, 'update_category_image'), 10, 2);
			add_action('edited_features_room', array($this, 'updated_category_image'), 10, 2);
		}

		
		function OVAROOMS_register_post_type_ova_room() {

			$labels = array(
				'name'                  => _x( 'Room', 'Post Type General Name', 'ova-framework' ),
				'singular_name'         => _x( 'Room', 'Post Type Singular Name', 'ova-framework' ),
				'menu_name'             => __( 'Room', 'ova-framework' ),
				'name_admin_bar'        => __( 'Room', 'ova-framework' ),
				'archives'              => __( 'Item Archives', 'ova-framework' ),
				'attributes'            => __( 'Item Attributes', 'ova-framework' ),
				'parent_item_colon'     => __( 'Parent Item:', 'ova-framework' ),
				'all_items'             => __( 'All Room', 'ova-framework' ),
				'add_new_item'          => __( 'Add New Room', 'ova-framework' ),
				'add_new'               => __( 'Add New Room', 'ova-framework' ),
				'new_item'              => __( 'New Item', 'ova-framework' ),
				'edit_item'             => __( 'Edit Room', 'ova-framework' ),
				'view_item'             => __( 'View Item', 'ova-framework' ),
				'view_items'            => __( 'View Items', 'ova-framework' ),
				'search_items'          => __( 'Search Item', 'ova-framework' ),
				'not_found'             => __( 'Not found', 'ova-framework' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'ova-framework' ),
			);
			$args = array(
				'description'         => __( 'Post Type Description', 'ova-framework' ),
				'labels'              => $labels,
				'supports'            => array( 'title','editor', 'thumbnail' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'menu_position'       => 5,
				'query_var'           => true,
				'has_archive'         => true,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'rewrite'             => array( 'slug' => _x( 'ova_room', 'URL slug', 'ova-framework' ) ),
				'capability_type'     => 'post',
				'menu_icon'           => 'dashicons-layout'
			);
			register_post_type( 'ova_room', $args );
		}

		function OVAROOMS_register_taxonomy_ova_room(){

			$labels = array(
				'name'                       => _x( 'Type Room', 'Post Type General Name', 'ova-framework' ),
				'singular_name'              => _x( 'Type', 'Post Type Singular Name', 'ova-framework' ),
				'menu_name'                  => __( 'Type Room', 'ova-framework' ),
				'all_items'                  => __( 'All Type Room', 'ova-framework' ),
				'parent_item'                => __( 'Parent Item', 'ova-framework' ),
				'parent_item_colon'          => __( 'Parent Item:', 'ova-framework' ),
				'new_item_name'              => __( 'New Item Name', 'ova-framework' ),
				'add_new_item'               => __( 'Add New Type', 'ova-framework' ),
				'add_new'                    => __( 'Add New Type', 'ova-framework' ),
				'edit_item'                  => __( 'Edit Type', 'ova-framework' ),
				'view_item'                  => __( 'View Item', 'ova-framework' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'ova-framework' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'ova-framework' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'ova-framework' ),
				'popular_items'              => __( 'Popular Items', 'ova-framework' ),
				'search_items'               => __( 'Search Items', 'ova-framework' ),
				'not_found'                  => __( 'Not Found', 'ova-framework' ),
				'no_terms'                   => __( 'No items', 'ova-framework' ),
				'items_list'                 => __( 'Items list', 'ova-framework' ),
				'items_list_navigation'      => __( 'Items list navigation', 'ova-framework' ),

			);
			$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'publicly_queryable' => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => false,
				'rewrite'            => array(
					'slug'       => _x( 'cat_room','Type Slug', 'ova-framework' ),
					'with_front' => false,
					'feeds'      => true,
				),
			);
			register_taxonomy( 'cat_room', array( 'ova_room' ), $args );



			$labels_features = array(
				'name'                       => _x( 'Features Room', 'Post Type General Name', 'ova-framework' ),
				'singular_name'              => _x( 'Features', 'Post Type Singular Name', 'ova-framework' ),
				'menu_name'                  => __( 'Features Room', 'ova-framework' ),
				'all_items'                  => __( 'All Features Room', 'ova-framework' ),
				'parent_item'                => __( 'Parent Item', 'ova-framework' ),
				'parent_item_colon'          => __( 'Parent Item:', 'ova-framework' ),
				'new_item_name'              => __( 'New Item Name', 'ova-framework' ),
				'add_new_item'               => __( 'Add New Features', 'ova-framework' ),
				'add_new'                    => __( 'Add New Features', 'ova-framework' ),
				'edit_item'                  => __( 'Edit Features', 'ova-framework' ),
				'view_item'                  => __( 'View Item', 'ova-framework' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'ova-framework' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'ova-framework' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'ova-framework' ),
				'popular_items'              => __( 'Popular Items', 'ova-framework' ),
				'search_items'               => __( 'Search Items', 'ova-framework' ),
				'not_found'                  => __( 'Not Found', 'ova-framework' ),
				'no_terms'                   => __( 'No items', 'ova-framework' ),
				'items_list'                 => __( 'Items list', 'ova-framework' ),
				'items_list_navigation'      => __( 'Items list navigation', 'ova-framework' ),

			);
			$args_features = array(
				'labels'            => $labels_features,
				'hierarchical'      => true,
				'publicly_queryable' => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => false,
				'rewrite'            => array(
					'slug'       => _x( 'features_room','Room Slug', 'ova-framework' ),
					'with_front' => false,
					'feeds'      => true,
				),
			);
			register_taxonomy( 'features_room', array( 'ova_room' ), $args_features );
			
		}

		public function load_media() {
			wp_enqueue_media();
		}

		public function add_category_image($taxonomy) { ?>
			<div class="form-field term-group">
				<label for="category-image-id"><?php _e('Image', 'ova-framework'); ?></label>
				<input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
				<div id="category-image-wrapper"></div>
				<p>
					<input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e('Add Image', 'ova-framework'); ?>" />
					<input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e('Remove Image', 'ova-framework'); ?>" />
				</p>
			</div>
			<script>
				jQuery(document).ready(function($) {
					_wpMediaViewsL10n.insertIntoPost = '<?php _e("Insert", "ova-framework"); ?>';
					function ct_media_upload(button_class) {
						var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
						$('body').on('click', button_class, function(e) {
							var button_id = '#' + $(this).attr('id');
							var send_attachment_bkp = wp.media.editor.send.attachment;
							var button = $(button_id);
							_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment) {
								if(_custom_media) {
									$('#category-image-id').val(attachment.id);
									$('#category-image-wrapper').html('<img class="custom_media_image" src="' + attachment.url + '" style="max-width:100px;"/>');
								} else {
									return _orig_send_attachment.apply(button_id, [props, attachment]);
								}
							}
							wp.media.editor.open(button);
							return false;
						});
					}
					ct_media_upload('.ct_tax_media_button');
					$('body').on('click', '.ct_tax_media_remove', function() {
						$('#category-image-id').val('');
						$('#category-image-wrapper').html('');
					});
				});
			</script>
		<?php }

		public function save_category_image($term_id, $tt_id) {
			if(isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']){
				$image = $_POST['category-image-id'];
				add_term_meta($term_id, 'category-image-id', $image, true);
			}
		}

		public function update_category_image($term, $taxonomy) { ?>
			<tr class="form-field term-group-wrap">
				<th scope="row">
					<label for="category-image-id"><?php _e('Image', 'ova-framework'); ?></label>
				</th>
				<td>
					<?php $image_id = get_term_meta($term->term_id, 'category-image-id', true); ?>
					<input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
					<div id="category-image-wrapper">
						<?php if($image_id) { ?>
							<?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
						<?php } ?>
					</div>
					<p>
						<input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e('Add Image', 'ova-framework'); ?>" />
						<input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e('Remove Image', 'ova-framework'); ?>" />
					</p>
				</td>
			</tr>
			<script>
				jQuery(document).ready(function($) {
					_wpMediaViewsL10n.insertIntoPost = '<?php _e("Insert", "ova-framework"); ?>';
					function ct_media_upload(button_class) {
						var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
						$('body').on('click', button_class, function(e) {
							var button_id = '#' + $(this).attr('id');
							var send_attachment_bkp = wp.media.editor.send.attachment;
							var button = $(button_id);
							_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment) {
								if(_custom_media) {
									$('#category-image-id').val(attachment.id);
									$('#category-image-wrapper').html('<img class="custom_media_image" src="' + attachment.url + '" style="max-width:100px;"/>');
								} else {
									return _orig_send_attachment.apply(button_id, [props, attachment]);
								}
							}
							wp.media.editor.open(button);
							return false;
						});
					}
					ct_media_upload('.ct_tax_media_button');
					$('body').on('click', '.ct_tax_media_remove', function() {
						$('#category-image-id').val('');
						$('#category-image-wrapper').html('');
					});
				});
			</script>
		<?php }

		public function updated_category_image($term_id, $tt_id) {
			if(isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']){
				$image = $_POST['category-image-id'];
				update_term_meta($term_id, 'category-image-id', $image);
			} else {
				delete_term_meta($term_id, 'category-image-id');
			}
		}
	}

	new OVA_Rooms_custom_post_type();
}