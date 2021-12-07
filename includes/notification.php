<?php


namespace Jet_Forms_PN;

use Jet_Forms_PN\Helpers\Providers_Manager;


class Notification
{
    public $slug = 'popup_after_submit';
    public $plugin;

    public function __construct( ) {
        $this->plugin = Plugin::instance();
        $this->hooks();
    }

    public function hooks() {
        add_action(
            'jet-engine/forms/editor/before-assets',
            array( $this, 'assets' )
        );
        add_filter(
            'jet-engine/forms/booking/notification-types',
            array( $this, 'register_notification' )
        );
        add_action(
            'jet-engine/forms/booking/notifications/fields-after',
            array( $this, 'notification_fields' )
        );
        add_action(
        	"jet-engine/forms/booking/notification/{$this->slug}",
	        array( $this, 'do_notification' ),
	        10, 2
        );
    }

    public function do_notification( $notification, $handler ) {
	    $handler->log[] = true;

	    add_filter(
		    'jet-engine/forms/handler/query-args',
		    array( $this, 'insert_popup_data' ), 0, 3
	    );
    }

    public function insert_popup_data( $query_args, $args, $handler ) {
    	if ( $handler->notifcations ) {
		    $notifications = $handler->notifcations->get_all();
	    } else {
		    $notifications = $handler->manager->editor->get_notifications( $handler->form );
	    }
    	
        foreach ( $notifications as $notification ) {
            if ( $this->check_notification_data( $notification ) ) {
                $query_args['popup_data'] = $notification['popup'];
            }
        }
        return $query_args;
    }

    public function check_notification_data( $notification ) {
        return (
            $notification['type'] === $this->slug &&
            ! empty( $notification['popup'] ) &&
            ! empty( $notification['popup']['popup'] ) &&
            ! empty( $notification['popup']['provider'] )
        );
    }

    /**
     * Register new notification type
     *
     * @return [type] [description]
     */
    public function register_notification( $notifications ) {
        $notifications[ $this->slug ] = __( 'Show Popup' );
        return $notifications;
    }

    public function notification_fields() {

        $type_slug = $this->slug;
        $providers = Providers_Manager::get_providers();

        if ( empty( $providers ) ) {
            $providers = '[]';
        } else {
            $providers = htmlspecialchars( json_encode( $providers ) );
        }

        include $this->plugin->get_template_path( 'notification-fields' );
    }

    /**
     * Register notification assets
     * @return [type] [description]
     */
    public function assets() {

        wp_enqueue_script(
            $this->plugin->slug,
            $this->plugin->url_assets_js( 'admin/form-popup-notification' ),
            array( 'wp-api-fetch' ),
            $this->plugin->get_version(),
            true
        );

        wp_enqueue_style(
            $this->plugin->slug,
            $this->plugin->url_assets_css( 'form-notification' ),
            array(),
            $this->plugin->get_version()
        );

        add_action( 'admin_footer', array( $this, 'notification_component_template' ) );

    }

    /**
     * Print notification component template
     *
     * @return [type] [description]
     */
    public function notification_component_template() {

        ob_start();
        include $this->plugin->get_template_path( 'notification-component' );
        $content = ob_get_clean();

        printf(
            '<script type="text/x-template" id="jet-forms-popup-notification">%s</script>',
            $content
        );

    }

}