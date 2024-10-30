<?php
defined( 'ABSPATH' ) || die();

require_once WEBLIZAR_PLUGIN_DIR_PATH . 'includes/Weblizar_Helper.php';

class Weblizar_Candidate {
	/**
	 * Add metaboxes to candidate post type
	 *
	 * @return void
	 */
	public static function add_meta_boxes() {
		add_meta_box( 'weblizar_candidate_account', esc_html__( 'Account Settings', WEBLIZAR_DOMAIN ), array( 'Weblizar_Candidate', 'account_html' ), 'candidate', 'advanced' );
		add_meta_box( 'weblizar_candidate_personal', esc_html__( 'Personal', WEBLIZAR_DOMAIN ), array( 'Weblizar_Candidate', 'personal_html' ), 'candidate', 'advanced' );
		add_meta_box( 'weblizar_candidate_document', esc_html__( 'Document', WEBLIZAR_DOMAIN ), array( 'Weblizar_Candidate', 'document_html' ), 'candidate', 'side' );
		add_meta_box( 'weblizar_candidate_work_experience', esc_html__( 'Work Experience', WEBLIZAR_DOMAIN ), array( 'Weblizar_Candidate', 'work_experience_html' ), 'candidate', 'advanced' );
		add_meta_box( 'weblizar_candidate_employment', esc_html__( 'Employment', WEBLIZAR_DOMAIN ), array( 'Weblizar_Candidate', 'employment_html' ), 'candidate', 'advanced' );
		add_meta_box( 'weblizar_candidate_education', esc_html__( 'Education', WEBLIZAR_DOMAIN ), array( 'Weblizar_Candidate', 'education_html' ), 'candidate', 'advanced' );
		add_meta_box( 'weblizar_candidate_skills', esc_html__( 'Skills', WEBLIZAR_DOMAIN ), array( 'Weblizar_Candidate', 'skills_html' ), 'candidate', 'side' );
		add_meta_box( 'weblizar_candidate_certification', esc_html__( 'Certification', WEBLIZAR_DOMAIN ), array( 'Weblizar_Candidate', 'certification_html' ), 'candidate', 'advanced' );
		add_meta_box( 'weblizar_candidate_desired_job', esc_html__( 'Desired Job Details', WEBLIZAR_DOMAIN ), array( 'Weblizar_Candidate', 'desired_job_html' ), 'candidate', 'advanced' );
	}

	/**
	 * Render html of account metabox
	 *
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function account_html( $post ) {
		$post_id = $post->ID;
		$user_id = get_post_meta( $post_id, 'weblizar_candidate_user_id', true );
		$user    = get_user_by( 'id', $user_id );
		if ( $user ) {
			$email    = $user->user_email;
			$username = $user->user_login;
		} else {
			$email    = '';
			$username = '';
		}
		?>
		<?php wp_nonce_field( 'save_candidate_meta', 'candidate_meta' ); ?>
		<div class="weblizar" id="weblizar_candidate_account">
			<div class="row mt-2">
				<div class="col-sm-6">
					<?php if ( $username ) : ?>
					<label><?php esc_html_e( 'Username', WEBLIZAR_DOMAIN ); ?>:</label><br>
					<span><strong><?php esc_html_e( $username ); ?></strong></span>
					<?php else : ?>
					<label for="weblizar_candidate_account_username"><?php esc_html_e( 'Username', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_account_username" id="weblizar_candidate_account_username" class="widefat" value="<?php echo esc_attr( $username ); ?>" required>
					<?php endif; ?>
				</div>
				<div class="col-sm-6">
					<label for="weblizar_candidate_account_email"><?php esc_html_e( 'Email Address', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="email" name="candidate_account_email" id="weblizar_candidate_account_email" class="widefat" value="<?php echo esc_attr( $email ); ?>" required>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-sm-6">
					<label for="weblizar_candidate_account_password"><?php esc_html_e( 'Password', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="password" name="candidate_account_password" id="weblizar_candidate_account_password" class="widefat">
				</div>
				<div class="col-sm-6">
					<label for="weblizar_candidate_account_confirm_password"><?php esc_html_e( 'Confirm Password', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="password" name="candidate_account_confirm_password" id="weblizar_candidate_account_confirm_password" class="widefat">
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render html of personal metabox
	 *
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function personal_html( $post ) {
		$post_id       = $post->ID;
		$name          = $post->post_title;
		$personal      = get_post_meta( $post_id, 'weblizar_candidate_personal', true );
		$lastname      = isset( $personal['lastname'] ) ? esc_attr( $personal['lastname'] ) : '';
		$state         = isset( $personal['state'] ) ? esc_attr( $personal['state'] ) : '';
		$city          = isset( $personal['city'] ) ? esc_attr( $personal['city'] ) : '';
		$email         = isset( $personal['email'] ) ? esc_attr( $personal['email'] ) : '';
		$mobile        = isset( $personal['mobile'] ) ? esc_attr( $personal['mobile'] ) : '';
		$date_of_birth = isset( $personal['date_of_birth'] ) ? esc_attr( $personal['date_of_birth'] ) : '';
		$location      = isset( $personal['location'] ) ? esc_attr( $personal['location'] ) : '';
		$gender        = isset( $personal['gender'] ) ? esc_attr( $personal['gender'] ) : '';
		?>
		<div class="weblizar" id="weblizar_candidate_personal">
			<div class="row">
				<?php if ( $name ) : ?>
				<div class="col-sm-6">
					<label><?php esc_html_e( 'Name', WEBLIZAR_DOMAIN ); ?>:</label><br>
					<span><?php esc_html_e( $name ); ?></span>
				</div>
				<?php endif; ?>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_personal_last_name"><?php esc_html_e( 'Last Name', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_last_name" id="weblizar_candidate_personal_last_name" class="widefat" value="<?php echo esc_attr( $lastname ); ?>" required>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_personal_email"><?php esc_html_e( 'Email Address', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="email" name="candidate_personal_email" id="weblizar_candidate_personal_email" class="widefat" value="<?php echo esc_attr( $email ); ?>" required>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_personal_mobile"><?php esc_html_e( 'Mobile', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_mobile" id="weblizar_candidate_personal_mobile" class="widefat" value="<?php echo esc_attr( $mobile ); ?>">
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_personal_date_of_birth"><?php esc_html_e( 'Date of Birth', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="date" name="candidate_personal_date_of_birth" id="weblizar_candidate_personal_date_of_birth" class="widefat" value="<?php echo esc_attr( $date_of_birth ); ?>">
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_personal_state"><?php esc_html_e( 'State', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_state" id="weblizar_candidate_personal_state" class="widefat" value="<?php echo esc_attr( $state ); ?>" required>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_personal_city"><?php esc_html_e( 'City', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_city" id="weblizar_candidate_personal_city" class="widefat" value="<?php echo esc_attr( $city ); ?>" required>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_personal_location"><?php esc_html_e( 'Location', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_personal_location" id="weblizar_candidate_personal_location" class="widefat" value="<?php echo esc_attr( $location ); ?>">
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_personal_gender"><?php esc_html_e( 'Gender', WEBLIZAR_DOMAIN ); ?>:</label>
					<select name="candidate_personal_gender" id="weblizar_candidate_personal_gender" class="widefat">
					<?php foreach ( Weblizar_Helper::get_gender_list() as $key => $value ) : ?>
						<option <?php selected( $key, $gender ); ?> value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value ); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render html of document metabox
	 *
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function document_html( $post ) {
		$post_id                 = $post->ID;
		$document                = get_post_meta( $post_id, 'weblizar_candidate_document', true );
		$document_cv             = isset( $document['cv'] ) ? esc_attr( $document['cv'] ) : '';
		$document_latest_cv_date = isset( $document['latest_cv_date'] ) ? esc_attr( $document['latest_cv_date'] ) : '';
		?>
		<div class="weblizar" id="weblizar_candidate_document">
			<?php if ( ! empty( $document_cv ) ) { ?>
				<a href="<?php echo wp_get_attachment_url( $document_cv ); ?>" target="_blank" class="font-weight-bold">
									<?php
									esc_html_e( 'Latest CV', WEBLIZAR_DOMAIN );
									if ( ! empty( $document_latest_cv_date ) ) {
										echo ' ' . esc_html__( 'uploaded on', WEBLIZAR_DOMAIN ) . ' ' . date_format( date_create( $document_latest_cv_date ), 'd-m-Y' );
									}
									?>
				</a>
			<?php } ?>
			<div class="row mt-2">
				<div class="form-group col-sm-12">
					<label for="weblizar_candidate_document_cv" class="col-form-label"><?php esc_html_e( 'CV in PDF, DOC or DOCX format', WEBLIZAR_DOMAIN ); ?>:</label><br>
					<input name="candidate_document_cv" type="file" id="weblizar_candidate_document_cv" class="w-100 d-block col">
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render html of work_experience metabox
	 *
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function work_experience_html( $post ) {
		$post_id         = $post->ID;
		$work_experience = get_post_meta( $post_id, 'weblizar_candidate_work_experience', true );
		$profile_title   = isset( $work_experience['profile_title'] ) ? esc_attr( $work_experience['profile_title'] ) : '';
		$profile_summary = isset( $work_experience['profile_summary'] ) ? esc_attr( $work_experience['profile_summary'] ) : '';
		/* An associative array with keys: years and months */
		$total_experience       = ( isset( $work_experience['total_experience'] ) && is_array( $work_experience['total_experience'] ) ) ? array_map( 'sanitize_text_field', $work_experience['total_experience'] ) : array();
		$total_experience_year  = isset( $total_experience['year'] ) ? esc_attr( $total_experience['year'] ) : '';
		$total_experience_month = isset( $total_experience['month'] ) ? esc_attr( $total_experience['month'] ) : '';
		$salary                 = isset( $work_experience['salary'] ) ? esc_attr( $work_experience['salary'] ) : '';
		$notice_period          = isset( $work_experience['notice_period'] ) ? esc_attr( $work_experience['notice_period'] ) : '';
		/* If notice period is "Currently Serving Notice Period" */
		$last_working_day = isset( $work_experience['last_working_day'] ) ? esc_attr( $work_experience['last_working_day'] ) : '';
		?>
		<div class="weblizar" id="weblizar_candidate_work_experience">
			<div class="row">
				<div class="col-sm-12 mt-2">
					<label for="weblizar_candidate_work_experience_profile_title"><?php esc_html_e( 'Profile Title', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_work_experience_profile_title" id="weblizar_candidate_work_experience_profile_title" class="widefat" value="<?php echo esc_attr( $profile_title ); ?>">
				</div>
				<div class="col-sm-12 mt-2">
					<label for="weblizar_candidate_work_experience_profile_summary"><?php esc_html_e( 'Profile Summary', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_work_experience_profile_summary" id="weblizar_candidate_work_experience_profile_summary" class="widefat" value="<?php echo esc_attr( $profile_summary ); ?>">
				</div>
				<div class="col-sm-12 mt-2">
					<label for="weblizar_candidate_work_experience_total_experience"><?php esc_html_e( 'Total Experience', WEBLIZAR_DOMAIN ); ?>:</label>
				</div>
				<div class="col-sm-6">
					<select name="candidate_work_experience_total_experience[year]" id="weblizar_candidate_work_experience_total_experience_year" class="widefat">
					<?php foreach ( Weblizar_Helper::total_experience_years() as $key => $value ) : ?>
						<option <?php selected( $key, $total_experience_year ); ?> value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value ); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-6">
					<select name="candidate_work_experience_total_experience[month]" id="weblizar_candidate_work_experience_total_experience_month" class="widefat">
					<?php foreach ( Weblizar_Helper::total_experience_months() as $key => $value ) : ?>
						<option <?php selected( $key, $total_experience_month ); ?> value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value ); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_work_experience_salary"><?php esc_html_e( 'Current / Latest Annual Salary', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_work_experience_salary" id="weblizar_candidate_work_experience_salary" class="widefat" value="<?php echo esc_attr( $salary ); ?>">
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_work_experience_notice_period"><?php esc_html_e( 'Notice Period', WEBLIZAR_DOMAIN ); ?>:</label>
					<select name="candidate_work_experience_notice_period" id="weblizar_candidate_work_experience_notice_period" class="widefat">
					<?php foreach ( Weblizar_Helper::notice_period_list() as $key => $value ) : ?>
						<option <?php selected( $key, $notice_period ); ?> value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value ); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="col-md-12 mt-2 weblizar_last_working_day float-right">
					<div class="row">
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<label for="weblizar_candidate_work_experience_last_working_day"><?php esc_html_e( 'Last working day', WEBLIZAR_DOMAIN ); ?>:</label>
							<input type="date" name="candidate_work_experience_last_working_day" id="weblizar_candidate_work_experience_last_working_day" class="widefat" value="<?php echo esc_attr( $last_working_day ); ?>">
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render html of employment metabox
	 *
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function employment_html( $post ) {
		$post_id = $post->ID;
		/* Array of array having keys: job_title, company_name, industry, duration_from, duration_to */
		$employment = get_post_meta( $post_id, 'weblizar_candidate_employment', true );
		?>
		<div class="weblizar" id="weblizar_candidate_employment">
			<div id="weblizar_candidate_employment_rows">
				<?php
				if ( is_array( $employment ) && count( $employment ) > 0 ) :
					foreach ( $employment as $key => $value ) :
						$job_title     = isset( $value['job_title'] ) ? esc_attr( $value['job_title'] ) : '';
						$company_name  = isset( $value['company_name'] ) ? esc_attr( $value['company_name'] ) : '';
						$industry      = isset( $value['industry'] ) ? esc_attr( $value['industry'] ) : '';
						$duration_from = isset( $value['duration_from'] ) ? esc_attr( $value['duration_from'] ) : '';
						$duration_to   = isset( $value['duration_to'] ) ? esc_attr( $value['duration_to'] ) : '';
						?>
				<div class="row weblizar_candidate_employment_row mt-2">
					<div class="col-sm-12 mt-2">
						<span class="candidate_employment_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Job Title', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_employment_job_title[]" class="widefat" value="<?php echo esc_attr( $job_title ); ?>">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Company Name', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_employment_company_name[]" class="widefat" value="<?php echo esc_attr( $company_name ); ?>">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Industry', WEBLIZAR_DOMAIN ); ?>:</label>
						<select name="candidate_employment_industry[]" class="widefat">
						<?php foreach ( Weblizar_Helper::industries() as $key => $value ) : ?>
							<option <?php selected( $key, $industry, true ); ?> value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value ); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-6 mt-2">
						<label><?php esc_html_e( 'Duration from', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="date" name="candidate_employment_duration_from[]" class="widefat" value="<?php echo esc_attr( $duration_from ); ?>">
					</div>
					<div class="col-md-6 mt-2">
						<label><?php esc_html_e( 'Duration to', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="date" name="candidate_employment_duration_to[]" class="widefat" value="<?php echo esc_attr( $duration_to ); ?>">
					</div>
				</div>
						<?php
					endforeach;
				else :
					?>
				<div class="row weblizar_candidate_employment_row mt-2">
					<div class="col-sm-12 mt-2">
						<span class="candidate_employment_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Job Title', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_employment_job_title[]" class="widefat">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Company Name', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_employment_company_name[]" class="widefat">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Industry', WEBLIZAR_DOMAIN ); ?>:</label>
						<select name="candidate_employment_industry" class="widefat">
						<?php foreach ( Weblizar_Helper::industries() as $key => $value ) : ?>
							<option value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value ); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-6 mt-2">
						<label><?php esc_html_e( 'Duration from', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="date" name="candidate_employment_duration_from" class="widefat">
					</div>
					<div class="col-md-6 mt-2">
						<label><?php esc_html_e( 'Duration to', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="date" name="candidate_employment_duration_to" class="widefat">
					</div>
				</div>
				<?php endif; ?>
			</div>
			<button type="button" id="weblizar_candidate_employment_row_add_more" class="weblizar_row_add_more"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>
		<?php
	}

	/**
	 * Render html of education metabox
	 *
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function education_html( $post ) {
		$post_id = $post->ID;
		/* Array of array having keys: education_specialization, institute_name, course_type, year_of_passing */
		$education = get_post_meta( $post_id, 'weblizar_candidate_education', true );
		?>
		<div class="weblizar" id="weblizar_candidate_education">
			<div id="weblizar_candidate_education_rows">
				<?php
				if ( is_array( $education ) && count( $education ) > 0 ) :
					foreach ( $education as $key => $value ) :
						$specialization  = isset( $value['specialization'] ) ? esc_attr( $value['specialization'] ) : '';
						$institute_name  = isset( $value['institute_name'] ) ? esc_attr( $value['institute_name'] ) : '';
						$course_type     = isset( $value['course_type'] ) ? esc_attr( $value['course_type'] ) : '';
						$year_of_passing = isset( $value['year_of_passing'] ) ? esc_attr( $value['year_of_passing'] ) : '';
						?>
				<div class="row weblizar_candidate_education_row">
					<div class="col-sm-6 mt-2">
						<span class="candidate_education_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Education Specialization', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_specialization[]" class="widefat" value="<?php echo esc_attr( $specialization ); ?>">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Institute Name', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_institute_name[]" class="widefat" value="<?php echo esc_attr( $institute_name ); ?>">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Course Type', WEBLIZAR_DOMAIN ); ?>:</label>
						<select name="candidate_education_course_type[]" class="widefat">
						<?php foreach ( Weblizar_Helper::course_types() as $key => $value ) : ?>
							<option <?php selected( $key, $course_type, true ); ?> value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value ); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Year of Passing', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_year_of_passing[]" class="widefat" placeholder="<?php _e( 'Format: XXXX', WEBLIZAR_DOMAIN ); ?>" value="<?php esc_html_e( $year_of_passing ); ?>">
					</div>
				</div>
						<?php
					endforeach;
				else :
					?>
				<div class="row weblizar_candidate_education_row">
					<div class="col-sm-6 mt-2">
						<span class="candidate_education_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Education Specialization', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_specialization[]" class="widefat">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Institute Name', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_institute_name[]" class="widefat">
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php esc_html_e( 'Course Type', WEBLIZAR_DOMAIN ); ?>:</label>
						<select name="candidate_education_course_type" class="widefat">
						<?php foreach ( Weblizar_Helper::course_types() as $key => $value ) : ?>
							<option value="<?php esc_html_e( $key ); ?>"><?php esc_html_e( $value ); ?></option>
						<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-6 mt-2">
						<label><?php _e( 'Year of Passing', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_education_year_of_passing[]" class="widefat" placeholder="<?php esc_attr_e( 'Format: XXXX', WEBLIZAR_DOMAIN ); ?>">
					</div>
				</div>
				<?php endif; ?>
			</div>
			<button type="button" id="weblizar_candidate_education_row_add_more" class="weblizar_row_add_more"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>
		<?php
	}

	/**
	 * Render html of skills metabox
	 *
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function skills_html( $post ) {
		$post_id = $post->ID;
		/* Array of array having keys: skill, experience */
		$skills = get_post_meta( $post_id, 'weblizar_candidate_skills', true );
		?>
		<div class="weblizar" id="weblizar_candidate_skills">
			<div id="weblizar_candidate_skills_rows">
				<?php
				if ( is_array( $skills ) && count( $skills ) > 0 ) :
					foreach ( $skills as $value ) :
						?>
				<div class="row weblizar_candidate_skills_row">
					<div class="col-sm-12 mt-2">
						<span class="candidate_skills_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Skill', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_skills[]" class="widefat" value="<?php echo esc_attr( $value ); ?>">
					</div>
				</div>
						<?php
					endforeach;
				else :
					?>
				<div class="row weblizar_candidate_skills_row">
					<div class="col-sm-12 mt-2">
						<span class="candidate_skills_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Skill', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_skills[]" class="widefat">
					</div>
				</div>
				<?php endif; ?>
			</div>
			<button type="button" id="weblizar_candidate_skills_row_add_more" class="weblizar_row_add_more"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>
		<?php
	}

	/**
	 * Render html of certification metabox
	 *
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function certification_html( $post ) {
		$post_id = $post->ID;
		/* Array of array having keys: certification_title, year_of_certification */
		$certification = get_post_meta( $post_id, 'weblizar_candidate_certification', true );
		?>
		<div class="weblizar" id="weblizar_candidate_certification">
			<div id="weblizar_candidate_certification_rows">
				<?php
				if ( is_array( $certification ) && count( $certification ) > 0 ) :
					foreach ( $certification as $key => $value ) :
						$certification_title   = isset( $value['certification_title'] ) ? esc_attr( $value['certification_title'] ) : '';
						$year_of_certification = isset( $value['year_of_certification'] ) ? esc_attr( $value['year_of_certification'] ) : '';
						?>
				<div class="row weblizar_candidate_certification_row">
					<div class="col-sm-8 mt-2">
						<span class="candidate_certification_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Certification Title', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_certification_title[]" class="widefat" value="<?php echo esc_attr( $certification_title ); ?>">
					</div>
					<div class="col-sm-4 mt-2">
						<label><?php esc_html_e( 'Year of Certification', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="number" step="1" name="candidate_certification_year[]" class="widefat" placeholder="<?php esc_attr_e( 'Format: XXXX', WEBLIZAR_DOMAIN ); ?>" value="<?php echo esc_attr( $year_of_certification ); ?>">
					</div>
				</div>
						<?php
					endforeach;
				else :
					?>
				<div class="row weblizar_candidate_certification_row">
					<div class="col-sm-8 mt-2">
						<span class="candidate_certification_remove_label candidate_remove_label">X</span>
						<label><?php esc_html_e( 'Certification Title', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="text" name="candidate_certification_title[]" class="widefat">
					</div>
					<div class="col-sm-4 mt-2">
						<label><?php esc_html_e( 'Year of Certification', WEBLIZAR_DOMAIN ); ?>:</label>
						<input type="number" step="1" name="candidate_certification_year[]" class="widefat">
					</div>
				</div>
				<?php endif; ?>
			</div>
			<button type="button" id="weblizar_candidate_certification_row_add_more" class="weblizar_row_add_more"><?php esc_html_e( 'Add more', WEBLIZAR_DOMAIN ); ?></button>
		</div>
		<?php
	}

	/**
	 * Render html of desired_job metabox
	 *
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function desired_job_html( $post ) {
		$post_id = $post->ID;
		/* Associative array having keys: locations, industry, salary, job_type */
		$desired_job      = get_post_meta( $post_id, 'weblizar_candidate_desired_job', true );
		$locations        = ( isset( $desired_job['locations'] ) && is_array( $desired_job['locations'] ) ) ? array_map( 'sanitize_text_field', $desired_job['locations'] ) : array();
		$locations_string = implode( ', ', $locations );
		$industry         = isset( $desired_job['industry'] ) ? esc_attr( $desired_job['industry'] ) : '';
		$departments      = ( isset( $desired_job['departments'] ) && is_array( $desired_job['departments'] ) ) ? array_map( 'sanitize_text_field', $desired_job['departments'] ) : array();
		$salary           = isset( $desired_job['salary'] ) ? esc_attr( $desired_job['salary'] ) : '';
		$job_types        = ( isset( $desired_job['job_types'] ) && is_array( $desired_job['job_types'] ) ) ? array_map( 'sanitize_text_field', $desired_job['job_types'] ) : array();
		?>
		<div class="weblizar" id="weblizar_candidate_desired_job">
			<div class="row">
				<div class="col-sm-12 mt-2">
					<label for="weblizar_candidate_desired_job_locations"><?php esc_html_e( 'Job Locations', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_desired_job_locations" id="weblizar_candidate_desired_job_locations" class="widefat" value="<?php echo esc_attr( $locations_string ); ?>" placeholder="<?php esc_attr_e( 'Separated by comma', WEBLIZAR_DOMAIN ); ?>">
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_industry"><?php esc_attr_e( 'Industry', WEBLIZAR_DOMAIN ); ?>:</label>
					<select name="candidate_desired_job_industry" id="weblizar_candidate_desired_job_industry" class="widefat">
					<?php foreach ( Weblizar_Helper::industries() as $key => $value ) : ?>
						<option <?php selected( $key, $industry ); ?> value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value ); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_salary"><?php esc_html_e( 'Salary', WEBLIZAR_DOMAIN ); ?>:</label>
					<input type="text" name="candidate_desired_job_salary" id="weblizar_candidate_desired_job_salary" class="widefat" value="<?php echo esc_attr( $salary ); ?>">
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_departments"><?php esc_html_e( 'Departments', WEBLIZAR_DOMAIN ); ?>:</label><br>
					<select data-placeholder="<?php esc_attr_e( 'Select departments', WEBLIZAR_DOMAIN ); ?>" name="candidate_desired_job_departments[]" id="weblizar_candidate_desired_job_departments" class="widefat" multiple>
					<?php
					$department_array = Weblizar_Helper::departments();
					foreach ( $department_array as $key => $value ) :
						?>
						<option <?php selected( true, in_array( $key, $departments ), true ); ?> value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value ); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-6 mt-2">
					<label for="weblizar_candidate_desired_job_types"><?php esc_html_e( 'Job Types', WEBLIZAR_DOMAIN ); ?>:</label>
					<select data-placeholder="<?php esc_attr_e( 'Select job types', WEBLIZAR_DOMAIN ); ?>" name="candidate_desired_job_types[]" id="weblizar_candidate_desired_job_types" class="widefat" multiple>
					<?php
					$job_type_array = Weblizar_Helper::job_types();
					foreach ( $job_type_array as $key => $value ) :
						?>
						<option <?php selected( true, in_array( $key, $job_types ), true ); ?> value="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value ); ?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Enqueue scripts and styles to admin candidate post type
	 *
	 * @param  string $hook_suffix
	 * @return void
	 */
	public static function enqueue_scripts_styles( $hook_suffix ) {
		if ( in_array( $hook_suffix, array( 'post.php', 'post-new.php' ) ) ) {
			$screen = get_current_screen();
			if ( is_object( $screen ) && 'candidate' == $screen->post_type ) {
				/* Enqueue styles */
				wp_enqueue_style( 'weblizar-bootstrap', WEBLIZAR_PLUGIN_URL . 'assets/css/bootstrap.css' );
				wp_enqueue_style( 'weblizar-fSelect', WEBLIZAR_PLUGIN_URL . 'assets/css/fSelect.css' );
				wp_enqueue_style( 'weblizar-admin', WEBLIZAR_PLUGIN_URL . 'assets/css/weblizar-admin.css' );

				/* Enqueue scripts */
				wp_enqueue_script( 'weblizar-jquery-validate-js', WEBLIZAR_PLUGIN_URL . 'assets/js/jquery.validate.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'weblizar-fSelect-js', WEBLIZAR_PLUGIN_URL . 'assets/js/fSelect.js', array( 'jquery' ), true, true );
				wp_enqueue_script( 'weblizar-admin-js', WEBLIZAR_PLUGIN_URL . 'assets/js/weblizar-admin.js', array( 'jquery', 'weblizar-jquery-validate-js' ), true, true );
			}
		}
	}

	/**
	 * Change title text for candidate post type
	 *
	 * @param  string $title
	 * @return string
	 */
	public static function change_title_text( $title ) {
		$screen = get_current_screen();
		if ( 'candidate' == $screen->post_type ) {
			$title = esc_html__( 'Enter candidate name', WEBLIZAR_DOMAIN );
		}
		return $title;
	}

	/**
	 * Set candidate columns
	 *
	 * @param array $columns
	 * @return array
	 */
	public static function set_columns( $columns ) {
		$newColumns          = array();
		$newColumns['cb']    = $columns['cb'];
		$newColumns['title'] = esc_html__( 'Candidate Name', WEBLIZAR_DOMAIN );
		$newColumns['date']  = esc_html__( 'Date', WEBLIZAR_DOMAIN );
		return $newColumns;
	}

	/**
	 * Save metaboxes values
	 *
	 * @param  int     $post_id
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function save_metaboxes( $post_id, $post ) {
		if ( ! isset( $_POST['candidate_meta'] ) || ! wp_verify_nonce( $_POST['candidate_meta'], 'save_candidate_meta' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		if ( wp_is_post_revision( $post ) ) {
			return;
		}
		if ( $post->post_type !== 'candidate' ) {
			return;
		}

		$email            = isset( $_POST['candidate_account_email'] ) ? sanitize_email( $_POST['candidate_account_email'] ) : null;
		$password         = isset( $_POST['candidate_account_password'] ) ? sanitize_text_field( $_POST['candidate_account_password'] ) : null;
		$confirm_password = isset( $_POST['candidate_account_confirm_password'] ) ? sanitize_text_field( $_POST['candidate_account_confirm_password'] ) : null;

		$personal_name          = isset( $_POST['candidate_personal_name'] ) ? sanitize_text_field( $_POST['candidate_personal_name'] ) : null;
		$personal_last_name     = isset( $_POST['candidate_personal_last_name'] ) ? sanitize_text_field( $_POST['candidate_personal_last_name'] ) : null;
		$personal_state         = isset( $_POST['candidate_personal_state'] ) ? sanitize_text_field( $_POST['candidate_personal_state'] ) : null;
		$personal_city          = isset( $_POST['candidate_personal_city'] ) ? sanitize_text_field( $_POST['candidate_personal_city'] ) : null;
		$personal_email         = isset( $_POST['candidate_personal_email'] ) ? sanitize_email( $_POST['candidate_personal_email'] ) : null;
		$personal_mobile        = isset( $_POST['candidate_personal_mobile'] ) ? intval( sanitize_text_field( $_POST['candidate_personal_mobile'] ) ) : null;
		$personal_date_of_birth = isset( $_POST['candidate_personal_date_of_birth'] ) ? sanitize_text_field( $_POST['candidate_personal_date_of_birth'] ) : null;
		$personal_location      = isset( $_POST['candidate_personal_location'] ) ? sanitize_text_field( $_POST['candidate_personal_location'] ) : null;
		$personal_gender        = isset( $_POST['candidate_personal_gender'] ) ? sanitize_text_field( $_POST['candidate_personal_gender'] ) : null;

		$saved_document       = get_post_meta( $post_id, 'weblizar_candidate_document', true );
		$saved_document_cv    = isset( $saved_document['cv'] ) ? esc_attr( $saved_document['cv'] ) : '';
		$saved_latest_cv_date = isset( $saved_document['latest_cv_date'] ) ? esc_attr( $saved_document['latest_cv_date'] ) : '';
		$document_cv          = ( isset( $_FILES['candidate_document_cv'] ) && is_array( $_FILES['candidate_document_cv'] ) ) ? $_FILES['candidate_document_cv'] : null;

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

		update_post_meta( $post_id, 'weblizar_candidate_personal', $personal );
		update_post_meta( $post_id, 'weblizar_candidate_work_experience', $work_experience );
		update_post_meta( $post_id, 'weblizar_candidate_employment', $employment );
		update_post_meta( $post_id, 'weblizar_candidate_education', $education );
		update_post_meta( $post_id, 'weblizar_candidate_skills', $skills );
		update_post_meta( $post_id, 'weblizar_candidate_certification', $certification );
		update_post_meta( $post_id, 'weblizar_candidate_desired_job', $desired_job );

		$user_id = get_post_meta( $post_id, 'weblizar_candidate_user_id', true );

		$user_data = array();
		if ( empty( $email ) || ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			return;
		}

		$user_data['user_email'] = $email;

		if ( ! empty( $password ) && ! empty( $confirm_password ) ) {
			if ( $password !== $confirm_password ) {
				return;
			} else {
				$user_data['user_pass'] = $password;
			}
		}

		$user_data['ID'] = $user_id;

		wp_update_user( $user_data );

		/* File uploads */
		if ( ! empty( $document_cv ) ) {
			$file_name          = sanitize_file_name( $document_cv['name'] );
			$file_type          = $document_cv['type'];
			$allowed_file_types = Weblizar_Helper::cv_document_file_types();

			if ( ! in_array( $file_type, $allowed_file_types ) ) {
				return;
			}
		}

		$latest_cv_date = date( 'Y-m-d H:i:s' );
		if ( ! empty( $document_cv ) ) {
			/* New document provided */
			$document_cv = media_handle_upload( 'candidate_document_cv', 0 );
			if ( is_wp_error( $document_cv ) ) {
				return;
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

		$document = array(
			'cv'             => $document_cv,
			'latest_cv_date' => $latest_cv_date,
		);

		update_post_meta( $post_id, 'weblizar_candidate_document', $document );

		if ( isset( $delete_saved_document_cv ) ) {
			wp_delete_attachment( $saved_document_cv, true );
		}
	}

	/**
	 * Delete candidate's document
	 *
	 * @param  int     $post_id
	 * @param  WP_Post $post
	 * @return void
	 */
	public static function delete_document( $post_id ) {
		global $post_type;
		if ( $post_type != 'candidate' ) {
			return;
		}

		$document    = get_post_meta( $post_id, 'weblizar_candidate_document', true );
		$document_cv = isset( $document['cv'] ) ? esc_attr( $document['cv'] ) : '';

		if ( ! empty( $document_cv ) ) {
			wp_delete_attachment( $document_cv, true );
		}
	}

	/**
	 * File uploads support
	 *
	 * @return void
	 */
	public static function edit_form_tag() {
		global $post;

		if ( $post && 'candidate' === $post->post_type ) {
			printf( ' enctype="multipart/form-data" encoding="multipart/form-data" ' );
		}
	}
}
