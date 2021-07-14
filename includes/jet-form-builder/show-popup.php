<?php


namespace Jet_Forms_PN\Jet_Form_Builder;


use Jet_Form_Builder\Actions\Action_Handler;
use Jet_Form_Builder\Actions\Types\Base;
use Jet_Form_Builder\Exceptions\Action_Exception;
use Jet_Forms_PN\Helpers\Providers_Manager;
use Jet_Forms_PN\Plugin;

class Show_Popup extends Base {

	public function get_id() {
		return 'popup_after_submit';
	}

	public function get_name() {
		return __( 'Show Popup', 'jet-forms-popup-notification' );
	}

	public function visible_attributes_for_gateway_editor() {
		return array( 'provider', 'popup' );
	}

	/**
	 * @param array $request
	 * @param Action_Handler $handler
	 *
	 * @return mixed|void
	 * @throws Action_Exception
	 */
	public function do_action( array $request, Action_Handler $handler ) {
		if ( empty( $this->settings )
		     || empty( $this->settings['popup'] )
		     || empty( $this->settings['provider'] )
		) {
			throw new Action_Exception( 'Please configure Show popup action' );
		}

		$handler->add_response( array(
			'popup_data' => $this->settings
		) );
	}

	public function self_script_name() {
		return 'JetShowPopupAction';
	}

	public function editor_labels() {
		return array(
			'provider' => __( 'Select provider', 'jet-forms-popup-notification' ),
			'popup'    => __( 'Select popup', 'jet-forms-popup-notification' )
		);
	}

	public function action_data() {
		return array(
			'providers'   => Providers_Manager::get_providers(),
			'ajax_action' => Plugin::instance()->ajax->action
		);
	}
}