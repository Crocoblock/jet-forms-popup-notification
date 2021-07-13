<?php


namespace Jet_Forms_PN\Jet_Form_Builder;


class Action_Manager {

	public function __construct() {
		add_action(
			'jet-form-builder/actions/register',
			array( $this, 'register_actions' )
		);
		add_action(
			'jet-form-builder/editor-assets/before',
			array( $this, 'editor_assets' )
		);
	}

	public function register_actions( $manager ) {
		$manager->register_action_type( new Show_Popup() );
	}

	public function editor_assets() {
		wp_enqueue_script(
			'jet-forms-popup-notification-jfb-editor',
			JET_FORMS_POPUP_NOTIFICATION_URL . 'assets/js/builder.editor.js',
			array(),
			JET_FORMS_POPUP_NOTIFICATION_VERSION,
			true
		);
	}

}