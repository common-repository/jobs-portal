<?php
/*
 * Plugin Name: Jobs Portal - Job & Career Manager
 * Description: A powerful and robust plugin to create and manage job portal on your WordPress website where recruiter can post job requirements. Also, applicants can filter jobs and apply to a job in an easy and elegant way.
 * Version: 3.7
 * Author: Weblizar
 * Author URI: https://weblizar.com/
 * Plugin URI: https://wordpress.org/plugins/jobs-portal/
 * Text Domain: WEBLIZAR_DOMAIN
 */
defined('ABSPATH') || die();

if (!defined('WEBLIZAR_DOMAIN')) {
	define('WEBLIZAR_DOMAIN', 'WEBLIZAR');
}

if (!defined('WEBLIZAR_PLUGIN_URL')) {
	define('WEBLIZAR_PLUGIN_URL', plugin_dir_url(__FILE__));
}

if (!defined('WEBLIZAR_PLUGIN_DIR_PATH')) {
	define('WEBLIZAR_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}

if (!defined('WEBLIZAR_PLUGIN_BASE_NAME')) {
	define('WEBLIZAR_PLUGIN_BASE_NAME', plugin_basename(__FILE__));
}

final class Weblizar_Jobs_Portal
{
	private static $instance = null;

	private function __construct()
	{
		$this->initialize_hooks();
		$this->setup_database();
	}

	public static function get_instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function initialize_hooks()
	{
		if (is_admin()) {
			require_once WEBLIZAR_PLUGIN_DIR_PATH . 'admin/admin.php';
		}
		require_once WEBLIZAR_PLUGIN_DIR_PATH . 'public/public.php';
	}

	private function setup_database()
	{
		require_once WEBLIZAR_PLUGIN_DIR_PATH . 'admin/inc/Weblizar_Database.php';
		register_activation_hook(__FILE__, array('Weblizar_Database', 'activation'));
	}
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'ismb_page_pro_link');
function ismb_page_pro_link($links)
{
	$links[] = '<a href="' . ('https://weblizar.com/plugins/jobs-portal-pro/') . '" style="color:green;"> ' . __('Get Pro') . '</a>';
	return $links;
}

Weblizar_Jobs_Portal::get_instance();
