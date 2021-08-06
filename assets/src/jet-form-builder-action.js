const { addFilter } = wp.hooks;
const { __ } = wp.i18n;
const {
		  SelectControl,
		  BaseControl,
	  } = wp.components;

const {
		  useState,
		  useEffect,
	  } = wp.element;

const { Tools: { withPlaceholder }, addAction } = JetFBActions;

addAction( 'popup_after_submit', function ShowPopupAction( props ) {

	const {
			  settings,
			  onChangeSetting,
			  source,
			  label,
		  } = props;

	const [ popups, setPopups ] = useState( [] );
	const [ isLoading, setLoading ] = useState( false );

	const fetchTypeFields = function( provider ) {
		if ( ! provider ) {
			return;
		}
		setLoading( true );

		jQuery.ajax( {
			url: ajaxurl,
			type: 'GET',
			dataType: 'json',
			data: {
				action: source.ajax_action,
				provider,
			},
		} ).done( function( response ) {
			if ( response.success && response.data.popups ) {
				setPopups( withPlaceholder( response.data.popups ) );
			}
		} ).fail( function( jqXHR, textStatus, errorThrown ) {
			console.log( textStatus, errorThrown );

		} ).always( function() {
			setLoading( false );
		} );
	};

	useEffect( () => {
		fetchTypeFields( settings.provider );
	}, [] );

	return <>
		<SelectControl
			label={ label( 'provider' ) }
			value={ settings.provider }
			onChange={ newValue => {
				onChangeSetting( newValue, 'provider' )
				fetchTypeFields( newValue );
			} }
			options={ withPlaceholder( source.providers ) }
			labelPosition='side'
		/>
		{ settings.provider && <div style={ { opacity: isLoading ? '0.5' : '1' } } className='jet-control-full'>
			<SelectControl
				label={ label( 'popup' ) }
				value={ settings.popup }
				onChange={ newValue => onChangeSetting( newValue, 'popup' ) }
				options={ popups }
				labelPosition='side'
				disabled={ isLoading }
			/>
		</div> }
	</>;
} )