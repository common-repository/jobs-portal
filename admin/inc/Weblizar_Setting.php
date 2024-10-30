<?php

defined( 'ABSPATH' ) || die();

require_once WEBLIZAR_PLUGIN_DIR_PATH . 'includes/Weblizar_Helper.php';

class Weblizar_Setting {
	public static function add_settings_link( $links ) {
		$settings_link = '<a href="' . menu_page_url( 'job_portal_settings', false ) . '">' . esc_html__( 'Settings', WEBLIZAR_DOMAIN ) . '</a>';
		array_push( $links, $settings_link );

		return $links;
	}

	public static function register_settings() {
		/* Register settings */
		$section_group = 'weblizar';
		$page          = $section_group;
		register_setting( $section_group, 'weblizar_general', array( 'Weblizar_Setting', 'weblizar_general_validate' ) );

		$settings_section_general = 'weblizar_general';

		/* Create section of page */
		add_settings_section( $settings_section_general, esc_html__( 'General', WEBLIZAR_DOMAIN ), '', $page );

		/* Add fields to section */
		add_settings_field( 'weblizar_general_jobs_per_page', esc_html__( 'Number of jobs per page', WEBLIZAR_DOMAIN ), array( 'Weblizar_Setting', 'weblizar_general_jobs_per_page_input' ), $page, $settings_section_general );

		add_settings_field( 'weblizar_general_admin_applications_per_page', esc_html__( 'Number of applications per page in admin panel', WEBLIZAR_DOMAIN ), array( 'Weblizar_Setting', 'weblizar_general_admin_applications_per_page_input' ), $page, $settings_section_general );

		add_settings_field( 'weblizar_general_candidate_jobs_applied_per_page', esc_html__( 'Number of jobs applied per page in candidate panel', WEBLIZAR_DOMAIN ), array( 'Weblizar_Setting', 'weblizar_general_candidate_jobs_applied_per_page_input' ), $page, $settings_section_general );

		add_settings_field( 'weblizar_general_job_portal_page_id', esc_html__( 'Job Portal Page', WEBLIZAR_DOMAIN ) . '<br><span id="weblizar_job_portal_shortcode">[job_portal]</span> <span id="weblizar_job_portal_shortcode_copy">' . esc_html__( 'Copy', WEBLIZAR_DOMAIN ) . '</span>', array( 'Weblizar_Setting', 'weblizar_general_job_portal_page_id_input' ), $page, $settings_section_general );

		add_settings_field( 'weblizar_general_account_page_id', esc_html__( 'Account Page', WEBLIZAR_DOMAIN ) . '<br><span id="weblizar_job_portal_account_shortcode">[job_portal_account]</span> <span id="weblizar_job_portal_account_shortcode_copy">' . esc_html__( 'Copy', WEBLIZAR_DOMAIN ) . '</span>', array( 'Weblizar_Setting', 'weblizar_general_account_page_id_input' ), $page, $settings_section_general );
	}

	public static function weblizar_general_jobs_per_page_input() {
		$general_jobs_per_page = Weblizar_Helper::general_jobs_per_page();
		echo '<input type="number" min="0" step="1" id="weblizar_general_jobs_per_page" name="weblizar_general[jobs_per_page]" value="' . $general_jobs_per_page . '">';
	}

	public static function weblizar_general_admin_applications_per_page_input() {
		$general_admin_applications_per_page = Weblizar_Helper::general_admin_applications_per_page();
		echo '<input type="number" min="0" step="1" id="weblizar_general_admin_applications_per_page" name="weblizar_general[admin_applications_per_page]" value="' . $general_admin_applications_per_page . '">';
	}

	public static function weblizar_general_candidate_jobs_applied_per_page_input() {
		$general_candidate_jobs_applied_per_page = Weblizar_Helper::general_candidate_jobs_applied_per_page();
		echo '<input type="number" min="0" step="1" id="weblizar_general_candidate_jobs_applied_per_page" name="weblizar_general[candidate_jobs_applied_per_page]" value="' . $general_candidate_jobs_applied_per_page . '">';
	}

	public static function weblizar_general_job_portal_page_id_input() {
		$general_job_portal_page_id  = Weblizar_Helper::general_job_portal_page_id();
		$general_job_portal_page_url = $general_job_portal_page_id ? get_permalink( $general_job_portal_page_id ) : home_url();
		wp_dropdown_pages(
			array(
				'name'     => 'weblizar_general[job_portal_page_id]',
				'id'       => 'weblizar_general_job_portal_page_id',
				'selected' => $general_job_portal_page_id,
			)
		);
	}

	public static function weblizar_general_account_page_id_input() {
		$general_account_page_id  = Weblizar_Helper::general_account_page_id();
		$general_account_page_url = $general_account_page_id ? get_permalink( $general_account_page_id ) : home_url();
		wp_dropdown_pages(
			array(
				'name'     => 'weblizar_general[account_page_id]',
				'id'       => 'weblizar_general_account_page_id',
				'selected' => $general_account_page_id,
			)
		);
	}

	public static function weblizar_general_validate( $input ) {
		$validated                                    = array();
		$validated['jobs_per_page']                   = isset( $input['jobs_per_page'] ) ? intval( $input['jobs_per_page'] ) : 15;
		$validated['admin_applications_per_page']     = isset( $input['admin_applications_per_page'] ) ? intval( $input['admin_applications_per_page'] ) : 15;
		$validated['candidate_jobs_applied_per_page'] = isset( $input['candidate_jobs_applied_per_page'] ) ? intval( $input['candidate_jobs_applied_per_page'] ) : 5;
		$validated['job_portal_page_id']              = isset( $input['job_portal_page_id'] ) ? intval( $input['job_portal_page_id'] ) : 0;
		$validated['account_page_id']                 = isset( $input['account_page_id'] ) ? intval( $input['account_page_id'] ) : 0;

		return $validated;
	}
}
