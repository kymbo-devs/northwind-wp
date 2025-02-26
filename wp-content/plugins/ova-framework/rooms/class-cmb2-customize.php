<?php if (!defined( 'ABSPATH' )) exit;

if( !class_exists('Moore_Cmb2_Customize') ){
    
    class Moore_Cmb2_Customize {

        public function __construct() {

            add_action( 'cmb2_init', array( $this, 'ova_moore_cmb2_customize' ) );
            add_action( 'init', array( $this, 'remove_featured_image_support' ) );
			add_action( 'add_meta_boxes', array( $this, 'remove_featured_image_metabox' ), 20 );
			add_action( 'do_meta_boxes', array( $this, 'add_gallery_meta_box' ) );
			add_action( 'save_post', array( $this, 'save_room_gallery' ) );
        }

        public function ova_moore_cmb2_customize( $atts ){

            // Start with an underscore to hide fields from custom fields list
            $prefix = 'ova_moore';
            
            $rooms_settings = new_cmb2_box( array(
                'id'            => 'ova_moore_room_settings',
                'title'         => esc_html__( 'Room settings', 'ova-framework' ),
                'object_types'  => array( 'ova_room'), // Post type
                'context'       => 'normal',
                'priority'      => 'high',
                'show_names'    => true,
                
            ) );

            $rooms_settings->add_field(array(
                'name'       => esc_html__('Titulo secundario', 'ova-framework'),
                'id'         => $prefix . 'secondary_title',
                'type'       => 'text',
            ));

                $rooms_settings->add_field( array(
                    'name'       => esc_html__( 'Floor', 'ova-framework' ),
                    'id'         => $prefix . 'floor',
                    'type'    => 'text',
                    'attributes' => array(
                        'type' => 'number',
                    ),
                ) );

                $rooms_settings->add_field( array(
                    'name'       => esc_html__( 'BedRooms', 'ova-framework' ),
                    'id'         => $prefix . 'bedrooms',
                    'type'    => 'text',
                    'attributes' => array(
                        'type' => 'number',
                    ),
                ) );
               

                $rooms_settings->add_field( array(
                    'name'       => esc_html__( 'Area(M2)', 'ova-framework' ),
                    'id'         => $prefix . 'area',
                    'type'    => 'text',
    				'attributes' => array(
    					'type' => 'number',
    				),
                ) );

                $rooms_settings->add_field( array(
                    'name'       => esc_html__( 'Price(M)', 'ova-framework' ),
                    'id'         => $prefix . 'price',
                    'type'    => 'text',
    				'attributes' => array(
    					'type' => 'number',
    				),
                ) );

                $rooms_settings->add_field( array(
                    'name'       => esc_html__( 'Total($)', 'ova-framework' ),
                    'id'         => $prefix . 'total',
                    'type'    => 'text',
    				'attributes' => array(
    					'type' => 'number',
    				),
                ) );

                $rooms_settings->add_field( array(
                    'name'       => esc_html__( 'Date', 'ova-framework' ),
                    'id'         => $prefix . 'date',
                    'type'    => 'text_date',
                ) );

                $rooms_settings->add_field( array(
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

                $rooms_settings->add_field( array(
                    'name' => esc_html__( 'URL Send Request', 'ova-framework' ),
                    'desc'    => esc_html__( 'URL Send Request Button', 'ova-framework' ),
                    'id'   =>  $prefix . 'url_send_request',
                    'type' => 'text_url',
                    // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
                ) );

                $rooms_settings->add_field( array(
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


                $group_field_id = $rooms_settings->add_field( array(
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


                $rooms_settings->add_group_field( $group_field_id, array(
                    'name'      => esc_html__( 'Icon Class', 'ova-framework' ),
                    'id'   => 'social',
                    'type' => 'text',
                    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
                ) );

                $rooms_settings->add_field(array(
                    'name'       => esc_html__('Dirección', 'ova-framework'),
                    'id'         => $prefix . 'direccion',
                    'type'       => 'text',
                ));

                $rooms_settings->add_field(array(
                    'name'       => esc_html__('Locación', 'ova-framework'),
                    'id'         => $prefix . 'location',
                    'type'       => 'text',
                ));
    
                $rooms_settings->add_field(array(
                    'name'       => esc_html__('Price', 'ova-framework'),
                    'id'         => $prefix . 'price',
                    'type'       => 'text',
                ));
    
                $rooms_settings->add_field(array(
                    'name'       => esc_html__('Régimen', 'ova-framework'),
                    'id'         => $prefix . 'regimen',
                    'type'       => 'text',
                ));
    
                $rooms_settings->add_field(array(
                    'name'       => esc_html__('Precio', 'ova-framework'),
                    'id'         => $prefix . 'precio',
                    'type'       => 'text',
                ));
    
                $rooms_settings->add_field(array(
                    'name'       => esc_html__('Dirección 2', 'ova-framework'),
                    'id'         => $prefix . 'direccion_2',
                    'type'       => 'text',
                ));
    
                $rooms_settings->add_field(array(
                    'name'       => esc_html__('Estado', 'ova-framework'),
                    'id'         => $prefix . 'estado',
                    'type'       => 'text',
                ));
    
                $rooms_settings->add_field(array(
                    'name'       => esc_html__('Habitaciones', 'ova-framework'),
                    'id'         => $prefix . 'habitaciones',
                    'type'       => 'text',
                ));
    
                $rooms_settings->add_field(array(
                    'name'       => esc_html__('Tamaño', 'ova-framework'),
                    'id'         => $prefix . 'tamano',
                    'type'       => 'text',
                ));
    
                $rooms_settings->add_field(array(
                    'name'       => esc_html__('Año Edificación', 'ova-framework'),
                    'id'         => $prefix . 'ano_edificacion',
                    'type'       => 'text',
                ));
                
                $rooms_settings->add_field(array(
    				'name'       => esc_html__('Iframe mapa', 'ova-framework'),
    				'id'         => $prefix . 'iframe_mapa',
    				'type'       => 'textarea_code',
			    ));
    
                $rooms_settings->add_field(array(
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

        
		function remove_featured_image_support() {
			remove_post_type_support('ova_room', 'thumbnail');
		}

		function remove_featured_image_metabox() {
			remove_meta_box('postimagediv', 'ova_room', 'side');
		}

		function add_gallery_meta_box() {
			add_meta_box(
				'room_gallery_box',
				__('Room Gallery', 'ova-framework'),
				array($this, 'render_gallery_box'),
				'ova_room',
				'side',
				'low'
			);
		}

        function render_gallery_box($post) {
			wp_nonce_field('room_gallery', 'room_gallery_nonce');
			$gallery_ids = get_post_meta($post->ID, 'room_gallery_ids', true);
			?>
			<div class="room-gallery-box">
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
				<input type="hidden" name="room_gallery_ids" id="room_gallery_ids" value="<?php echo esc_attr($gallery_ids); ?>">
				<p class="hide-if-no-js">
					<button type="button" class="button<?php echo empty($gallery_ids) ? ' button-primary' : ''; ?>" id="room_gallery_button">
						<?php echo empty($gallery_ids) ? __('Add Gallery', 'ova-framework') : __('Edit Gallery', 'ova-framework'); ?>
					</button>
				</p>
			</div>

			<style>
				.room-gallery-box .gallery-preview {
					display: grid;
					grid-template-columns: repeat(2, 1fr);
					gap: 5px;
					margin-bottom: 10px;
				}
				.room-gallery-box .gallery-image {
					position: relative;
				}
				.room-gallery-box .gallery-image img {
					width: 100%;
					height: auto;
					display: block;
				}
				.room-gallery-box .remove-image {
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
				.room-gallery-box .gallery-image:hover .remove-image {
					display: block;
				}
			</style>

			<script>
			jQuery(document).ready(function($) {
				var frame;
				var $galleryBox = $('.room-gallery-box');
				var $galleryIds = $('#room_gallery_ids');
				var $preview = $galleryBox.find('.gallery-preview');
				var $button = $('#room_gallery_button');

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

        function save_room_gallery($post_id) {
			if (!isset($_POST['room_gallery_nonce']) || 
				!wp_verify_nonce($_POST['room_gallery_nonce'], 'room_gallery')) {
				return;
			}

			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}

			if (isset($_POST['room_gallery_ids'])) {
				update_post_meta($post_id, 'room_gallery_ids', sanitize_text_field($_POST['room_gallery_ids']));
			}
		}


    }
}

return new Moore_Cmb2_Customize();

