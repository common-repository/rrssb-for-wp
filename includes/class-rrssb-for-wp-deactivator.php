<?php

/**
 * Fired during plugin deactivation.
 *
 * @link       http://www.codigitus.com
 * @since      1.0.0
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 *
 * @author     Fede Gómez <hola@codigitus.com>
 */
class Rrssb_For_Wp_Deactivator
{
    /**
     * Delete settings
     *
     * @since    1.0.0
     */
    public static function deactivate()
    {
        delete_option('rrssb-for-wp');
    }
}
