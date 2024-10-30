<?php

defined( 'ABSPATH' ) || die();

class Weblizar_Shortcode {

	/**
	 * Add job_portal shortcode.
	 *
	 * @param array $attr
	 *
	 * @return void
	 */
	public static function job_portal( $attr ) {
		ob_start();
		require_once WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/views/weblizar_job_portal.php';

		return ob_get_clean();
	}

	/**
	 * Add job_portal_account shortcode.
	 *
	 * @param array $attr
	 *
	 * @return void
	 */
	public static function job_portal_account( $attr ) {
		ob_start();
		require_once WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/views/weblizar_job_portal_account.php';

		return ob_get_clean();
	}

	/**
	 * Enqueue shortcode assets.
	 *
	 * @return void
	 */
	public static function shortcode_assets() {
		 global $post;
		if ( is_a( $post, 'WP_Post' ) ) {
			if ( has_shortcode( $post->post_content, 'job_portal' ) || has_shortcode( $post->post_content, 'job_portal_account' ) ) {
				/* Enqueue styles */
				wp_enqueue_style( 'weblizar-bootstrap', WEBLIZAR_PLUGIN_URL . 'assets/css/bootstrap.css' );
				wp_enqueue_style( 'font-awesome-5', WEBLIZAR_PLUGIN_URL . 'assets/css/all.css' );
				wp_enqueue_style( 'toastr', WEBLIZAR_PLUGIN_URL . 'assets/css/toastr.css' );
				wp_enqueue_style( 'fSelect', WEBLIZAR_PLUGIN_URL . 'assets/css/fSelect.css' );
				wp_enqueue_style( 'weblizar-public', WEBLIZAR_PLUGIN_URL . 'assets/css/weblizar-public.css' );

				/* Enqueue scripts */
				wp_enqueue_script( 'jquery-form' );
				wp_enqueue_script( 'weblizar-popper', WEBLIZAR_PLUGIN_URL . 'assets/js/popper.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'weblizar-bootstrap-js', WEBLIZAR_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'toastr', WEBLIZAR_PLUGIN_URL . 'assets/js/toastr.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'weblizar-moment-js', WEBLIZAR_PLUGIN_URL . 'assets/js/moment.js', array(), '', true );
				wp_enqueue_script( 'fSelect', WEBLIZAR_PLUGIN_URL . 'assets/js/fSelect.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'weblizar-public-js', WEBLIZAR_PLUGIN_URL . 'assets/js/weblizar-public.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'weblizar-public-ajax-js', WEBLIZAR_PLUGIN_URL . 'assets/js/weblizar-public-ajax.js', array( 'jquery' ), true, true );
				wp_localize_script( 'weblizar-public-ajax-js', 'WEBLIZARAjax', array( 'security' => wp_create_nonce( 'weblizar' ) ) );
				wp_localize_script( 'weblizar-public-ajax-js', 'weblizarajaxurl', [esc_url( admin_url( 'admin-ajax.php' ) )] );
				wp_localize_script( 'weblizar-public-ajax-js', 'WEBLIZARAdminUrl', [admin_url()] );
			}
		}
	}
}
