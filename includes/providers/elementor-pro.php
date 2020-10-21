<?php

namespace Jet_Forms_PN\Providers;

class Elementor_Pro extends Provider_Base
{

    public function get_popups() {
        $query = new \WP_Query( $this->query_args_elementor() );

        $result = array();
        foreach ( $query->posts as $post ) {
            $result[ $post->ID ] = $post->post_title;
        }
        $this->popups = $result;

        return $this;
    }

    /**
     * Get args from
     * elementor-pro/modules/query-control:560
     * @return array
     */
    public function query_args_elementor() {
        return array(
            'post_status'   => array( 'publish', 'private' ),
            'meta_query'    => array(
                array(
                    'key'   => '_elementor_template_type',
                    'value' => 'popup',
                )
            ),
            'post_type'     => 'elementor_library',
            'orderby'       => 'meta_value',
            'order'         => 'ASC'
        );
    }

}