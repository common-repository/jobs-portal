<?php
defined( 'ABSPATH' ) || die();

require_once( WEBLIZAR_PLUGIN_DIR_PATH . 'includes/Weblizar_Helper.php' );

class Weblizar_Job_Front {
	/**
	 * Register job post type
	 * @return void
	 */
	public static function register_job_post_type() {
		$labels = array(
			'name'                  => esc_html_x( 'Jobs', 'Post Type General Name', WEBLIZAR_DOMAIN ),
			'singular_name'         => esc_html_x( 'Job', 'Post Type Singular Name', WEBLIZAR_DOMAIN ),
			'menu_name'             => esc_html__( 'Job Portal', WEBLIZAR_DOMAIN ),
			'name_admin_bar'        => esc_html__( 'Job', WEBLIZAR_DOMAIN ),
			'archives'              => esc_html__( 'Job Archives', WEBLIZAR_DOMAIN ),
			'attributes'            => esc_html__( 'Job Attributes', WEBLIZAR_DOMAIN ),
			'all_items'             => esc_html__( 'All Jobs', WEBLIZAR_DOMAIN ),
			'add_new_item'          => esc_html__( 'Add New Job', WEBLIZAR_DOMAIN ),
			'add_new'               => esc_html__( 'Add New', WEBLIZAR_DOMAIN ),
			'new_item'              => esc_html__( 'New Job', WEBLIZAR_DOMAIN ),
			'edit_item'             => esc_html__( 'Edit Job', WEBLIZAR_DOMAIN ),
			'update_item'           => esc_html__( 'Update Job', WEBLIZAR_DOMAIN ),
			'view_item'             => esc_html__( 'View Job', WEBLIZAR_DOMAIN ),
			'view_items'            => esc_html__( 'View Jobs', WEBLIZAR_DOMAIN ),
			'search_items'          => esc_html__( 'Search Job', WEBLIZAR_DOMAIN ),
			'not_found'             => esc_html__( 'Not found', WEBLIZAR_DOMAIN ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', WEBLIZAR_DOMAIN ),
			'items_list'            => esc_html__( 'Job list', WEBLIZAR_DOMAIN ),
			'items_list_navigation' => esc_html__( 'Job list navigation', WEBLIZAR_DOMAIN ),
			'filter_items_list'     => esc_html__( 'Filter Job list', WEBLIZAR_DOMAIN ),
		);
		$args = array(
			'label'                 => esc_html__( 'Job', WEBLIZAR_DOMAIN ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor' ),
			'taxonomies'            => array( 'job_type', 'industry', 'department' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => false,
	        'menu_icon'             => 'dashicons-megaphone',
			'menu_position'         => 26,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'rewrite'               => array( 'slug' => 'job' ),
		);
		register_post_type( 'job', $args );
	}

	/**
	 * Register job_type taxonomy
	 * @return void
	 */
	public static function register_job_type_taxonomy() {
		$labels = array(
			'name'                       => esc_html_x( 'Job Types', 'Taxonomy General Name', WEBLIZAR_DOMAIN ),
			'singular_name'              => esc_html_x( 'Job Type', 'Taxonomy Singular Name', WEBLIZAR_DOMAIN ),
			'menu_name'                  => esc_html__( 'Job Types', WEBLIZAR_DOMAIN ),
			'all_items'                  => esc_html__( 'All Job Types', WEBLIZAR_DOMAIN ),
			'parent_item'                => esc_html__( 'Parent Job Type', WEBLIZAR_DOMAIN ),
			'parent_item_colon'          => esc_html__( 'Parent Job Type:', WEBLIZAR_DOMAIN ),
			'new_item_name'              => esc_html__( 'New Job Type', WEBLIZAR_DOMAIN ),
			'add_new_item'               => esc_html__( 'Add New Job Type', WEBLIZAR_DOMAIN ),
			'edit_item'                  => esc_html__( 'Edit Job Type', WEBLIZAR_DOMAIN ),
			'update_item'                => esc_html__( 'Update Job Type', WEBLIZAR_DOMAIN ),
			'view_item'                  => esc_html__( 'View Job Type', WEBLIZAR_DOMAIN ),
			'separate_items_with_commas' => esc_html__( 'Separate job types with commas', WEBLIZAR_DOMAIN ),
			'add_or_remove_items'        => esc_html__( 'Add or remove job types', WEBLIZAR_DOMAIN ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', WEBLIZAR_DOMAIN ),
			'popular_items'              => esc_html__( 'Popular Job Types', WEBLIZAR_DOMAIN ),
			'search_items'               => esc_html__( 'Search Job Types', WEBLIZAR_DOMAIN ),
			'not_found'                  => esc_html__( 'Not Found', WEBLIZAR_DOMAIN ),
			'no_terms'                   => esc_html__( 'No Job Types', WEBLIZAR_DOMAIN ),
			'items_list'                 => esc_html__( 'Job Types list', WEBLIZAR_DOMAIN ),
			'items_list_navigation'      => esc_html__( 'Job Types list navigation', WEBLIZAR_DOMAIN ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array( 'slug' => 'job_type' ),
		);
		register_taxonomy( 'job_type', array( 'job' ), $args );
	}

	/**
	 * Register industry taxonomy
	 * @return void
	 */
	public static function register_industry_taxonomy() {
		$labels = array(
			'name'                       => esc_html_x( 'Industries', 'Taxonomy General Name', WEBLIZAR_DOMAIN ),
			'singular_name'              => esc_html_x( 'Industry', 'Taxonomy Singular Name', WEBLIZAR_DOMAIN ),
			'menu_name'                  => esc_html__( 'Industries', WEBLIZAR_DOMAIN ),
			'all_items'                  => esc_html__( 'All Industries', WEBLIZAR_DOMAIN ),
			'parent_item'                => esc_html__( 'Parent Industry', WEBLIZAR_DOMAIN ),
			'parent_item_colon'          => esc_html__( 'Parent Industry:', WEBLIZAR_DOMAIN ),
			'new_item_name'              => esc_html__( 'New Industry', WEBLIZAR_DOMAIN ),
			'add_new_item'               => esc_html__( 'Add New Industry', WEBLIZAR_DOMAIN ),
			'edit_item'                  => esc_html__( 'Edit Industry', WEBLIZAR_DOMAIN ),
			'update_item'                => esc_html__( 'Update Industry', WEBLIZAR_DOMAIN ),
			'view_item'                  => esc_html__( 'View Industry', WEBLIZAR_DOMAIN ),
			'separate_items_with_commas' => esc_html__( 'Separate industries with commas', WEBLIZAR_DOMAIN ),
			'add_or_remove_items'        => esc_html__( 'Add or remove industries', WEBLIZAR_DOMAIN ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', WEBLIZAR_DOMAIN ),
			'popular_items'              => esc_html__( 'Popular Industries', WEBLIZAR_DOMAIN ),
			'search_items'               => esc_html__( 'Search Industries', WEBLIZAR_DOMAIN ),
			'not_found'                  => esc_html__( 'Not Found', WEBLIZAR_DOMAIN ),
			'no_terms'                   => esc_html__( 'No Industries', WEBLIZAR_DOMAIN ),
			'items_list'                 => esc_html__( 'Industries list', WEBLIZAR_DOMAIN ),
			'items_list_navigation'      => esc_html__( 'Industries list navigation', WEBLIZAR_DOMAIN ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array( 'slug' => 'industry' ),
		);
		register_taxonomy( 'industry', array( 'job' ), $args );
	}

	/**
	 * Register department taxonomy
	 * @return void
	 */
	public static function register_department_taxonomy() {
		$labels = array(
			'name'                       => esc_html_x( 'Departments', 'Taxonomy General Name', WEBLIZAR_DOMAIN ),
			'singular_name'              => esc_html_x( 'Department', 'Taxonomy Singular Name', WEBLIZAR_DOMAIN ),
			'menu_name'                  => esc_html__( 'Departments', WEBLIZAR_DOMAIN ),
			'all_items'                  => esc_html__( 'All Departments', WEBLIZAR_DOMAIN ),
			'parent_item'                => esc_html__( 'Parent Department', WEBLIZAR_DOMAIN ),
			'parent_item_colon'          => esc_html__( 'Parent Department:', WEBLIZAR_DOMAIN ),
			'new_item_name'              => esc_html__( 'New Department', WEBLIZAR_DOMAIN ),
			'add_new_item'               => esc_html__( 'Add New Department', WEBLIZAR_DOMAIN ),
			'edit_item'                  => esc_html__( 'Edit Department', WEBLIZAR_DOMAIN ),
			'update_item'                => esc_html__( 'Update Department', WEBLIZAR_DOMAIN ),
			'view_item'                  => esc_html__( 'View Department', WEBLIZAR_DOMAIN ),
			'separate_items_with_commas' => esc_html__( 'Separate departments with commas', WEBLIZAR_DOMAIN ),
			'add_or_remove_items'        => esc_html__( 'Add or remove departments', WEBLIZAR_DOMAIN ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', WEBLIZAR_DOMAIN ),
			'popular_items'              => esc_html__( 'Popular Departments', WEBLIZAR_DOMAIN ),
			'search_items'               => esc_html__( 'Search Departments', WEBLIZAR_DOMAIN ),
			'not_found'                  => esc_html__( 'Not Found', WEBLIZAR_DOMAIN ),
			'no_terms'                   => esc_html__( 'No Departments', WEBLIZAR_DOMAIN ),
			'items_list'                 => esc_html__( 'Departments list', WEBLIZAR_DOMAIN ),
			'items_list_navigation'      => esc_html__( 'Departments list navigation', WEBLIZAR_DOMAIN ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array( 'slug' => 'department' ),
		);
		register_taxonomy( 'department', array( 'job' ), $args );
	}

	/**
	 * Register skill taxonomy
	 * @return void
	 */
	public static function register_skill_taxonomy() {
		$labels = array(
			'name'                       => esc_html_x( 'Skills Required', 'Taxonomy General Name', WEBLIZAR_DOMAIN ),
			'singular_name'              => esc_html_x( 'Skill', 'Taxonomy Singular Name', WEBLIZAR_DOMAIN ),
			'menu_name'                  => esc_html__( 'Skills', WEBLIZAR_DOMAIN ),
			'all_items'                  => esc_html__( 'All Skills', WEBLIZAR_DOMAIN ),
			'new_item_name'              => esc_html__( 'New Skill', WEBLIZAR_DOMAIN ),
			'add_new_item'               => esc_html__( 'Add New Skill', WEBLIZAR_DOMAIN ),
			'edit_item'                  => esc_html__( 'Edit Skill', WEBLIZAR_DOMAIN ),
			'update_item'                => esc_html__( 'Update Skill', WEBLIZAR_DOMAIN ),
			'view_item'                  => esc_html__( 'View Skill', WEBLIZAR_DOMAIN ),
			'separate_items_with_commas' => esc_html__( 'Separate skills with commas', WEBLIZAR_DOMAIN ),
			'add_or_remove_items'        => esc_html__( 'Add or remove skills', WEBLIZAR_DOMAIN ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', WEBLIZAR_DOMAIN ),
			'popular_items'              => esc_html__( 'Popular Skills', WEBLIZAR_DOMAIN ),
			'search_items'               => esc_html__( 'Search Skills', WEBLIZAR_DOMAIN ),
			'not_found'                  => esc_html__( 'Not Found', WEBLIZAR_DOMAIN ),
			'no_terms'                   => esc_html__( 'No Skills', WEBLIZAR_DOMAIN ),
			'items_list'                 => esc_html__( 'Skills list', WEBLIZAR_DOMAIN ),
			'items_list_navigation'      => esc_html__( 'Skills list navigation', WEBLIZAR_DOMAIN ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => false,
			'show_in_nav_menus'          => false,
			'show_in_menu'               => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array( 'slug' => 'skill' ),
		);
		register_taxonomy( 'skill', array( 'job' ), $args );
	}

	/**
	 * Register job_location taxonomy
	 * @return void
	 */
	public static function register_job_location_taxonomy() {
		$labels = array(
			'name'                       => esc_html_x( 'Job Locations', 'Taxonomy General Name', WEBLIZAR_DOMAIN ),
			'singular_name'              => esc_html_x( 'Job Location', 'Taxonomy Singular Name', WEBLIZAR_DOMAIN ),
			'menu_name'                  => esc_html__( 'Job Locations', WEBLIZAR_DOMAIN ),
			'all_items'                  => esc_html__( 'All Job Locations', WEBLIZAR_DOMAIN ),
			'new_item_name'              => esc_html__( 'New Location', WEBLIZAR_DOMAIN ),
			'add_new_item'               => esc_html__( 'Add New Job Location', WEBLIZAR_DOMAIN ),
			'edit_item'                  => esc_html__( 'Edit Job Location', WEBLIZAR_DOMAIN ),
			'update_item'                => esc_html__( 'Update Job Location', WEBLIZAR_DOMAIN ),
			'view_item'                  => esc_html__( 'View Job Location', WEBLIZAR_DOMAIN ),
			'separate_items_with_commas' => esc_html__( 'Separate job locations with commas', WEBLIZAR_DOMAIN ),
			'add_or_remove_items'        => esc_html__( 'Add or remove job locations', WEBLIZAR_DOMAIN ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', WEBLIZAR_DOMAIN ),
			'popular_items'              => esc_html__( 'Popular Job Locations', WEBLIZAR_DOMAIN ),
			'search_items'               => esc_html__( 'Search Job Locations', WEBLIZAR_DOMAIN ),
			'not_found'                  => esc_html__( 'Not Found', WEBLIZAR_DOMAIN ),
			'no_terms'                   => esc_html__( 'No Job Locations', WEBLIZAR_DOMAIN ),
			'items_list'                 => esc_html__( 'Job Locations list', WEBLIZAR_DOMAIN ),
			'items_list_navigation'      => esc_html__( 'Job Locations list navigation', WEBLIZAR_DOMAIN ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => false,
			'show_in_nav_menus'          => false,
			'show_in_menu'               => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array( 'slug' => 'job_location' ),
		);
		register_taxonomy( 'job_location', array( 'job' ), $args );
	}

	/**
	 * Include single page template for job
	 * @param  string $template
	 * @return string
	 */
	public static function single_template( $template ) {
	    global $post;
		global $wp;
	    if ( $post->post_type == 'job' ) {
        	return WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/templates/single-job.php';
	    }
	    return $template;
	}

	/**
	 * Enqueue scripts and styles to job page templates
	 * @return void
	 */
	public static function enqueue_scripts_styles( ) {
		self::enqueue_scripts_single_template();
	}

	/**
	 * Enqueue scripts and styles to single job page template
	 * @return void
	 */
	private static function enqueue_scripts_single_template() {
		if ( is_single() && get_post_type() == 'job' ) {
			self::enqueue_libraries();
		}
	}

	/**
	 * Enqueue scripts and styles
	 * @return void
	 */
	private static function enqueue_libraries() {
		/* Enqueue styles */
		wp_enqueue_style( 'bootstrap', WEBLIZAR_PLUGIN_URL . 'assets/css/bootstrap.css' );
		wp_enqueue_style( 'font-awesome', WEBLIZAR_PLUGIN_URL . 'assets/css/all.css' );
		wp_enqueue_style( 'toastr', WEBLIZAR_PLUGIN_URL . 'assets/css/toastr.css' );
		wp_enqueue_style( 'weblizar-public', WEBLIZAR_PLUGIN_URL . 'assets/css/weblizar-public.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'jquery-form' );
		wp_enqueue_script( 'popper', WEBLIZAR_PLUGIN_URL . 'assets/js/popper.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'bootstrap', WEBLIZAR_PLUGIN_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'toastr', WEBLIZAR_PLUGIN_URL . 'assets/js/toastr.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'weblizar-moment-js', WEBLIZAR_PLUGIN_URL . 'assets/js/moment.js', array(), '', true );
		wp_enqueue_script( 'weblizar-public-js', WEBLIZAR_PLUGIN_URL . 'assets/js/weblizar-public.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'weblizar-public-ajax-js', WEBLIZAR_PLUGIN_URL . 'assets/js/weblizar-public-ajax.js', array( 'jquery' ), true, true );
		wp_localize_script( 'weblizar-public-ajax-js', 'WEBLIZARAjax', array( 'security' => wp_create_nonce( 'weblizar' ) ) );
		wp_localize_script( 'weblizar-public-ajax-js', 'weblizarajaxurl', [esc_url( admin_url( 'admin-ajax.php' ) )] );
		wp_localize_script( 'weblizar-public-ajax-js', 'WEBLIZARAdminUrl', [admin_url()] );
	}
}
?>