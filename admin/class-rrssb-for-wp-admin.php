<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.codigitus.com
 * @since      1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     Fede Gómez <hola@codigitus.com>
 */
class Rrssb_For_Wp_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__).'css/rrssb-for-wp-admin.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name.'-buttons', plugin_dir_url(__FILE__).'../public/css/rrssb.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__).'js/rrssb-for-wp-admin.js', array('jquery', 'jquery-ui-droppable', 'jquery-ui-draggable', 'jquery-ui-sortable'), $this->version, false);
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu()
    {
        add_options_page(__('Ajustes de RRSSB para WP', $this->plugin_name), __('RRSSB para WP', $this->plugin_name),
            'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'));
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */
    public function add_action_links($links)
    {
        $settings_link = array(
            '<a href="'.admin_url('options-general.php?page='.$this->plugin_name).'">'.__('Ajustes',
                $this->plugin_name).'</a>',
        );

        return array_merge($settings_link, $links);
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_setup_page()
    {
        include_once 'partials/rrssb-for-wp-admin-display.php';
    }

    /**
     * Register the settings for this plugin.
     *
     * @since    1.0.0
     */
    public function options_update()
    {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

    /**
     * Clean the settings values for this plugin.
     *
     * @since    1.0.0
     *
     * @param $input
     *
     * @return array
     */
    public function validate($input)
    {
        $valid = array();
        $delete_strings = array('rrssb-', ' ui-sortable-handle');
        $clean_buttons = str_replace($delete_strings, '', $input['buttons']);
        $valid['buttons'] = $clean_buttons;
        foreach (get_post_types(['public' => true]) as $post_type) {
            if ($input['visibility'][$post_type] == 1) {
                $valid['visibility'][] = $post_type;
            }
        }
        $valid['show_in'] = $input['show_in'];
        $valid['exclude_ids'] = filter_var($input['exclude_ids'], FILTER_SANITIZE_NUMBER_FLOAT,
FILTER_FLAG_ALLOW_THOUSAND);

        return $valid;
    }
}
