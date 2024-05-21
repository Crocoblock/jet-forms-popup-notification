(
	function ( $ ) {
		const source = window.JetFormPopupActionData;

		function onAjaxSubmitSuccess( event, response, form, request ) {
			if ( typeof response.popup_data === 'undefined' ) {
				return;
			}
			showPopup( response.popup_data );
		}

		function triggerPopup( callback, hookName = '', is_reload = false ) {
			if ( is_reload && hookName ) {
				jQuery( window ).on( hookName, callback );
			} else {
				callback();
			}
		}

		function showPopup( popup_data, is_reload = false ) {
			const provider = popup_data.provider;
			let popupId = popup_data.popup;

			if ( provider === source.jet_popup ) {
				popupId = 'jet-popup-' + popupId;

				if ( 'object' === typeof props &&
					props?.settings?.[ 'jet-popup-id' ] !== popupId
				) {
					return;
				}
				jQuery( window ).trigger( {
					type: 'jet-popup-open-trigger',
					popupData: { popupId },
				} );
			} else if ( provider === source.elementor_pro ) {
				const callback = () => {
					setTimeout( () => {
						if ( typeof elementorProFrontend === 'undefined' ) {
							return;
						}

						elementorProFrontend.modules.popup.showPopup(
							{ id: popupId },
						);
					}, 500 );
				};

				triggerPopup( callback, 'elementor/frontend/init', is_reload );
			}
		}

		$( document ).on( 'jet-engine/form/ajax/on-success', onAjaxSubmitSuccess );
		$( document ).on( 'jet-form-builder/ajax/on-success', onAjaxSubmitSuccess );

		$( function () {
			if ( source.data ) {
				showPopup( source.data, true );
			}
		} );
	}
)( jQuery );