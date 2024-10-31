<?php

/**
 * Fired during plugin activation.
 *
 * @link       http://www.codigitus.com
 * @since      1.0.0
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 *
 * @author     Fede Gómez <hola@codigitus.com>
 */
class Rrssb_For_Wp_Activator
{
    /**
     * Insert into the database default settings 
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        if (get_option('rrssb-for-wp') === false) {
            update_option('rrssb-for-wp', [
                    'buttons' => 'twitter,facebook,googleplus,linkedin',
                    'visibility' => ['post'],
                    'show_in' => 'top',
                    'exclude_ids' => '',
                ], 'yes');
        }
    }
}
