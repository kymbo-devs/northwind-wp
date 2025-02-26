<?php if (!defined( 'ABSPATH' )) exit;

if( !class_exists('Moore_Cmb2_Customize') ){
	
	class Moore_Cmb2_Customize {

		public function __construct() {
			
			// Return HTML for Header
			add_filter( 'cmb2_admin_init', array( $this, 'moore_cmb2_add_setting' ) );

	    }
		

		function moore_cmb2_add_setting(){

			$cmb = new_cmb2_box( array(
				'id'           => 'cmb2_text_email_metabox',
				'title'        => 'Person Information',
				'object_types' => array( 'post' ),
			) );

			$cmb->add_field( array(
				'name' => 'Email',
				'id'   => '_cmb2_person_email',
				'type' => 'text_email',
				'desc' => 'Invalid email addresses will be wiped out.',
			) );

		}
		


	}
}

new Moore_Cmb2_Customize();

