<?php

defined( 'ABSPATH' ) || die();

require_once WEBLIZAR_PLUGIN_DIR_PATH . 'includes/Weblizar_Helper.php';

class Weblizar_Menu {
	/* Add menu */
	public static function create_menu() {
		$role_array = array( 'administrator', 'editor' );
		$user       = wp_get_current_user();
		$roles      = (array) $user->roles;
		$user_role  = $roles[0];
		if ( in_array( $user_role, $role_array ) ) {
			$dashboard = add_menu_page( esc_html__( 'Jobs Portal', WEBLIZAR_DOMAIN ), esc_html__( 'Jobs Portal', WEBLIZAR_DOMAIN ), $user_role, 'job_portal_dashboard', array( 'Weblizar_Menu', 'dashboard' ), 'dashicons-megaphone', 27 );
			add_action( 'admin_print_styles-' . $dashboard, array( 'Weblizar_Menu', 'dashboard_assets' ) );

			$dashboard_submenu = add_submenu_page( 'job_portal_dashboard', esc_html__( 'Dashboard', WEBLIZAR_DOMAIN ), esc_html__( 'Dashboard', WEBLIZAR_DOMAIN ), $user_role, 'job_portal_dashboard', array( 'Weblizar_Menu', 'dashboard' ) );
			add_action( 'admin_print_styles-' . $dashboard, array( 'Weblizar_Menu', 'dashboard_assets' ) );

			$jobs = add_submenu_page( 'job_portal_dashboard', esc_html__( 'All Jobs', WEBLIZAR_DOMAIN ), esc_html__( 'All Jobs', WEBLIZAR_DOMAIN ), $user_role, 'edit.php?post_type=job' );

			$jobs = add_submenu_page( 'job_portal_dashboard', esc_html__( 'Add New Job', WEBLIZAR_DOMAIN ), esc_html__( 'Add New', WEBLIZAR_DOMAIN ), $user_role, 'post-new.php?post_type=job' );

			$job_types = add_submenu_page( 'job_portal_dashboard', esc_html__( 'Job Types', WEBLIZAR_DOMAIN ), esc_html__( 'Job Types', WEBLIZAR_DOMAIN ), $user_role, 'edit-tags.php?taxonomy=job_type&post_type=job' );

			$industries = add_submenu_page( 'job_portal_dashboard', esc_html__( 'Industries', WEBLIZAR_DOMAIN ), esc_html__( 'Industries', WEBLIZAR_DOMAIN ), $user_role, 'edit-tags.php?taxonomy=industry&post_type=job' );

			$departments = add_submenu_page( 'job_portal_dashboard', esc_html__( 'Departments', WEBLIZAR_DOMAIN ), esc_html__( 'Departments', WEBLIZAR_DOMAIN ), $user_role, 'edit-tags.php?taxonomy=department&post_type=job' );

			$skills = add_submenu_page( 'job_portal_dashboard', esc_html__( 'Skills', WEBLIZAR_DOMAIN ), esc_html__( 'Skills', WEBLIZAR_DOMAIN ), $user_role, 'edit-tags.php?taxonomy=skill&post_type=job' );

			$job_locations = add_submenu_page( 'job_portal_dashboard', esc_html__( 'Job Locations', WEBLIZAR_DOMAIN ), esc_html__( 'Job Locations', WEBLIZAR_DOMAIN ), $user_role, 'edit-tags.php?taxonomy=job_location&post_type=job' );

			$settings = add_submenu_page( 'job_portal_dashboard', esc_html__( 'Settings', WEBLIZAR_DOMAIN ), esc_html__( 'Settings', WEBLIZAR_DOMAIN ), $user_role, 'job_portal_settings', array( 'Weblizar_Menu', 'settings' ) );
			add_action( 'admin_print_styles-' . $settings, array( 'Weblizar_Menu', 'settings_assets' ) );

			$go_to_pro = add_submenu_page( 'job_portal_dashboard', esc_html__( 'Go to pro', WEBLIZAR_DOMAIN ), esc_html__( 'Go to pro', WEBLIZAR_DOMAIN ), $user_role, 'go_to_pro', array( 'Weblizar_Menu', 'go_to_pro' ) );
			add_action( 'admin_print_styles-' . $go_to_pro, array( 'Weblizar_Menu', 'go_to_pro_assets' ) );

			$job_applications = add_submenu_page( 'edit.php?post_type=candidate', esc_html__( 'Job Applications', WEBLIZAR_DOMAIN ), esc_html__( 'Job Applications', WEBLIZAR_DOMAIN ), $user_role, 'job_applications', array( 'Weblizar_Menu', 'job_applications' ) );
			add_action( 'admin_print_styles-' . $job_applications, array( 'Weblizar_Menu', 'job_applications_assets' ) );
		}
	}

	/* Dashboard submenu */
	public static function dashboard() {
		require_once WEBLIZAR_PLUGIN_DIR_PATH . 'admin/inc/views/weblizar_dashboard.php';
	}

	/* Dashboard submenu assets */
	public static function dashboard_assets() {
		/* Enqueue styles */
		wp_enqueue_style( 'weblizar-bootstrap', WEBLIZAR_PLUGIN_URL . 'assets/css/bootstrap.css' );
		wp_enqueue_style( 'font-awesome-5', WEBLIZAR_PLUGIN_URL . 'assets/css/all.css' );
		wp_enqueue_style( 'weblizar-admin', WEBLIZAR_PLUGIN_URL . 'assets/css/weblizar-admin.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'weblizar-popper-js', WEBLIZAR_PLUGIN_URL . 'assets/js/popper.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'weblizar-bootstrap-js', WEBLIZAR_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'weblizar-admin-js', WEBLIZAR_PLUGIN_URL . 'assets/js/weblizar-admin.js', array( 'jquery' ), true, true );
	}

	/* Settings submenu */
	public static function settings() {
		require_once WEBLIZAR_PLUGIN_DIR_PATH . 'admin/inc/views/weblizar_settings.php';
	}

	/* Settings submenu assets */
	public static function settings_assets() {
		/* Enqueue styles */
		wp_enqueue_style( 'weblizar-admin', WEBLIZAR_PLUGIN_URL . 'assets/css/weblizar-admin.css' );
		wp_enqueue_style( 'toastr', WEBLIZAR_PLUGIN_URL . 'assets/css/toastr.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'weblizar-admin', WEBLIZAR_PLUGIN_URL . 'assets/js/weblizar-admin.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'toastr', WEBLIZAR_PLUGIN_URL . 'assets/js/toastr.js', array( 'jquery' ), true, true );
	}

	/* Go to Pro submenu */
	public static function go_to_pro() {
		require_once WEBLIZAR_PLUGIN_DIR_PATH . 'admin/inc/views/weblizar_go_to_pro.php';
	}

	/* Go to Pro submenu assets */
	public static function go_to_pro_assets() {
	/* Enqueue styles */
	wp_enqueue_style( 'weblizar-bootstrap', WEBLIZAR_PLUGIN_URL . 'assets/css/bootstrap.css' );
	wp_enqueue_style( 'font-awesome-5', WEBLIZAR_PLUGIN_URL . 'assets/css/all.css' );
	wp_enqueue_style( 'weblizar-admin', WEBLIZAR_PLUGIN_URL . 'assets/css/weblizar-admin.css' );

	/* Enqueue scripts */
	wp_enqueue_script( 'weblizar-popper-js', WEBLIZAR_PLUGIN_URL . 'assets/js/popper.js', array( 'jquery' ), true, true );
	wp_enqueue_script( 'weblizar-bootstrap-js', WEBLIZAR_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
	wp_enqueue_script( 'weblizar-admin-js', WEBLIZAR_PLUGIN_URL . 'assets/js/weblizar-admin.js', array( 'jquery' ), true, true );
	}

	/* Job applications submenu */
	public static function job_applications() {
		require_once WEBLIZAR_PLUGIN_DIR_PATH . 'admin/inc/views/weblizar_job_applications.php';
	}

	/* Job applications submenu assets */
	public static function job_applications_assets() {
		/* Enqueue styles */
		wp_enqueue_style( 'weblizar-bootstrap', WEBLIZAR_PLUGIN_URL . 'assets/css/bootstrap.css' );
		wp_enqueue_style( 'font-awesome-5', WEBLIZAR_PLUGIN_URL . 'assets/css/all.css' );
		wp_enqueue_style( 'weblizar-admin', WEBLIZAR_PLUGIN_URL . 'assets/css/weblizar-admin.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'weblizar-popper', WEBLIZAR_PLUGIN_URL . 'assets/js/popper.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'weblizar-bootstrap', WEBLIZAR_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'weblizar-admin', WEBLIZAR_PLUGIN_URL . 'assets/js/weblizar-admin.js', array( 'jquery' ), true, true );
	}
}
