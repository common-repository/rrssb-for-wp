<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.codigitus.com
 * @since      1.0.0
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     Fede Gómez <hola@codigitus.com>
 */
class Rrssb_For_Wp_Public {
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
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/*
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rrssb_For_Wp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rrssb_For_Wp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		global $post;
		if (Rrssb_For_Wp_Buttons::show_buttons($post->ID, $this->plugin_name)) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rrssb.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		global $post;

		if (Rrssb_For_Wp_Buttons::show_buttons($post->ID, $this->plugin_name)) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rrssb-for-wp-public.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name . '-buttons', plugin_dir_url( __FILE__ ) . 'js/rrssb.min.js', array( 'jquery' ), $this->version, false );

			$data = array(
				'title' => $post->post_title,
				'url'   => get_permalink(),
				'description' => $post->post_title
			);

			wp_localize_script( $this->plugin_name, 'rrssb_vars', $data );
		}
	}

	public function get_buttons( $content ) {
		global $post;
		$settings = get_option( $this->plugin_name );

		$buttons_list = new Rrssb_For_Wp_Buttons( 'active', $settings['buttons'] );
		$buttons      = '<ul class="rrssb-buttons">' . $buttons_list->make_list_buttons() . '</ul>';

		if (Rrssb_For_Wp_Buttons::show_buttons($post->ID, $this->plugin_name)) {
			if ( $settings['show_in'] == 'top' || $settings['show_in'] == 'top-and-bottom' ) {
				$content = apply_filters( 'rrssb_for_wp_top_html', $buttons ) . $content;
			}

			if ( $settings['show_in'] == 'bottom' || $settings['show_in'] == 'top-and-bottom' ) {
				$content .= apply_filters( 'rrssb_for_wp_bottom_html', $buttons );
			}
		}

		return $content;
	}
}
