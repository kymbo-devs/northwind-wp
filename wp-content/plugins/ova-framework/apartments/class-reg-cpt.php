<?php 

if( !defined( 'ABSPATH' ) ) exit();

if( !class_exists( 'OVA_Apartments_custom_post_type' ) ) {

	class OVA_Apartments_custom_post_type{

		public function __construct(){
			add_action( 'init', array( $this, 'ova_register_cpt' ) );	
			add_action( 'init', array( $this, 'remove_featured_image_support' ) );
			add_action( 'add_meta_boxes', array( $this, 'remove_featured_image_metabox' ), 20 );
			add_action( 'do_meta_boxes', array( $this, 'add_gallery_meta_box' ) );
			add_action( 'save_post', array( $this, 'save_apartment_gallery' ) );
			add_action( 'cmb2_admin_init', array( $this, 'register_apartment_metabox' ) );
			add_action( 'cmb2_admin_init', array( $this, 'register_taxonomy_metabox' ) );
		}
		
		function ova_register_cpt() {

			$labels = array(
				'name'                  => _x( 'Apartments', 'Post Type General Name', 'ova-framework' ),
				'singular_name'         => _x( 'Apartment', 'Post Type Singular Name', 'ova-framework' ),
				'menu_name'             => __( 'Apartment', 'ova-framework' ),
				'name_admin_bar'        => __( 'Apartment', 'ova-framework' ),
				'archives'              => __( 'Item Archives', 'ova-framework' ),
				'attributes'            => __( 'Item Attributes', 'ova-framework' ),
				'parent_item_colon'     => __( 'Parent Item:', 'ova-framework' ),
				'all_items'             => __( 'All Apartments', 'ova-framework' ),
				'add_new_item'          => __( 'Add New Apartment', 'ova-framework' ),
				'add_new'               => __( 'Add New', 'ova-framework' ),
				'new_item'              => __( 'New Item', 'ova-framework' ),
				'edit_item'             => __( 'Edit Apartment', 'ova-framework' ),
				'view_item'             => __( 'View Item', 'ova-framework' ),
				'view_items'            => __( 'View Items', 'ova-framework' ),
				'search_items'          => __( 'Search Item', 'ova-framework' ),
				'not_found'             => __( 'Not found', 'ova-framework' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'ova-framework' ),
			);

			$args = array(
				'description'         => __( 'Post Type Description', 'ova-framework' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'thumbnail' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'menu_position'       => 5,
				'query_var'           => true,
				'has_archive'         => true,
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'rewrite'             => array( 'slug' => _x( 'ova_apartments', 'URL slug', 'ova-framework' ) ),
				'capability_type'     => 'post',
				'menu_icon'           => 'dashicons-building'
			);

			register_post_type( 'ova_apartments', $args );


			$labels_cat = array(
				'name'                       => _x( 'Categories Apartment', 'Post Category General Name', 'ova-framework' ),
				'singular_name'              => _x( 'Category', 'Post Category Singular Name', 'ova-framework' ),
				'menu_name'                  => __( 'Categories', 'ova-framework' ),
				'all_items'                  => __( 'All Categoies', 'ova-framework' ),
				'parent_item'                => __( 'Parent Item', 'ova-framework' ),
				'parent_item_colon'          => __( 'Parent Item:', 'ova-framework' ),
				'new_item_name'              => __( 'New Item Name', 'ova-framework' ),
				'add_new_item'               => __( 'Add New Category', 'ova-framework' ),
				'add_new'                    => __( 'Add New Category', 'ova-framework' ),
				'edit_item'                  => __( 'Edit Category', 'ova-framework' ),
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
			$args_cat = array(
				'labels'            => $labels_cat,
				'hierarchical'      => true,
				'publicly_queryable' => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => false,
				'rewrite'           => true,
			);
			register_taxonomy( 'category', array( 'ova_apartments' ), $args_cat );

			$labels_features = array(
				'name'                       => _x( 'Features Apartment', 'Post Type General Name', 'ova-framework' ),
				'singular_name'              => _x( 'Features', 'Post Type Singular Name', 'ova-framework' ),
				'menu_name'                  => __( 'Features Apartment', 'ova-framework' ),
				'all_items'                  => __( 'All Features Apartment', 'ova-framework' ),
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
					'slug'       => _x( 'features_apartment','Apartment Slug', 'ova-framework' ),
					'with_front' => false,
					'feeds'      => true,
				),
			);
			register_taxonomy( 'features_apartment', array( 'ova_apartments' ), $args_features );
		}

		function remove_featured_image_support() {
			remove_post_type_support('ova_apartments', 'thumbnail');
		}

		function remove_featured_image_metabox() {
			remove_meta_box('postimagediv', 'ova_apartments', 'side');
		}

		function add_gallery_meta_box() {
			add_meta_box(
				'apartment_gallery_box',
				__('Apartment Gallery', 'ova-framework'),
				array($this, 'render_gallery_box'),
				'ova_apartments',
				'side',
				'low'
			);
		}

		function render_gallery_box($post) {
			wp_nonce_field('apartment_gallery', 'apartment_gallery_nonce');
			$gallery_ids = get_post_meta($post->ID, 'apartment_gallery_ids', true);
			?>
			<div class="apartment-gallery-box">
				<div class="gallery-preview">
					<?php 
					if (!empty($gallery_ids)) {
						$ids = explode(',', $gallery_ids);
						foreach ($ids as $id) {
							$image = wp_get_attachment_image($id, 'thumbnail');
							if ($image) {
								echo '<div class="gallery-image" data-id="' . esc_attr($id) . '">';
								echo $image;
								echo '<button type="button" class="remove-image dashicons dashicons-no-alt"></button>';
								echo '</div>';
							}
						}
					}
					?>
				</div>
				<input type="hidden" name="apartment_gallery_ids" id="apartment_gallery_ids" value="<?php echo esc_attr($gallery_ids); ?>">
				<p class="hide-if-no-js">
					<button type="button" class="button<?php echo empty($gallery_ids) ? ' button-primary' : ''; ?>" id="apartment_gallery_button">
						<?php echo empty($gallery_ids) ? __('Add Gallery', 'ova-framework') : __('Edit Gallery', 'ova-framework'); ?>
					</button>
				</p>
			</div>

			<style>
				.apartment-gallery-box .gallery-preview {
					display: grid;
					grid-template-columns: repeat(2, 1fr);
					gap: 5px;
					margin-bottom: 10px;
				}
				.apartment-gallery-box .gallery-image {
					position: relative;
				}
				.apartment-gallery-box .gallery-image img {
					width: 100%;
					height: auto;
					display: block;
				}
				.apartment-gallery-box .remove-image {
					position: absolute;
					top: 0;
					right: 0;
					background: rgba(0,0,0,0.6);
					color: #fff;
					padding: 0;
					border: none;
					cursor: pointer;
					display: none;
				}
				.apartment-gallery-box .gallery-image:hover .remove-image {
					display: block;
				}
			</style>

			<script>
			jQuery(document).ready(function($) {
				var frame;
				var $galleryBox = $('.apartment-gallery-box');
				var $galleryIds = $('#apartment_gallery_ids');
				var $preview = $galleryBox.find('.gallery-preview');
				var $button = $('#apartment_gallery_button');

				function updateGallery() {
					var ids = [];
					$preview.find('.gallery-image').each(function() {
						ids.push($(this).data('id'));
					});
					$galleryIds.val(ids.join(','));
					$button.toggleClass('button-primary', ids.length === 0);
					$button.text(ids.length === 0 ? '<?php _e("Add Gallery", "ova-framework"); ?>' : '<?php _e("Edit Gallery", "ova-framework"); ?>');
				}

				$button.on('click', function(e) {
					e.preventDefault();

					if (frame) {
						frame.open();
						return;
					}

					frame = wp.media({
						state: 'gallery-edit',
						frame: 'post',
						multiple: true,
						selection: new wp.media.model.Selection($galleryIds.val().split(','), {
							multiple: true
						})
					});

					frame.on('update', function(selection) {
						var preview = '';
						selection.each(function(attachment) {
							preview += '<div class="gallery-image" data-id="' + attachment.id + '">';
							preview += '<img src="' + attachment.get('sizes').thumbnail.url + '" alt="">';
							preview += '<button type="button" class="remove-image dashicons dashicons-no-alt"></button>';
							preview += '</div>';
						});
						$preview.html(preview);
						updateGallery();
					});

					frame.open();
				});

				$preview.on('click', '.remove-image', function(e) {
					e.preventDefault();
					$(this).closest('.gallery-image').remove();
					updateGallery();
				});
			});
			</script>
			<?php
		}

		function save_apartment_gallery($post_id) {
			if (!isset($_POST['apartment_gallery_nonce']) || 
				!wp_verify_nonce($_POST['apartment_gallery_nonce'], 'apartment_gallery')) {
				return;
			}

			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}

			if (isset($_POST['apartment_gallery_ids'])) {
				update_post_meta($post_id, 'apartment_gallery_ids', sanitize_text_field($_POST['apartment_gallery_ids']));
			}
		}

		public function register_apartment_metabox() {
			$prefix = 'ova_apartment_';

			$cmb = new_cmb2_box(array(
				'id'            => $prefix . 'metabox',
				'title'         => esc_html__('Apartment Details', 'ova-framework'),
				'object_types'  => array('ova_apartments'),
				'context'       => 'normal',
				'priority'      => 'high',
			));

			$cmb->add_field(array(
                'name'       => esc_html__('Titulo secundario', 'ova-framework'),
                'id'         => $prefix . 'secondary_title',
                'type'       => 'text',
            ));

			$cmb->add_field( array(
				'name'       => esc_html__( 'Floor', 'ova-framework' ),
				'id'         => $prefix . 'floor',
				'type'    => 'text',
				'attributes' => array(
					'type' => 'number',
				),
			) );

			$cmb->add_field( array(
				'name'       => esc_html__( 'BedRooms', 'ova-framework' ),
				'id'         => $prefix . 'bedrooms',
				'type'    => 'text',
				'attributes' => array(
					'type' => 'number',
				),
			) );
		   

			$cmb->add_field( array(
				'name'       => esc_html__( 'Area(M2)', 'ova-framework' ),
				'id'         => $prefix . 'area',
				'type'    => 'text',
				'attributes' => array(
					'type' => 'number',
				),
			) );

			$cmb->add_field( array(
				'name'       => esc_html__( 'Price(M)', 'ova-framework' ),
				'id'         => $prefix . 'price',
				'type'    => 'text',
				'attributes' => array(
					'type' => 'number',
				),
			) );

			$cmb->add_field( array(
				'name'       => esc_html__( 'Total($)', 'ova-framework' ),
				'id'         => $prefix . 'total',
				'type'    => 'text',
				'attributes' => array(
					'type' => 'number',
				),
			) );

			$cmb->add_field( array(
				'name'       => esc_html__( 'Date', 'ova-framework' ),
				'id'         => $prefix . 'date',
				'type'    => 'text_date',
			) );

			$cmb->add_field( array(
				'name'    => esc_html__( 'Image Popup', 'ova-framework' ),
				'desc'    => esc_html__( 'Upload Image Popup', 'ova-framework' ),
				'id'      => $prefix . 'image_popup',
				'type'    => 'file',
				// Optional:
				'options' => array(
					'url' => false, // Hide the text input for the url
				),
				'text'    => array(
					'add_upload_file_text' => 'Add Image Popup' 
				),
				// query_args are passed to wp.media's library query.
				'query_args' => array(
					// Only allow gif, jpg, or png images
					'type' => array(
						'image/gif',
						'image/jpeg',
						'image/png',
					),
				),
				'preview_size' => 'medium', // Image size to use when previewing in the admin.
			) );

			$cmb->add_field( array(
				'name' => esc_html__( 'URL Send Request', 'ova-framework' ),
				'desc'    => esc_html__( 'URL Send Request Button', 'ova-framework' ),
				'id'   =>  $prefix . 'url_send_request',
				'type' => 'text_url',
				// 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
			) );

			$cmb->add_field( array(
				'name'    => esc_html__( 'File Layout', 'ova-framework' ),
				'desc'    => esc_html__('Upload File For Download Layout','ova-framework'),
				'id'      =>  $prefix . 'file_layout',
				'type'    => 'file',
				// Optional:
				'options' => array(
					'url' => false, // Hide the text input for the url
				),
				'text'    => array(
					'add_upload_file_text' => 'Add File' 
				),
				// query_args are passed to wp.media's library query.
				'query_args' => array(
					'type' => 'application/pdf', // Make library only display PDFs.
					// Or only allow gif, jpg, or png images
					// 'type' => array(
					//     'image/gif',
					//     'image/jpeg',
					//     'image/png',
					// ),
				),
				'preview_size' => 'medium', // Image size to use when previewing in the admin.
			) );


			$group_field_id = $cmb->add_field( array(
				'id'          => 'wiki_test_repeat_group',
				'type'        => 'group',
				'name'       => esc_html__( 'Utilities', 'ova-framework' ),
				// 'repeatable'  => false, // use false if you want non-repeatable group
				'options'     => array(
					// 'group_title'       => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
					'add_button'        => __( 'Add Another Entry', 'cmb2' ),
					'remove_button'     => __( 'Remove Entry', 'cmb2' ),
					'sortable'          => true,
					// 'closed'         => true, // true to have the groups closed by default
					// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
				),
			) );


			$cmb->add_group_field( $group_field_id, array(
				'name'      => esc_html__( 'Icon Class', 'ova-framework' ),
				'id'   => 'social',
				'type' => 'text',
				// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			) );

			$cmb->add_field(array(
				'name'       => esc_html__('Dirección', 'ova-framework'),
				'id'         => $prefix . 'direccion',
				'type'       => 'text',
			));

			$cmb->add_field(array(
				'name'       => esc_html__('Locación', 'ova-framework'),
				'id'         => $prefix . 'location',
				'type'       => 'text',
			));

			$cmb->add_field(array(
				'name'       => esc_html__('Price', 'ova-framework'),
				'id'         => $prefix . 'price',
				'type'       => 'text',
			));

			$cmb->add_field(array(
				'name'       => esc_html__('Régimen', 'ova-framework'),
				'id'         => $prefix . 'regimen',
				'type'       => 'text',
			));

			$cmb->add_field(array(
				'name'       => esc_html__('Precio', 'ova-framework'),
				'id'         => $prefix . 'precio',
				'type'       => 'text',
			));

			$cmb->add_field(array(
				'name'       => esc_html__('Dirección 2', 'ova-framework'),
				'id'         => $prefix . 'direccion_2',
				'type'       => 'text',
			));

			$cmb->add_field(array(
				'name'       => esc_html__('Estado', 'ova-framework'),
				'id'         => $prefix . 'estado',
				'type'       => 'text',
			));

			$cmb->add_field(array(
				'name'       => esc_html__('Habitaciones', 'ova-framework'),
				'id'         => $prefix . 'habitaciones',
				'type'       => 'text',
			));

			$cmb->add_field(array(
				'name'       => esc_html__('Tamaño', 'ova-framework'),
				'id'         => $prefix . 'tamano',
				'type'       => 'text',
			));

			$cmb->add_field(array(
				'name'       => esc_html__('Año Edificación', 'ova-framework'),
				'id'         => $prefix . 'ano_edificacion',
				'type'       => 'text',
			));

			$cmb->add_field(array(
				'name'       => esc_html__('Rooms', 'ova-framework'),
				'id'         => $prefix . 'rooms',
				'type'        => 'post_search_text',
				'post_type'   => 'ova_room',
				'field_type'  => 'select_advanced',
				'placeholder' => 'Select a page',
				'select_behavior' => 'replace',
				'query_args'  => [
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
				],
			));
		}

		public function register_taxonomy_metabox() {
			// Feature taxonomy metabox
			$feature_prefix = 'ova_feature_';
			$cmb_feature = new_cmb2_box(array(
				'id'               => $feature_prefix . 'term_edit',
				'title'           => esc_html__('Feature Category Settings', 'ova-framework'),
				'object_types'     => array('term'),
				'taxonomies'       => array('features_apartment'),
			));

			$cmb_feature->add_field(array(
				'name'    => esc_html__('Feature Icon', 'ova-framework'),
				'desc'    => esc_html__('Upload an icon for this feature category', 'ova-framework'),
				'id'      => $feature_prefix . 'icon',
				'type'    => 'file',
				'options' => array(
					'url' => false,
				),
				'text'    => array(
					'add_upload_file_text' => 'Add Icon'
				),
				'query_args' => array(
					'type' => array(
						'image/gif',
						'image/jpeg',
						'image/png',
					),
				),
				'preview_size' => 'thumbnail',
			));

			// Category taxonomy metabox
			$category_prefix = 'ova_category_';
			$cmb_category = new_cmb2_box(array(
				'id'               => $category_prefix . 'term_edit',
				'title'           => esc_html__('Category Settings', 'ova-framework'),
				'object_types'     => array('term'),
				'taxonomies'       => array('category'),
			));

			$cmb_category->add_field(array(
				'name'    => esc_html__('Category Icon', 'ova-framework'),
				'desc'    => esc_html__('Upload an icon for this category', 'ova-framework'),
				'id'      => $category_prefix . 'icon',
				'type'    => 'file',
				'options' => array(
					'url' => false,
				),
				'text'    => array(
					'add_upload_file_text' => 'Add Icon'
				),
				'query_args' => array(
					'type' => array(
						'image/gif',
						'image/jpeg',
						'image/png',
					),
				),
				'preview_size' => 'thumbnail',
			));
		}
	}


	new OVA_Apartments_custom_post_type();
}