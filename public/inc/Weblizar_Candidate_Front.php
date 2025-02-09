<?php
defined( 'ABSPATH' ) || die();

require_once WEBLIZAR_PLUGIN_DIR_PATH . 'includes/Weblizar_Helper.php';

class Weblizar_Candidate_Front {
	/**
	 * Register candidate post type
	 *
	 * @return void
	 */
	public static function register_candidate_post_type() {
		$labels = array(
			'name'                  => esc_html_x( 'Candidates', 'Post Type General Name', WEBLIZAR_DOMAIN ),
			'singular_name'         => esc_html_x( 'Candidate', 'Post Type Singular Name', WEBLIZAR_DOMAIN ),
			'menu_name'             => esc_html__( 'Candidates', WEBLIZAR_DOMAIN ),
			'name_admin_bar'        => esc_html__( 'Candidate', WEBLIZAR_DOMAIN ),
			'archives'              => esc_html__( 'Candidate Archives', WEBLIZAR_DOMAIN ),
			'attributes'            => esc_html__( 'Candidate Attributes', WEBLIZAR_DOMAIN ),
			'all_items'             => esc_html__( 'All Candidates', WEBLIZAR_DOMAIN ),
			'add_new_item'          => esc_html__( 'Add New Candidate', WEBLIZAR_DOMAIN ),
			'add_new'               => esc_html__( 'Add New', WEBLIZAR_DOMAIN ),
			'new_item'              => esc_html__( 'New Candidate', WEBLIZAR_DOMAIN ),
			'edit_item'             => esc_html__( 'Edit Candidate', WEBLIZAR_DOMAIN ),
			'update_item'           => esc_html__( 'Update Candidate', WEBLIZAR_DOMAIN ),
			'view_item'             => esc_html__( 'View Candidate', WEBLIZAR_DOMAIN ),
			'view_items'            => esc_html__( 'View Candidates', WEBLIZAR_DOMAIN ),
			'search_items'          => esc_html__( 'Search Candidate', WEBLIZAR_DOMAIN ),
			'not_found'             => esc_html__( 'Not found', WEBLIZAR_DOMAIN ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', WEBLIZAR_DOMAIN ),
			'items_list'            => esc_html__( 'Candidate list', WEBLIZAR_DOMAIN ),
			'items_list_navigation' => esc_html__( 'Candidate list navigation', WEBLIZAR_DOMAIN ),
			'filter_items_list'     => esc_html__( 'Filter Candidate list', WEBLIZAR_DOMAIN ),
		);
		$args   = array(
			'label'               => esc_html__( 'Candidate', WEBLIZAR_DOMAIN ),
			'labels'              => $labels,
			'supports'            => array( 'title' ),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-admin-users',
			'menu_position'       => 28,
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'page',
			'capabilities'        => array( 'create_posts' => is_multisite() ? 'do_not_allow' : false ),
			'map_meta_cap'        => true,
			'rewrite'             => array( 'slug' => 'candidate' ),
		);
		register_post_type( 'candidate', $args );
	}

	/**
	 * Register cv
	 *
	 * @return void
	 */
	public static function register_cv() {
		if ( ! wp_verify_nonce( $_POST['cv'], 'cv' ) ) {
			die();
		}

		$user_id                = get_current_user_id();
		$personal_name          = isset( $_POST['candidate_personal_name'] ) ? sanitize_text_field( $_POST['candidate_personal_name'] ) : null;
		$personal_last_name     = isset( $_POST['candidate_personal_last_name'] ) ? sanitize_text_field( $_POST['candidate_personal_last_name'] ) : null;
		$personal_state         = isset( $_POST['candidate_personal_state'] ) ? sanitize_text_field( $_POST['candidate_personal_state'] ) : null;
		$personal_city          = isset( $_POST['candidate_personal_city'] ) ? sanitize_text_field( $_POST['candidate_personal_city'] ) : null;
		$personal_email         = isset( $_POST['candidate_personal_email'] ) ? sanitize_email( $_POST['candidate_personal_email'] ) : null;
		$personal_mobile        = isset( $_POST['candidate_personal_mobile'] ) ? intval( sanitize_text_field( $_POST['candidate_personal_mobile'] ) ) : null;
		$personal_date_of_birth = isset( $_POST['candidate_personal_date_of_birth'] ) ? sanitize_text_field( $_POST['candidate_personal_date_of_birth'] ) : null;
		$personal_location      = isset( $_POST['candidate_personal_location'] ) ? sanitize_text_field( $_POST['candidate_personal_location'] ) : null;
		$personal_gender        = isset( $_POST['candidate_personal_gender'] ) ? sanitize_text_field( $_POST['candidate_personal_gender'] ) : null;

		$document_cv = ( isset( $_FILES['candidate_document_cv'] ) && is_array( $_FILES['candidate_document_cv'] ) ) ? $_FILES['candidate_document_cv'] : null;

		$work_experience_profile_title          = isset( $_POST['candidate_work_experience_profile_title'] ) ? sanitize_title( $_POST['candidate_work_experience_profile_title'] ) : null;
		$work_experience_profile_summary        = isset( $_POST['candidate_work_experience_profile_summary'] ) ? sanitize_text_field( $_POST['candidate_work_experience_profile_summary'] ) : null;
		$work_experience_total_experience       = ( isset( $_POST['candidate_work_experience_total_experience'] ) && is_array( $_POST['candidate_work_experience_total_experience'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_work_experience_total_experience'] ) : array();
		$work_experience_total_experience_year  = isset( $work_experience_total_experience['year'] ) ? intval( sanitize_text_field( $work_experience_total_experience['year'] ) ) : '';
		$work_experience_total_experience_month = isset( $work_experience_total_experience['month'] ) ? intval( sanitize_text_field( $work_experience_total_experience['month'] ) ) : '';
		$work_experience_salary                 = isset( $_POST['candidate_work_experience_salary'] ) ? sanitize_text_field( $_POST['candidate_work_experience_salary'] ) : null;
		$work_experience_notice_period          = isset( $_POST['candidate_work_experience_notice_period'] ) ? sanitize_text_field( $_POST['candidate_work_experience_notice_period'] ) : null;
		$work_experience_last_working_day       = isset( $_POST['candidate_work_experience_last_working_day'] ) ? sanitize_text_field( $_POST['candidate_work_experience_last_working_day'] ) : null;

		$employment_job_title     = ( isset( $_POST['candidate_employment_job_title'] ) && is_array( $_POST['candidate_employment_job_title'] ) ) ? array_map( 'sanitize_title', $_POST['candidate_employment_job_title'] ) : array();
		$employment_company_name  = ( isset( $_POST['candidate_employment_company_name'] ) && is_array( $_POST['candidate_employment_company_name'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_employment_company_name'] ) : array();
		$employment_industry      = ( isset( $_POST['candidate_employment_industry'] ) && is_array( $_POST['candidate_employment_industry'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_employment_industry'] ) : array();
		$employment_duration_from = ( isset( $_POST['candidate_employment_duration_from'] ) && is_array( $_POST['candidate_employment_duration_from'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_employment_duration_from'] ) : array();
		$employment_duration_to   = ( isset( $_POST['candidate_employment_duration_to'] ) && is_array( $_POST['candidate_employment_duration_to'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_employment_duration_to'] ) : array();

		$education_specialization  = ( isset( $_POST['candidate_education_specialization'] ) && is_array( $_POST['candidate_education_specialization'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_education_specialization'] ) : array();
		$education_institute_name  = ( isset( $_POST['candidate_education_institute_name'] ) && is_array( $_POST['candidate_education_institute_name'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_education_institute_name'] ) : array();
		$education_course_type     = ( isset( $_POST['candidate_education_course_type'] ) && is_array( $_POST['candidate_education_course_type'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_education_course_type'] ) : array();
		$education_year_of_passing = ( isset( $_POST['candidate_education_year_of_passing'] ) && is_array( $_POST['candidate_education_year_of_passing'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_education_year_of_passing'] ) : array();

		$skills = ( isset( $_POST['candidate_skills'] ) && is_array( $_POST['candidate_skills'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_skills'] ) : array();

		$certification_title = ( isset( $_POST['candidate_certification_title'] ) && is_array( $_POST['candidate_certification_title'] ) ) ? array_map( 'sanitize_title', $_POST['candidate_certification_title'] ) : array();
		$certification_year  = ( isset( $_POST['candidate_certification_year'] ) && is_array( $_POST['candidate_certification_year'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_certification_year'] ) : array();

		$desired_job_locations   = isset( $_POST['candidate_desired_job_locations'] ) ? sanitize_text_field( $_POST['candidate_desired_job_locations'] ) : null;
		$desired_job_industry    = isset( $_POST['candidate_desired_job_industry'] ) ? sanitize_text_field( $_POST['candidate_desired_job_industry'] ) : null;
		$desired_job_salary      = isset( $_POST['candidate_desired_job_salary'] ) ? sanitize_text_field( $_POST['candidate_desired_job_salary'] ) : null;
		$desired_job_departments = ( isset( $_POST['candidate_desired_job_departments'] ) && is_array( $_POST['candidate_desired_job_departments'] ) ) ? sanitize_text_field( $_POST['candidate_desired_job_departments'] ) : array();
		$desired_job_types       = ( isset( $_POST['candidate_desired_job_types'] ) && is_array( $_POST['candidate_desired_job_types'] ) ) ? $_POST['candidate_desired_job_types'] : array();

		$errors = array();

		if ( empty( $personal_name ) ) {
			$errors['candidate_personal_name'] = esc_html__( 'Please specify your name', WEBLIZAR_DOMAIN );
		}

		if ( ! empty( $document_cv ) ) {
			$file_name          = sanitize_file_name( $document_cv['name'] );
			$file_type          = $document_cv['type'];
			$allowed_file_types = Weblizar_Helper::cv_document_file_types();

			if ( ! in_array( $file_type, $allowed_file_types ) ) {
				$errors['candidate_document_cv'] = esc_html__( 'Please provide CV in PDF, DOC or DOCX format.', WEBLIZAR_DOMAIN );
			}
		}

		if ( count( $errors ) ) {
			wp_send_json_error( $errors );
		}

		if ( ! empty( $document_cv ) ) {
			$document_cv = media_handle_upload( 'candidate_document_cv', 0 );
			if ( is_wp_error( $document_cv ) ) {
				wp_send_json_error( $document_cv->get_error_message() );
			}
		}

		$post_id = wp_insert_post(
			array(
				'post_title'     => $personal_name,
				'post_type'      => 'candidate',
				'post_status'    => 'publish',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			)
		);

		$document = array(
			'cv'             => $document_cv,
			'latest_cv_date' => date( 'Y-m-d H:i:s' ),
		);

		$personal = array(
			'name'          => $personal_name,
			'lastname'      => $personal_last_name,
			'state'         => $personal_state,
			'city'          => $personal_city,
			'email'         => $personal_email,
			'mobile'        => $personal_mobile,
			'date_of_birth' => $personal_date_of_birth,
			'location'      => $personal_location,
			'gender'        => $personal_gender,
		);

		$work_experience = array(
			'profile_title'    => $work_experience_profile_title,
			'profile_summary'  => $work_experience_profile_summary,
			'total_experience' => array(
				'year'  => $work_experience_total_experience_year,
				'month' => $work_experience_total_experience_month,
			),
			'salary'           => $work_experience_salary,
			'notice_period'    => $work_experience_notice_period,
			'last_working_day' => $work_experience_last_working_day,
		);

		$employment = array();
		foreach ( $employment_job_title as $key => $job_title ) {
			array_push(
				$employment,
				array(
					'job_title'     => $job_title,
					'company_name'  => isset( $employment_company_name[ $key ] ) ? $employment_company_name[ $key ] : null,
					'industry'      => isset( $employment_industry[ $key ] ) ? $employment_industry[ $key ] : null,
					'duration_from' => isset( $employment_duration_from[ $key ] ) ? $employment_duration_from[ $key ] : null,
					'duration_to'   => isset( $employment_duration_to[ $key ] ) ? $employment_duration_to[ $key ] : null,
				)
			);
		}

		$education = array();
		foreach ( $education_specialization as $key => $specialization ) {
			array_push(
				$education,
				array(
					'specialization'  => $specialization,
					'institute_name'  => isset( $education_institute_name[ $key ] ) ? $education_institute_name[ $key ] : null,
					'course_type'     => isset( $education_course_type[ $key ] ) ? $education_course_type[ $key ] : null,
					'year_of_passing' => isset( $education_year_of_passing[ $key ] ) ? $education_year_of_passing[ $key ] : null,
				)
			);
		}

		$certification = array();
		foreach ( $certification_title as $key => $title ) {
			array_push(
				$certification,
				array(
					'certification_title'   => $title,
					'year_of_certification' => isset( $certification_year[ $key ] ) ? $certification_year[ $key ] : null,
				)
			);
		}

		if ( $desired_job_locations ) {
			$desired_job_locations = explode( ',', $desired_job_locations );
			$desired_job_locations = array_map( 'trim', $desired_job_locations );
		} else {
			$desired_job_locations = array();
		}

		$desired_job = array(
			'locations'   => $desired_job_locations,
			'industry'    => $desired_job_industry,
			'departments' => $desired_job_departments,
			'salary'      => $desired_job_salary,
			'job_types'   => $desired_job_types,
		);

		update_post_meta( $post_id, 'weblizar_candidate_user_id', $user_id );
		update_post_meta( $post_id, 'weblizar_candidate_personal', $personal );
		update_post_meta( $post_id, 'weblizar_candidate_document', $document );
		update_post_meta( $post_id, 'weblizar_candidate_work_experience', $work_experience );
		update_post_meta( $post_id, 'weblizar_candidate_employment', $employment );
		update_post_meta( $post_id, 'weblizar_candidate_education', $education );
		update_post_meta( $post_id, 'weblizar_candidate_skills', $skills );
		update_post_meta( $post_id, 'weblizar_candidate_certification', $certification );
		update_post_meta( $post_id, 'weblizar_candidate_desired_job', $desired_job );

		wp_send_json_success(
			array(
				'message' => esc_html__( 'Thank you for CV registration.', WEBLIZAR_DOMAIN ),
				'reload'  => true,
			)
		);
	}

	/**
	 * Update cv
	 *
	 * @return void
	 */
	public static function update_cv() {
		if ( ! wp_verify_nonce( $_POST['cv-update'], 'cv-update' ) ) {
			die();
		}

		$user_id = get_current_user_id();
		if ( $candidate = Weblizar_Helper::user_has_cv( $user_id ) ) {
			$post_id = $candidate->ID;
		} else {
			die();
		}
		$personal_name      = isset( $_POST['candidate_personal_name'] ) ? sanitize_text_field( $_POST['candidate_personal_name'] ) : null;
		$personal_last_name = isset( $_POST['candidate_personal_last_name'] ) ? sanitize_text_field( $_POST['candidate_personal_last_name'] ) : null;
		$personal_state     = isset( $_POST['candidate_personal_state'] ) ? sanitize_text_field( $_POST['candidate_personal_state'] ) : null;
		$personal_city      = isset( $_POST['candidate_personal_city'] ) ? sanitize_text_field( $_POST['candidate_personal_city'] ) : null;

		$personal_email         = isset( $_POST['candidate_personal_email'] ) ? sanitize_email( $_POST['candidate_personal_email'] ) : null;
		$personal_mobile        = isset( $_POST['candidate_personal_mobile'] ) ? intval( sanitize_text_field( $_POST['candidate_personal_mobile'] ) ) : null;
		$personal_date_of_birth = isset( $_POST['candidate_personal_date_of_birth'] ) ? sanitize_text_field( $_POST['candidate_personal_date_of_birth'] ) : null;
		$personal_location      = isset( $_POST['candidate_personal_location'] ) ? sanitize_text_field( $_POST['candidate_personal_location'] ) : null;
		$personal_gender        = isset( $_POST['candidate_personal_gender'] ) ? sanitize_text_field( $_POST['candidate_personal_gender'] ) : null;

		$saved_document       = get_post_meta( $candidate->ID, 'weblizar_candidate_document', true );
		$saved_document_cv    = isset( $saved_document['cv'] ) ? esc_attr( $saved_document['cv'] ) : '';
		$saved_latest_cv_date = isset( $saved_document['latest_cv_date'] ) ? esc_attr( $saved_document['latest_cv_date'] ) : '';
		$document_cv          = isset( $_FILES['candidate_document_cv'] ) && is_array( $_FILES['candidate_document_cv'] ) ? ( $_FILES['candidate_document_cv'] ) : null;

				$work_experience_profile_title          = isset( $_POST['candidate_work_experience_profile_title'] ) ? sanitize_title( $_POST['candidate_work_experience_profile_title'] ) : null;
				$work_experience_profile_summary        = isset( $_POST['candidate_work_experience_profile_summary'] ) ? sanitize_text_field( $_POST['candidate_work_experience_profile_summary'] ) : null;
				$work_experience_total_experience       = ( isset( $_POST['candidate_work_experience_total_experience'] ) && is_array( $_POST['candidate_work_experience_total_experience'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_work_experience_total_experience'] ) : array();
				$work_experience_total_experience_year  = isset( $work_experience_total_experience['year'] ) ? intval( sanitize_text_field( $work_experience_total_experience['year'] ) ) : '';
				$work_experience_total_experience_month = isset( $work_experience_total_experience['month'] ) ? intval( sanitize_text_field( $work_experience_total_experience['month'] ) ) : '';
				$work_experience_salary                 = isset( $_POST['candidate_work_experience_salary'] ) ? sanitize_text_field( $_POST['candidate_work_experience_salary'] ) : null;
				$work_experience_notice_period          = isset( $_POST['candidate_work_experience_notice_period'] ) ? sanitize_text_field( $_POST['candidate_work_experience_notice_period'] ) : null;
				$work_experience_last_working_day       = isset( $_POST['candidate_work_experience_last_working_day'] ) ? sanitize_text_field( $_POST['candidate_work_experience_last_working_day'] ) : null;

				$employment_job_title     = ( isset( $_POST['candidate_employment_job_title'] ) && is_array( $_POST['candidate_employment_job_title'] ) ) ? array_map( 'sanitize_title', $_POST['candidate_employment_job_title'] ) : array();
				$employment_company_name  = ( isset( $_POST['candidate_employment_company_name'] ) && is_array( $_POST['candidate_employment_company_name'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_employment_company_name'] ) : array();
				$employment_industry      = ( isset( $_POST['candidate_employment_industry'] ) && is_array( $_POST['candidate_employment_industry'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_employment_industry'] ) : array();
				$employment_duration_from = ( isset( $_POST['candidate_employment_duration_from'] ) && is_array( $_POST['candidate_employment_duration_from'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_employment_duration_from'] ) : array();
				$employment_duration_to   = ( isset( $_POST['candidate_employment_duration_to'] ) && is_array( $_POST['candidate_employment_duration_to'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_employment_duration_to'] ) : array();

				$education_specialization  = ( isset( $_POST['candidate_education_specialization'] ) && is_array( $_POST['candidate_education_specialization'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_education_specialization'] ) : array();
				$education_institute_name  = ( isset( $_POST['candidate_education_institute_name'] ) && is_array( $_POST['candidate_education_institute_name'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_education_institute_name'] ) : array();
				$education_course_type     = ( isset( $_POST['candidate_education_course_type'] ) && is_array( $_POST['candidate_education_course_type'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_education_course_type'] ) : array();
				$education_year_of_passing = ( isset( $_POST['candidate_education_year_of_passing'] ) && is_array( $_POST['candidate_education_year_of_passing'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_education_year_of_passing'] ) : array();

				$skills = ( isset( $_POST['candidate_skills'] ) && is_array( $_POST['candidate_skills'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_skills'] ) : array();

				$certification_title = ( isset( $_POST['candidate_certification_title'] ) && is_array( $_POST['candidate_certification_title'] ) ) ? array_map( 'sanitize_title', $_POST['candidate_certification_title'] ) : array();
				$certification_year  = ( isset( $_POST['candidate_certification_year'] ) && is_array( $_POST['candidate_certification_year'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_certification_year'] ) : array();

				$desired_job_locations   = isset( $_POST['candidate_desired_job_locations'] ) ? sanitize_text_field( $_POST['candidate_desired_job_locations'] ) : null;
				$desired_job_industry    = isset( $_POST['candidate_desired_job_industry'] ) ? sanitize_text_field( $_POST['candidate_desired_job_industry'] ) : null;
				$desired_job_salary      = isset( $_POST['candidate_desired_job_salary'] ) ? sanitize_text_field( $_POST['candidate_desired_job_salary'] ) : null;
				$desired_job_departments = ( isset( $_POST['candidate_desired_job_departments'] ) && is_array( $_POST['candidate_desired_job_departments'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_desired_job_departments'] ) : array();
				$desired_job_types       = ( isset( $_POST['candidate_desired_job_types'] ) && is_array( $_POST['candidate_desired_job_types'] ) ) ? array_map( 'sanitize_text_field', $_POST['candidate_desired_job_types'] ) : array();

				$errors = array();

		if ( empty( $personal_name ) ) {
			$errors['candidate_personal_name'] = esc_html__( 'Please specify your name', WEBLIZAR_DOMAIN );
		}

		if ( ! empty( $document_cv ) ) {
			$file_name          = sanitize_file_name( $document_cv['name'] );
			$file_type          = $document_cv['type'];
			$allowed_file_types = Weblizar_Helper::cv_document_file_types();

			if ( ! in_array( $file_type, $allowed_file_types ) ) {
				$errors['candidate_document_cv'] = esc_html__( 'Please provide CV in PDF, DOC or DOCX format.', WEBLIZAR_DOMAIN );
			}
		}

		if ( count( $errors ) ) {
			wp_send_json_error( $errors );
		}

				$latest_cv_date = date( 'Y-m-d H:i:s' );
		if ( ! empty( $document_cv ) ) {
			/* New document provided */
			$document_cv = media_handle_upload( 'candidate_document_cv', 0 );
			if ( is_wp_error( $document_cv ) ) {
				wp_send_json_error( $document_cv->get_error_message() );
			}
			/* New document provided and there is saved document */
			if ( ! empty( $saved_document_cv ) ) {
				$delete_saved_document_cv = true;
			}
		} elseif ( ! empty( $saved_document_cv ) ) {
			/* New document not provided and there is saved document */
			$document_cv    = $saved_document_cv;
			$latest_cv_date = $saved_latest_cv_date;
		} else {
			/* New document not provided and there is no saved document */
			$document_cv    = null;
			$latest_cv_date = null;
		}

				$status = wp_update_post(
					array(
						'ID'             => $post_id,
						'post_title'     => $personal_name,
						'post_type'      => 'candidate',
						'post_status'    => 'publish',
						'comment_status' => 'closed',
						'ping_status'    => 'closed',
					),
					true
				);

		if ( is_wp_error( $status ) ) {
			wp_send_json_error( $status->get_error_message() );
		}

				$document = array(
					'cv'             => $document_cv,
					'latest_cv_date' => $latest_cv_date,
				);

				$personal = array(
					'name'          => $personal_name,
					'lastname'      => $personal_last_name,
					'state'         => $personal_state,
					'city'          => $personal_city,
					'email'         => $personal_email,
					'mobile'        => $personal_mobile,
					'date_of_birth' => $personal_date_of_birth,
					'location'      => $personal_location,
					'gender'        => $personal_gender,
				);

				$work_experience = array(
					'profile_title'    => $work_experience_profile_title,
					'profile_summary'  => $work_experience_profile_summary,
					'total_experience' => array(
						'year'  => $work_experience_total_experience_year,
						'month' => $work_experience_total_experience_month,
					),
					'salary'           => $work_experience_salary,
					'notice_period'    => $work_experience_notice_period,
					'last_working_day' => $work_experience_last_working_day,
				);

				$employment = array();
				foreach ( $employment_job_title as $key => $job_title ) {
					array_push(
						$employment,
						array(
							'job_title'     => $job_title,
							'company_name'  => isset( $employment_company_name[ $key ] ) ? $employment_company_name[ $key ] : null,
							'industry'      => isset( $employment_industry[ $key ] ) ? $employment_industry[ $key ] : null,
							'duration_from' => isset( $employment_duration_from[ $key ] ) ? $employment_duration_from[ $key ] : null,
							'duration_to'   => isset( $employment_duration_to[ $key ] ) ? $employment_duration_to[ $key ] : null,
						)
					);
				}

				$education = array();
				foreach ( $education_specialization as $key => $specialization ) {
					array_push(
						$education,
						array(
							'specialization'  => $specialization,
							'institute_name'  => isset( $education_institute_name[ $key ] ) ? $education_institute_name[ $key ] : null,
							'course_type'     => isset( $education_course_type[ $key ] ) ? $education_course_type[ $key ] : null,
							'year_of_passing' => isset( $education_year_of_passing[ $key ] ) ? $education_year_of_passing[ $key ] : null,
						)
					);
				}

				$certification = array();
				foreach ( $certification_title as $key => $title ) {
					array_push(
						$certification,
						array(
							'certification_title'   => $title,
							'year_of_certification' => isset( $certification_year[ $key ] ) ? $certification_year[ $key ] : null,
						)
					);
				}

				if ( $desired_job_locations ) {
					$desired_job_locations = explode( ',', $desired_job_locations );
					$desired_job_locations = array_map( 'trim', $desired_job_locations );
				} else {
					$desired_job_locations = array();
				}

				$desired_job = array(
					'locations'   => $desired_job_locations,
					'industry'    => $desired_job_industry,
					'departments' => $desired_job_departments,
					'salary'      => $desired_job_salary,
					'job_types'   => $desired_job_types,
				);

				update_post_meta( $post_id, 'weblizar_candidate_user_id', $user_id );
				update_post_meta( $post_id, 'weblizar_candidate_personal', $personal );
				update_post_meta( $post_id, 'weblizar_candidate_document', $document );
				update_post_meta( $post_id, 'weblizar_candidate_work_experience', $work_experience );
				update_post_meta( $post_id, 'weblizar_candidate_employment', $employment );
				update_post_meta( $post_id, 'weblizar_candidate_education', $education );
				update_post_meta( $post_id, 'weblizar_candidate_skills', $skills );
				update_post_meta( $post_id, 'weblizar_candidate_certification', $certification );
				update_post_meta( $post_id, 'weblizar_candidate_desired_job', $desired_job );

				if ( isset( $delete_saved_document_cv ) ) {
					wp_delete_attachment( $saved_document_cv, true );
				}

				wp_send_json_success(
					array(
						'message' => esc_html__( 'Your CV has been updated.', WEBLIZAR_DOMAIN ),
						'reload'  => true,
					)
				);
	}

			/**
			 * Delete cv
			 *
			 * @return void
			 */
	public static function delete_cv() {
		if ( ! wp_verify_nonce( $_POST['security'], 'weblizar' ) ) {
			die();
		}

		$cv = Weblizar_Helper::user_has_cv( get_current_user_id() );

		if ( ! $cv ) {
			die();
		}

		$document    = get_post_meta( $cv->ID, 'weblizar_candidate_document', true );
		$document_cv = isset( $document['cv'] ) ? esc_attr( $document['cv'] ) : '';

		$success = wp_delete_post( $cv->ID, true );

		if ( ! $success ) {
			throw new Exception( esc_html__( 'An unexpected error occurred.', WEBLIZAR_DOMAIN ) );
		}

		if ( ! empty( $document_cv ) ) {
			wp_delete_attachment( $document_cv, true );
		}

		wp_send_json_success(
			array(
				'message' => esc_html__( 'Your CV has been deleted.', WEBLIZAR_DOMAIN ),
				'reload'  => true,
			)
		);
	}

			/* Apply to job */
	public static function apply_to_job() {
		$candidate = Weblizar_Helper::user_has_cv( get_current_user_id() );
		if ( ! $candidate ) {
			die();
		}
		if ( ! wp_verify_nonce( $_POST['security'], 'weblizar' ) ) {
			die();
		}

		$job_id = intval( sanitize_text_field( $_POST['id'] ) );

		global $wpdb;

		/* Check if job exists */
		$job = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}posts WHERE ID = $job_id AND post_type = 'job' AND post_status = 'publish'" );
		if ( ! $job ) {
			die();
		}

		$data = array(
			'candidate_id' => $candidate->ID,
			'job_id'       => $job->ID,
		);

		try {
			$wpdb->query( 'BEGIN;' );

			$success = $wpdb->insert( "{$wpdb->prefix}weblizar_candidate_job", $data );
			if ( ! $success ) {
				throw new Exception( esc_html__( 'An unexpected error occurred.', WEBLIZAR_DOMAIN ) );
			}
			$wpdb->query( 'COMMIT;' );

			wp_send_json_success( array( 'message' => esc_html__( 'You have applied.', WEBLIZAR_DOMAIN ) ) );
		} catch ( Exception $exception ) {
			$wpdb->query( 'ROLLBACK;' );
			wp_send_json_error( $exception->getMessage() );
		}
	}
}
