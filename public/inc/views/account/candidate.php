<?php
defined( 'ABSPATH' ) || die();

if ( $candidate = Weblizar_Helper::user_has_cv( get_current_user_id() ) ) :
	$post_id = $candidate->ID;

	$personal_name          = $candidate->post_title;
	$personal               = get_post_meta( $post_id, 'weblizar_candidate_personal', true );
	$personal_last_name     = isset( $personal['lastname'] ) ? esc_attr( $personal['lastname'] ) : '';
	$personal_state         = isset( $personal['state'] ) ? esc_attr( $personal['state'] ) : '';
	$personal_city          = isset( $personal['city'] ) ? esc_attr( $personal['city'] ) : '';
	$personal_email         = isset( $personal['email'] ) ? esc_attr( $personal['email'] ) : '';
	$personal_mobile        = isset( $personal['mobile'] ) ? esc_attr( $personal['mobile'] ) : '';
	$personal_date_of_birth = isset( $personal['date_of_birth'] ) ? esc_attr( $personal['date_of_birth'] ) : '';
	$personal_location      = isset( $personal['location'] ) ? esc_attr( $personal['location'] ) : '';
	$personal_gender        = isset( $personal['gender'] ) ? esc_attr( $personal['gender'] ) : '';

	$document                = get_post_meta( $post_id, 'weblizar_candidate_document', true );
	$document_cv             = isset( $document['cv'] ) ? esc_attr( $document['cv'] ) : '';
	$document_latest_cv_date = isset( $document['latest_cv_date'] ) ? esc_attr( $document['latest_cv_date'] ) : '';

	$work_experience        = get_post_meta( $post_id, 'weblizar_candidate_work_experience', true );
	$profile_title          = isset( $work_experience['profile_title'] ) ? esc_attr( $work_experience['profile_title'] ) : '';
	$profile_summary        = isset( $work_experience['profile_summary'] ) ? esc_attr( $work_experience['profile_summary'] ) : '';
	$total_experience       = ( isset( $work_experience['total_experience'] ) && is_array( $work_experience['total_experience'] ) ) ? $work_experience['total_experience'] : array();
	$total_experience_year  = isset( $total_experience['year'] ) ? esc_attr( $total_experience['year'] ) : '';
	$total_experience_month = isset( $total_experience['month'] ) ? esc_attr( $total_experience['month'] ) : '';
	$salary                 = isset( $work_experience['salary'] ) ? esc_attr( $work_experience['salary'] ) : '';
	$notice_period          = isset( $work_experience['notice_period'] ) ? esc_attr( $work_experience['notice_period'] ) : '';
	$last_working_day       = isset( $work_experience['last_working_day'] ) ? esc_attr( $work_experience['last_working_day'] ) : '';

	$employment = get_post_meta( $post_id, 'weblizar_candidate_employment', true );

	$education = get_post_meta( $post_id, 'weblizar_candidate_education', true );

	$skills = get_post_meta( $post_id, 'weblizar_candidate_skills', true );

	$certification = get_post_meta( $post_id, 'weblizar_candidate_certification', true );

	$desired_job         = get_post_meta( $post_id, 'weblizar_candidate_desired_job', true );
	$locations           = ( isset( $desired_job['locations'] ) && is_array( $desired_job['locations'] ) ) ? $desired_job['locations'] : array();
	$locations_string    = implode( ', ', $locations );
	$desired_industry    = isset( $desired_job['industry'] ) ? esc_attr( $desired_job['industry'] ) : '';
	$desired_departments = ( isset( $desired_job['departments'] ) && is_array( $desired_job['departments'] ) ) ? $desired_job['departments'] : array();
	$desired_salary      = isset( $desired_job['salary'] ) ? esc_attr( $desired_job['salary'] ) : '';

	$desired_job_types   = ( isset( $desired_job['job_types'] ) && is_array( $desired_job['job_types'] ) ) ? $desired_job['job_types'] : array();
?>
<div class="col-md-12 card p-3 mt-3">
	<header>
		<div class="weblizar-cv-heading p-3">
			<span><?php esc_html_e( 'Your CV', WEBLIZAR_DOMAIN ); ?></span>
		</div>
	</header>
	<form method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="weblizar-cv-update-form" class="weblizar-cv-update-form" enctype="multipart/form-data">
		<?php $nonce = wp_create_nonce( 'cv-update' ); ?>
        <input type="hidden" name="cv-update" value="<?php echo esc_attr( $nonce ); ?>">
        <input type="hidden" name="action" value="weblizar-cv-update">

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Personal', WEBLIZAR_DOMAIN ); ?></span></div>
            <div class="row mt-2">
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_name"><?php esc_html_e( 'Name', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_name" id="weblizar_candidate_personal_name" class="w-100 d-block col" value="<?php echo esc_attr($personal_name); ?>">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_last_name"><?php esc_html_e( 'Last Name', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_last_name" id="weblizar_candidate_personal_last_name" class="w-100 d-block col" value="<?php echo esc_attr($personal_last_name); ?>">
				</div>
			</div>
            <div class="row mt-2">
            	<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_email"><?php esc_html_e( 'Email Address', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="email" name="candidate_personal_email" id="weblizar_candidate_personal_email" class="w-100 d-block col" value="<?php echo esc_attr($personal_email); ?>">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_mobile"><?php esc_html_e( 'Mobile', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_mobile" id="weblizar_candidate_personal_mobile" class="w-100 d-block col" value="<?php echo esc_attr($personal_mobile); ?>">
				</div>
			</div>
			<div class="row mt-2">
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_date_of_birth"><?php esc_html_e( 'Date of Birth', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="date" name="candidate_personal_date_of_birth" id="weblizar_candidate_personal_date_of_birth" class="w-100 d-block col" value="<?php echo esc_attr($personal_date_of_birth); ?>">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_gender"><?php esc_html_e( 'Gender', WEBLIZAR_DOMAIN ); ?>:</label>
					<select name="candidate_personal_gender" id="weblizar_candidate_personal_gender" class="w-100 d-block col" value="<?php echo esc_attr( $personal_name ); ?>">
					<?php foreach( Weblizar_Helper::get_gender_list() as $key => $value ) : ?>
						<option value="<?php echo esc_attr($key); ?>" <?php selected( $personal_gender, $key, true ); ?>><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row mt-2">
            	<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_state"><?php esc_html_e( 'State', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_state" id="weblizar_candidate_personal_state" class="w-100 d-block col" value="<?php echo esc_attr($personal_state); ?>">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_city"><?php esc_html_e( 'City', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_city" id="weblizar_candidate_personal_city" class="w-100 d-block col" value="<?php echo esc_attr($personal_city); ?>">
				</div>
			</div>
            <div class="row mt-2">
				<div class="form-group col-sm-12">
					<label for="weblizar_candidate_personal_location"><?php esc_html_e( 'Location', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_location" id="weblizar_candidate_personal_location" class="w-100 d-block col" value="<?php echo esc_attr($personal_location); ?>">
				</div>
			</div>
		</div>



        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Upload CV', WEBLIZAR_DOMAIN ); ?></span></div>
			<?php if ( ! empty ( $document_cv ) ) { ?>
				<a href="<?php echo wp_get_attachment_url( $document_cv ); ?>" target="_blank" class="font-weight-bold"><?php esc_html_e( 'Latest CV', WEBLIZAR_DOMAIN );
						if ( ! empty( $document_latest_cv_date ) ) {
							echo " " . esc_html__( 'uploaded on', WEBLIZAR_DOMAIN ) . " " . date_format( date_create( $document_latest_cv_date ), "d-m-Y" );
						} ?>
				</a>
				<a href="<?php echo wp_get_attachment_url( $document_cv ); ?>" download class="btn btn-primary">Download CV From Here <i class="fa fa-download"></i></a>
			<?php } ?>
            <div class="row mt-2">
				<div class="form-group col-sm-12">
                    <label for="weblizar_candidate_document_cv" class="col-form-label"><?php esc_html_e( 'CV in PDF, DOC or DOCX format', WEBLIZAR_DOMAIN ); ?>:</label><br>
                    <input name="candidate_document_cv" type="file" id="weblizar_candidate_document_cv" class="w-100 d-block col">
				</div>
			</div>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Experience', WEBLIZAR_DOMAIN ); ?></span></div>
            <div class="row mt-2">
				<div class="form-group col-sm-12">
					<label for="weblizar_candidate_work_experience_profile_title"><?php esc_html_e( 'Profile Title', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_work_experience_profile_title" id="weblizar_candidate_work_experience_profile_title" class="w-100 d-block col" value="<?php echo esc_attr($profile_title); ?>">
				</div>
			</div>
            <div class="row mt-2">
				<div class="form-group col-sm-12">
					<label for="weblizar_candidate_work_experience_profile_summary"><?php esc_html_e( 'Profile Summary', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_work_experience_profile_summary" id="weblizar_candidate_work_experience_profile_summary" class="w-100 d-block col" value="<?php echo esc_attr($profile_summary); ?>">
				</div>
			</div>
			<div class="row mt-2">
				<div class="form-group col-sm-12">
					<label for="weblizar_candidate_work_experience_total_experience"><?php esc_html_e( 'Total Experience', WEBLIZAR_DOMAIN ); ?>:</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<select name="candidate_work_experience_total_experience[year]" id="weblizar_candidate_work_experience_total_experience_year" class="w-100 d-block col">
					<?php foreach( Weblizar_Helper::total_experience_years() as $key => $value ) : ?>
						<option <?php selected( $key, $total_experience_year ); ?> value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group col-sm-6">
					<select name="candidate_work_experience_total_experience[month]" id="weblizar_candidate_work_experience_total_experience_month" class="w-100 d-block col">
					<?php foreach( Weblizar_Helper::total_experience_months() as $key => $value ) : ?>
						<option <?php selected( $key, $total_experience_month ); ?> value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row mt-2">
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_work_experience_salary"><?php esc_html_e( 'Current / Latest Annual Salary', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_work_experience_salary" id="weblizar_candidate_work_experience_salary" class="w-100 d-block col" value="<?php echo esc_attr($salary); ?>">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_work_experience_notice_period"><?php esc_html_e( 'Notice Period', WEBLIZAR_DOMAIN ); ?>:</label>
					<select name="candidate_work_experience_notice_period" id="weblizar_candidate_work_experience_notice_period" class="w-100 d-block col">
					<?php foreach( Weblizar_Helper::notice_period_list() as $key => $value ) : ?>
						<option <?php selected( $key, $notice_period ); ?> value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-12 mt-2 weblizar_last_working_day float-right">
					<div class="row">
						<div class="col-md-6"></div>
						<div class="form-group col-md-6">
							<label for="weblizar_candidate_work_experience_last_working_day"><?php esc_html_e( 'Last working day', WEBLIZAR_DOMAIN ); ?>:</label>
							<input type="date" name="candidate_work_experience_last_working_day" id="weblizar_candidate_work_experience_last_working_day" class="w-100 d-block col" value="<?php echo esc_attr($last_working_day); ?>">
						</div>
					</div>
				</div>
			</div>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Employment', WEBLIZAR_DOMAIN ); ?></span></div>
			<div id="weblizar_candidate_employment_rows">
				<?php if ( is_array( $employment ) && count ( $employment ) > 0 ) :
						foreach( $employment as $key => $value ) : 
							$job_title     = isset( $value['job_title'] ) ? esc_attr( $value['job_title'] ) : '';
							$company_name  = isset( $value['company_name'] ) ? esc_attr( $value['company_name'] ) : '';
							$industry      = isset( $value['industry'] ) ? esc_attr( $value['industry'] ) : '';
							$duration_from = isset( $value['duration_from'] ) ? esc_attr( $value['duration_from'] ) : '';
							$duration_to   = isset( $value['duration_to'] ) ? esc_attr( $value['duration_to'] ) : '';
						?>
				<div class="row weblizar_candidate_employment_row mt-3">
					<div class="col-sm-12 mt-2">
						<span class="candidate_employment_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Job Title', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_employment_job_title[]" class="w-100 d-block col" value="<?php echo esc_attr($job_title); ?>">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Company Name', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_employment_company_name[]" class="w-100 d-block col" value="<?php echo esc_attr($company_name); ?>">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Industry', WEBLIZAR_DOMAIN ); ?>:</label>
						<select name="candidate_employment_industry[]" class="w-100 d-block col">
						<?php foreach( Weblizar_Helper::industries() as $key => $value ) : ?>
							<option <?php selected( $key, $industry, true ); ?> value="<?php echo esc_attr($key); ?>"><?php esc_html_e( $value ); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-6 mt-2">
						<label><?php esc_html_e( 'Duration from', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="date" name="candidate_employment_duration_from[]" class="w-100 d-block col" value="<?php echo esc_attr($duration_from); ?>">
					</div>
					<div class="col-md-6 mt-2">
						<label><?php esc_html_e( 'Duration to', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="date" name="candidate_employment_duration_to[]" class="w-100 d-block col" value="<?php echo esc_attr($duration_to); ?>">
					</div>
				</div>
					<?php endforeach;
				else : ?>
				<div class="row weblizar_candidate_employment_row mt-3">
					<div class="col-sm-12 mt-2">
						<span class="candidate_employment_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Job Title', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_employment_job_title[]" class="w-100 d-block col">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Company Name', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_employment_company_name[]" class="w-100 d-block col">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Industry', WEBLIZAR_DOMAIN ); ?>:</label>
						<select name="candidate_employment_industry[]" class="w-100 d-block col">
						<?php foreach( Weblizar_Helper::industries() as $key => $value ) : ?>
							<option value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-6 mt-2">
						<label><?php esc_html_e( 'Duration from', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="date" name="candidate_employment_duration_from[]" class="w-100 d-block col">
					</div>
					<div class="col-md-6 mt-2">
						<label><?php esc_html_e( 'Duration to', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="date" name="candidate_employment_duration_to[]" class="w-100 d-block col">
					</div>
				</div>
				<?php endif; ?>
			</div>
			<button type="button" id="weblizar_candidate_employment_row_add_more" class="weblizar_row_add_more btn btn-sm"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Education', WEBLIZAR_DOMAIN ); ?></span></div>
			<div id="weblizar_candidate_education_rows">
				<?php if ( is_array( $education ) && count ( $education ) > 0 ) :
						foreach( $education as $key => $value ) :
							$specialization  = isset( $value['specialization'] ) ? esc_attr( $value['specialization'] ) : '';
							$institute_name  = isset( $value['institute_name'] ) ? esc_attr( $value['institute_name'] ) : '';
							$course_type     = isset( $value['course_type'] ) ? esc_attr( $value['course_type'] ) : '';
							$year_of_passing = isset( $value['year_of_passing'] ) ? esc_attr( $value['year_of_passing'] ) : '';
						?>
				<div class="row weblizar_candidate_education_row mt-3">
					<div class="col-sm-6 mt-2">
						<span class="candidate_education_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Education Specialization', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_specialization[]" class="w-100 d-block col" value="<?php echo esc_attr( $specialization ); ?>">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Institute Name', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_institute_name[]" class="w-100 d-block col" value="<?php echo esc_attr($institute_name); ?>">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Course Type', WEBLIZAR_DOMAIN ); ?>:</label>
						<select name="candidate_education_course_type[]" class="w-100 d-block col">
						<?php foreach( Weblizar_Helper::course_types() as $key => $value ) : ?>
							<option <?php selected( $key, $course_type, true ); ?> value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Year of Passing', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_year_of_passing[]" class="w-100 d-block col" placeholder="<?php esc_attr_e( 'Format: XXXX', WEBLIZAR_DOMAIN ); ?>" value="<?php echo esc_attr($year_of_passing); ?>">
					</div>
				</div>
					<?php endforeach;
				else : ?>
				<div class="row weblizar_candidate_education_row mt-3">
					<div class="col-sm-6 mt-2">
						<span class="candidate_education_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Education Specialization', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_specialization[]" class="w-100 d-block col">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Institute Name', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_institute_name[]" class="w-100 d-block col">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Course Type', WEBLIZAR_DOMAIN ); ?>:</label>
						<select name="candidate_education_course_type[]" class="w-100 d-block col">
						<?php foreach( Weblizar_Helper::course_types() as $key => $value ) : ?>
							<option value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Year of Passing', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_year_of_passing[]" class="w-100 d-block col" placeholder="<?php esc_attr_e( 'Format: XXXX', WEBLIZAR_DOMAIN ); ?>">
					</div>
				</div>
				<?php endif; ?>
			</div>
			<button type="button" id="weblizar_candidate_education_row_add_more" class="weblizar_row_add_more btn btn-sm"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Skills', WEBLIZAR_DOMAIN ); ?></span></div>
			<div id="weblizar_candidate_skills_rows">
				<?php if ( is_array( $skills ) && count ( $skills ) > 0 ) :
						foreach( $skills as $value ) : ?>
				<div class="row weblizar_candidate_skills_row">
					<div class="col-sm-12 mt-2">
						<span class="candidate_skills_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Skill', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_skills[]" class="w-100 d-block col" value="<?php echo esc_attr( $value ); ?>">
					</div>
				</div>
					<?php endforeach;
				else : ?>
				<div class="row weblizar_candidate_skills_row">
					<div class="col-sm-12 mt-2">
						<span class="candidate_skills_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Skill', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_skills[]" class="w-100 d-block col">
					</div>
				</div>
				<?php endif; ?>
			</div>
			<button type="button" id="weblizar_candidate_skills_row_add_more" class="weblizar_row_add_more btn btn-sm"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Certification', WEBLIZAR_DOMAIN ); ?></span></div>
			<div id="weblizar_candidate_certification_rows">
				<?php if ( is_array( $certification ) && count ( $certification ) > 0 ) :
						foreach( $certification as $key => $value ) :
							$certification_title   = isset( $value['certification_title'] ) ? esc_attr( $value['certification_title'] ) : '';
							$year_of_certification = isset( $value['year_of_certification'] ) ? esc_attr( $value['year_of_certification'] ) : '';
						?>
				<div class="row weblizar_candidate_certification_row">
					<div class="col-sm-8 mt-2">
						<span class="candidate_certification_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Certification Title', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_certification_title[]" class="w-100 d-block col" value="<?php echo esc_attr( $certification_title ); ?>">
					</div>
					<div class="col-sm-4 mt-2">
						<label><?php esc_html_e( 'Year of Certification', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="number" step="1" name="candidate_certification_year[]" class="w-100 d-block col" placeholder="<?php esc_attr_e( 'Format: XXXX', WEBLIZAR_DOMAIN ); ?>" value="<?php echo esc_attr( $year_of_certification ); ?>">
					</div>
				</div>
					<?php endforeach;
				else : ?>
				<div class="row weblizar_candidate_certification_row">
					<div class="col-sm-8 mt-2">
						<span class="candidate_certification_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Certification Title', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_certification_title[]" class="w-100 d-block col">
					</div>
					<div class="col-sm-4 mt-2">
						<label><?php esc_html_e( 'Year of Certification', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="number" step="1" name="candidate_certification_year[]" class="w-100 d-block col" placeholder="<?php esc_attr_e( 'Format: XXXX', WEBLIZAR_DOMAIN ); ?>">
					</div>
				</div>
				<?php endif; ?>
			</div>
			<button type="button" id="weblizar_candidate_certification_row_add_more" class="weblizar_row_add_more btn btn-sm"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Desired Job Details', WEBLIZAR_DOMAIN ); ?></span></div>
			<div class="row">
				<div class="col-sm-12 mt-2">
					<label for="weblizar_candidate_desired_job_locations"><?php esc_html_e( 'Job Locations', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_desired_job_locations" id="weblizar_candidate_desired_job_locations" class="w-100 d-block col" value="<?php echo esc_attr( $locations_string ); ?>" placeholder="<?php esc_attr_e( 'Separated by comma', WEBLIZAR_DOMAIN ); ?>">
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_industry"><?php esc_html_e( 'Industry', WEBLIZAR_DOMAIN ); ?>:</label>
					<select name="candidate_desired_job_industry" id="weblizar_candidate_desired_job_industry" class="w-100 d-block col">
					<?php foreach( Weblizar_Helper::industries() as $key => $value ) : ?>
						<option <?php selected( $key, $desired_industry, true ); ?> value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_salary"><?php esc_html_e( 'Salary', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_desired_job_salary" id="weblizar_candidate_desired_job_salary" class="w-100 d-block col" value="<?php echo esc_attr($desired_salary); ?>">
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_departments"><?php esc_html_e( 'Departments', WEBLIZAR_DOMAIN ); ?>:</label><br>
					<select data-placeholder="<?php esc_attr_e( 'Select departments', WEBLIZAR_DOMAIN ); ?>" name="candidate_desired_job_departments[]" id="weblizar_candidate_desired_job_departments" class="w-100 d-block col" multiple>
					<?php $department_array = Weblizar_Helper::departments();
						foreach( $department_array as $key => $value ) : ?>
						<option <?php selected( true, in_array( $key, $desired_departments ), true ); ?> value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_types"><?php esc_html_e( 'Job Types', WEBLIZAR_DOMAIN ); ?>:</label>
					<select data-placeholder="<?php esc_attr_e( 'Select job types', WEBLIZAR_DOMAIN ); ?>" name="candidate_desired_job_types[]" id="weblizar_candidate_desired_job_types" class="w-100 d-block col" multiple>
					<?php $job_type_array = Weblizar_Helper::job_types();
						foreach( $job_type_array as $key => $value ) : ?>
						<option <?php selected( true, in_array( $key, $desired_job_types ), true ); ?> value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>

		<div class="float-right weblizar-cv-submit-block">
			<button type="submit" class="weblizar-cv-update-submit"><?php esc_html_e( 'Update CV', WEBLIZAR_DOMAIN ); ?></button>
		</div>
	</form>
	<div class="float-left">
		<a href="javascript:void(0)" class="weblizar-cv-more-options"><?php esc_html_e( 'More Options', WEBLIZAR_DOMAIN ); ?></a>
		<div class="mt-2 weblizar-cv-delete">
        	<button type="button" id="weblizar-cv-delete-button" class="btn btn-danger" data-message="<?php esc_attr_e( 'Are you sure to delete your CV? All of your job applications will also be removed.', WEBLIZAR_DOMAIN ); ?>"><?php esc_html_e( 'Delete CV', WEBLIZAR_DOMAIN ); ?></button>
		</div>
	</div>
</div>
<?php else : ?>
<div class="col-sm-12 col-md-12 card p-3 mt-3">
	<header>
		<div class="weblizar-cv-heading p-3">
			<span><?php esc_html_e( 'Register your CV', WEBLIZAR_DOMAIN ); ?></span>
		</div>
	</header>
	<form method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="weblizar-cv-form" class="weblizar-cv-form">
		<?php $nonce = wp_create_nonce( 'cv' ); ?>
        <input type="hidden" name="cv" value="<?php echo esc_attr($nonce); ?>">
        <input type="hidden" name="action" value="weblizar-cv">

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Personal', WEBLIZAR_DOMAIN ); ?>:</span></div>
            <div class="row mt-2">
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_name"><?php esc_html_e( 'Name', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_name" id="weblizar_candidate_personal_name" class="w-100 d-block col">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_last_name"><?php esc_html_e( 'Last Name', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_last_name" id="weblizar_candidate_last_name" class="w-100 d-block col">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_email"><?php esc_html_e( 'Email Address', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="email" name="candidate_personal_email" id="weblizar_candidate_personal_email" class="w-100 d-block col">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_mobile"><?php esc_html_e( 'Mobile', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_mobile" id="weblizar_candidate_personal_mobile" class="w-100 d-block col">
				</div>
			</div>
            <div class="row mt-2">
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_date_of_birth"><?php esc_html_e( 'Date of Birth', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="date" name="candidate_personal_date_of_birth" id="weblizar_candidate_personal_date_of_birth" class="w-100 d-block col">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_gender"><?php esc_html_e( 'Gender', WEBLIZAR_DOMAIN ); ?>:</label>
					<select name="candidate_personal_gender" id="weblizar_candidate_personal_gender" class="w-100 d-block col">
					<?php foreach( Weblizar_Helper::get_gender_list() as $key => $value ) : ?>
						<option value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row mt-2">
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_state"><?php esc_html_e( 'State', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_state" id="weblizar_candidate_personal_state" class="w-100 d-block col">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_personal_city"><?php esc_html_e( 'City', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_city" id="weblizar_candidate_personal_city" class="w-100 d-block col">
				</div>
			</div>
            <div class="row mt-2">
				<div class="form-group col-sm-12">
					<label for="weblizar_candidate_personal_location"><?php esc_html_e( 'Address', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_location" id="weblizar_candidate_personal_location" class="w-100 d-block col">
				</div>
			</div>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Upload Cv', WEBLIZAR_DOMAIN ); ?></span></div>
            <div class="row mt-2">
				<div class="form-group col-sm-12">
                    <label for="weblizar_candidate_document_cv" class="col-form-label"><?php esc_html_e( 'CV in PDF, DOC or DOCX format', WEBLIZAR_DOMAIN ); ?>:</label><br>
                    <input name="candidate_document_cv" type="file" id="weblizar_candidate_document_cv" class="w-100 d-block col">
				</div>
			</div>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Experience', WEBLIZAR_DOMAIN ); ?></span></div>
            <div class="row mt-2">
				<div class="form-group col-sm-12">
					<label for="weblizar_candidate_work_experience_profile_title"><?php esc_html_e( 'Profile Title', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_work_experience_profile_title" id="weblizar_candidate_work_experience_profile_title" class="w-100 d-block col">
				</div>
			</div>
            <div class="row mt-2">
				<div class="form-group col-sm-12">
					<label for="weblizar_candidate_work_experience_profile_summary"><?php esc_html_e( 'Profile Summary', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_work_experience_profile_summary" id="weblizar_candidate_work_experience_profile_summary" class="w-100 d-block col">
				</div>
			</div>
			<div class="row mt-2">
				<div class="form-group col-sm-12">
					<label for="weblizar_candidate_work_experience_total_experience"><?php esc_html_e( 'Total Experience', WEBLIZAR_DOMAIN ); ?>:</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<select name="candidate_work_experience_total_experience[year]" id="weblizar_candidate_work_experience_total_experience_year" class="w-100 d-block col">
					<?php foreach( Weblizar_Helper::total_experience_years() as $key => $value ) : ?>
						<option value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group col-sm-6">
					<select name="candidate_work_experience_total_experience[month]" id="weblizar_candidate_work_experience_total_experience_month" class="w-100 d-block col">
					<?php foreach( Weblizar_Helper::total_experience_months() as $key => $value ) : ?>
						<option value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row mt-2">
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_work_experience_salary"><?php esc_html_e( 'Current / Latest Annual Salary', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_work_experience_salary" id="weblizar_candidate_work_experience_salary" class="w-100 d-block col">
				</div>
				<div class="form-group col-sm-6">
					<label for="weblizar_candidate_work_experience_notice_period"><?php esc_html_e( 'Notice Period', WEBLIZAR_DOMAIN ); ?>:</label>
					<select name="candidate_work_experience_notice_period" id="weblizar_candidate_work_experience_notice_period" class="w-100 d-block col">
					<?php foreach( Weblizar_Helper::notice_period_list() as $key => $value ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-md-12 mt-2 weblizar_last_working_day float-right">
					<div class="row">
						<div class="col-md-6"></div>
						<div class="form-group col-md-6">
							<label for="weblizar_candidate_work_experience_last_working_day"><?php esc_html_e( 'Last working day', WEBLIZAR_DOMAIN ); ?>:</label>
							<input type="date" name="candidate_work_experience_last_working_day" id="weblizar_candidate_work_experience_last_working_day" class="w-100 d-block col">
						</div>
					</div>
				</div>
			</div>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Employment', WEBLIZAR_DOMAIN ); ?></span></div>
			<div id="weblizar_candidate_employment_rows">
				<div class="row weblizar_candidate_employment_row mt-3">
					<div class="col-sm-12 mt-2">
						<span class="candidate_employment_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Job Title', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_employment_job_title[]" class="w-100 d-block col">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Company Name', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_employment_company_name[]" class="w-100 d-block col">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Industry', WEBLIZAR_DOMAIN ); ?>:</label>
						<select name="candidate_employment_industry[]" class="w-100 d-block col">
						<?php foreach( Weblizar_Helper::industries() as $key => $value ) : ?>
							<option value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-6 mt-2">
						<label><?php esc_html_e( 'Duration from', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="date" name="candidate_employment_duration_from[]" class="w-100 d-block col">
					</div>
					<div class="col-md-6 mt-2">
						<label><?php esc_html_e( 'Duration to', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="date" name="candidate_employment_duration_to[]" class="w-100 d-block col">
					</div>
				</div>
			</div>
			<button type="button" id="weblizar_candidate_employment_row_add_more" class="weblizar_row_add_more btn btn-sm"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Education', WEBLIZAR_DOMAIN ); ?></span></div>
			<div id="weblizar_candidate_education_rows">
				<div class="row weblizar_candidate_education_row mt-3">
					<div class="col-sm-6 mt-2">
						<span class="candidate_education_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Education Specialization', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_specialization[]" class="w-100 d-block col">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Institute Name', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_institute_name[]" class="w-100 d-block col">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Course Type', WEBLIZAR_DOMAIN ); ?>:</label>
						<select name="candidate_education_course_type" class="w-100 d-block col">
						<?php foreach( Weblizar_Helper::course_types() as $key => $value ) : ?>
							<option value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Year of Passing', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_year_of_passing[]" class="w-100 d-block col" placeholder="<?php esc_attr_e( 'Format: XXXX', WEBLIZAR_DOMAIN ); ?>">
					</div>
				</div>
			</div>
			<button type="button" id="weblizar_candidate_education_row_add_more" class="weblizar_row_add_more btn btn-sm"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Skills', WEBLIZAR_DOMAIN ); ?></span></div>
			<div id="weblizar_candidate_skills_rows">
				<div class="row weblizar_candidate_skills_row">
					<div class="col-sm-12 mt-2">
						<span class="candidate_skills_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Skill', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_skills[]" class="w-100 d-block col">
					</div>
				</div>
			</div>
			<button type="button" id="weblizar_candidate_skills_row_add_more" class="weblizar_row_add_more btn btn-sm"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Certification', WEBLIZAR_DOMAIN ); ?></span></div>
			<div id="weblizar_candidate_certification_rows">
				<div class="row weblizar_candidate_certification_row">
					<div class="col-sm-8 mt-2">
						<span class="candidate_certification_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Certification Title', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_certification_title[]" class="w-100 d-block col">
					</div>
					<div class="col-sm-4 mt-2">
						<label><?php esc_html_e( 'Year of Certification', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="number" step="1" name="candidate_certification_year[]" class="w-100 d-block col" placeholder="<?php esc_attr_e( 'Format: XXXX', WEBLIZAR_DOMAIN ); ?>">
					</div>
				</div>
			</div>
			<button type="button" id="weblizar_candidate_certification_row_add_more" class="weblizar_row_add_more btn btn-sm"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>

        <div class="card p-3 mb-4">
            <div class="weblizar-cv-section-heading"><span><?php esc_html_e( 'Desired Job Details', WEBLIZAR_DOMAIN ); ?></span></div>
			<div class="row">
				<div class="col-sm-12 mt-2">
					<label for="weblizar_candidate_desired_job_locations"><?php esc_html_e( 'Job Locations', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_desired_job_locations" id="weblizar_candidate_desired_job_locations" class="w-100 d-block col" placeholder="<?php esc_attr_e( 'Separated by comma', WEBLIZAR_DOMAIN ); ?>">
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_industry"><?php esc_html_e( 'Industry', WEBLIZAR_DOMAIN ); ?>:</label>
					<select name="candidate_desired_job_industry" id="weblizar_candidate_desired_job_industry" class="w-100 d-block col">
					<?php foreach( Weblizar_Helper::industries() as $key => $value ) : ?>
						<option value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_salary"><?php esc_html_e( 'Salary', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_desired_job_salary" id="weblizar_candidate_desired_job_salary" class="w-100 d-block col">
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_departments"><?php esc_html_e( 'Departments', WEBLIZAR_DOMAIN ); ?>:</label><br>
					<select data-placeholder="<?php esc_attr_e( 'Select departments', WEBLIZAR_DOMAIN ); ?>" name="candidate_desired_job_departments[]" id="weblizar_candidate_desired_job_departments" class="w-100 d-block col" multiple>
					<?php $department_array = Weblizar_Helper::departments();
						foreach( $department_array as $key => $value ) : ?>
						<option value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_types"><?php esc_html_e( 'Job Types', WEBLIZAR_DOMAIN ); ?>:</label>
					<select data-placeholder="<?php esc_attr_e( 'Select job types', WEBLIZAR_DOMAIN ); ?>" name="candidate_desired_job_types[]" id="weblizar_candidate_desired_job_types" class="w-100 d-block col" multiple>
					<?php $job_type_array = Weblizar_Helper::job_types();
						foreach( $job_type_array as $key => $value ) : ?>
						<option value="<?php echo esc_attr($key); ?>"><?php esc_html_e($value); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>

		<div class="float-right weblizar-cv-submit-block">
			<button type="submit" class="weblizar-cv-submit"><?php esc_html_e( 'Register CV', WEBLIZAR_DOMAIN ); ?></button>
		</div>
	</form>
</div>
<?php endif; ?>