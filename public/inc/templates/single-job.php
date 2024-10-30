<?php
defined( 'ABSPATH' ) || die();
get_header();

global $wp;
$job_portal_page_url = Weblizar_Helper::general_job_portal_page_url();
$account_page_url    = Weblizar_Helper::general_account_page_url();
$is_user_logged_in   = is_user_logged_in();
$candidate           = false;
if ( $is_user_logged_in ) {
	$candidate = Weblizar_Helper::user_has_cv( get_current_user_id() );
}
?>
<div class="wrap weblizar">
	<div class="container mt-4 mb-3">
		<section class="weblizar-job">
		    <?php
	    	while ( have_posts() ) : the_post();
	    		$post          = get_post();
				$post_id       = $post->ID;
	    		$job_types     = get_the_terms( $post, 'job_type' );
	    		$industries    = get_the_terms( $post, 'industry' );
	    		$departments   = get_the_terms( $post, 'department' );
	    		$job_locations = get_the_terms( $post, 'job_location' );
	    		$skills        = get_the_terms( $post, 'skill' );

	    		$job_type_array = array();
	    		if ( $job_types ) {
		    		foreach( $job_types as $job_type ) {
		    			if ( $job_type->name ) {
		    				$job_type_link = get_term_link( $job_type, 'job_type' );
		    				array_push( $job_type_array, "<a href='{$job_type_link}' class='weblizar-job-type-link'>{$job_type->name}</a>" );
		    			}
		    		}
	    		}
	    		$job_type_data = implode( ', ', $job_type_array );

	    		$industry_array = array();
	    		if ( $industries ) {
		    		foreach( $industries as $industry ) {
		    			if ( $industry->name ) {
		    				$industry_link = get_term_link( $industry, 'industry' );
		    				array_push( $industry_array, "<a href='{$industry_link}' class='weblizar-job-industry-link'>{$industry->name}</a>" );
		    			}
		    		}
	    		}
	    		$industry_data = implode( ', ', $industry_array );

	    		$department_array = array();
	    		if ( $departments ) {
		    		foreach( $departments as $department ) {
		    			if ( $department->name ) {
		    				$department_link = get_term_link( $department, 'department' );
		    				array_push( $department_array, "<a href='{$department_link}' class='weblizar-job-department-link'>{$department->name}</a>" );
		    			}
		    		}
	    		}
	    		$department_data = implode( ', ', $department_array );

	    		$job_location_array = array();
	    		if ( $job_locations ) {
		    		foreach( $job_locations as $job_location ) {
		    			if ( $job_location->name ) {
		    				$job_location_link = get_term_link( $job_location, 'job_location' );
		    				array_push( $job_location_array, "<a href='{$job_location_link}' class='weblizar-job-location-link'>{$job_location->name}</a>" );
		    			}
		    		}
	    		}
	    		$job_location_data = implode( ', ', $job_location_array );

	    		$skill_array = array();
	    		if ( $skills ) {
		    		foreach( $skills as $skill ) {
		    			if ( $skill->name ) {
		    				$skill_link = get_term_link( $skill, 'skill' );
		    				array_push( $skill_array, "<a href='{$skill_link}' class='weblizar-job-skill-link'>{$skill->name}</a>" );
		    			}
		    		}
	    		}
	    		$skill_data = implode( ', ', $skill_array );

	    		$work_experience         = get_post_meta( $post_id, 'weblizar_job_work_experience', true );
				$minimum_work_experience = isset( $work_experience['minimum'] ) ? esc_attr( $work_experience['minimum'] ) : '';
				$maximum_work_experience = isset( $work_experience['maximum'] ) ? esc_attr( $work_experience['maximum'] ) : '';

				$salary  = get_post_meta( $post_id, 'weblizar_job_salary', true );
				$type    = isset( $salary['type'] ) ? esc_attr( $salary['type'] ) : '';
				if ( $is_range = ( $type == 'range' ) ) {
					$minimum_salary = isset( $salary['minimum'] ) ? esc_attr( $salary['minimum'] ) : '';
					$maximum_salary = isset( $salary['maximum'] ) ? esc_attr( $salary['maximum'] ) : '';
					$salary  = "{$minimum_salary} - $maximum_salary";
				} elseif ( $type == 'negotiable' ) {
					$salary = esc_html__( 'Negotiable', WEBLIZAR_DOMAIN );
				} elseif ( $type == 'fixed' ) {
					$salary = esc_html__( 'Fixed', WEBLIZAR_DOMAIN );
				} else {
					$salary = '';
				}
		    ?>
			<article <?php post_class(); ?>>
			    <header class="weblizar-job-heading">
			    	<div class="row">
				    	<div class="col-sm-9">
				        	<h1 class="page-header"><?php the_title(); ?></h1>
				        </div>
				    	<div class="col-sm-3">
							<div class="col-sm-12 text-right weblizar-job-portal-navigation weblizar-navigation">
								<a href="<?php echo esc_url($job_portal_page_url); ?>" class="weblizar-navigation-link pr-3 mb-3 border-bottom">&#8594; <?php esc_html_e( 'Back to Job Portal', WEBLIZAR_DOMAIN ); ?></a>
							</div>
							<?php if ( $is_user_logged_in ) : ?>
								<?php if ( $candidate ) : ?>
								<div class="col-sm-12 text-right weblizar-cv-navigation weblizar-navigation">
									<a href="<?php echo esc_url($account_page_url); ?>" class="weblizar-navigation-link pr-3 mb-3 border-bottom"><?php esc_html_e( 'Your CV', WEBLIZAR_DOMAIN ); ?></a>
								</div>
								<?php else: ?>
								<div class="col-sm-12 text-right weblizar-cv-navigation weblizar-navigation">
									<a href="<?php echo esc_url($account_page_url); ?>" class="weblizar-navigation-link pr-3 mb-3 border-bottom"><?php esc_html_e( 'Register CV', WEBLIZAR_DOMAIN ); ?></a>
								</div>
								<?php endif; ?>
							<div class="col-sm-12 text-right weblizar-logout-navigation weblizar-navigation">
								<a href="<?php echo wp_logout_url( $wp->request ); ?>" class="weblizar-navigation-link pr-3 pb-3"><?php esc_html_e( 'Logout', WEBLIZAR_DOMAIN ); ?></a>
							</div>
							<?php else : ?>
							<div class="col-sm-12 text-right weblizar-login-signup-navigation weblizar-navigation">
								<a href="<?php echo esc_url($account_page_url); ?>" class="weblizar-navigation-link pr-3 mb-3 border-bottom"><?php esc_html_e( 'Login / Signup', WEBLIZAR_DOMAIN ); ?></a>
							</div>
							<?php endif; ?>
			        	</div>
			        </div>
			        <div class="weblizar-job-meta-data">
			        	<?php if ( $minimum_work_experience && $maximum_work_experience ) { ?>
			        	<span class="weblizar-experience">
		        			<i class="fa fa-briefcase"></i>&nbsp; <?php echo "{$minimum_work_experience} - {$maximum_work_experience} " . esc_html__( 'Yr', WEBLIZAR_DOMAIN ); ?>
		        		</span>&nbsp;&nbsp;
				        <?php } elseif( $minimum_work_experience ) { ?>
			        	<span class="weblizar-experience">
		        			<i class="fa fa-briefcase"></i>&nbsp; <?php echo "{$minimum_work_experience} " . esc_html__( 'Yr', WEBLIZAR_DOMAIN ); ?>
		        		</span>&nbsp;&nbsp;
		        		<?php } elseif ( $maximum_work_experience ) { ?>
			        	<span class="weblizar-experience">
		        			<i class="fa fa-briefcase"></i>&nbsp; <?php echo "{$maximum_work_experience} " . esc_html__( 'Yr', WEBLIZAR_DOMAIN ); ?>
		        		</span>&nbsp;&nbsp;
		        		<?php }
			        	if ( $job_location_data ) { ?>
			        	<span class="weblizar-job_locations">
		        			<i class="fa fa-map-marker"></i>&nbsp; <?php echo wp_kses_post($job_location_data); ?>
		        		</span>&nbsp;&nbsp;
				        <?php }
				        if ( $salary ) { ?>
			        	<span class="weblizar-salary">
		        			<i class="fa fa-credit-card"></i>&nbsp; <?php esc_html_e($salary); ?>
		        		</span>&nbsp;&nbsp;
				        <?php }
				        if ( $job_type_data ) { ?>
			        	<span class="weblizar-job-type">
		        			<i class="fa fa-tasks"></i>&nbsp; <?php echo wp_kses_post($job_type_data); ?>
		        		</span>&nbsp;&nbsp;
				        <?php }
				        if ( $industry_data ) { ?>
			        	<span class="weblizar-industry">
		        			<i class="fa fa-industry"></i>&nbsp; <?php echo wp_kses_post($industry_data); ?>
		        		</span>&nbsp;&nbsp;
				        <?php }
				        if ( $department_data ) { ?>
			        	<span class="weblizar-department">
		        			<i class="fa fa-building"></i>&nbsp; <?php echo wp_kses_post($department_data); ?>
		        		</span>&nbsp;&nbsp;
				        <?php } ?>
		        	</div>
			        <div class="weblizar-job-skills-posted-date mb-3 mt-3">
				        <?php
				        if ( $skill_data ) { ?>
			        	<span class="float-left weblizar-skill">
			        		<?php echo esc_html__( 'Skills:', WEBLIZAR_DOMAIN ) . ' ' . $skill_data; ?>
			        	</span>&nbsp;&nbsp;
				        <?php } ?>
			        	<span class="float-right weblizar-job-posted-date text-secondary">
			        	<?php esc_html_e( 'Posted', WEBLIZAR_DOMAIN ); ?> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . esc_html__( 'ago', WEBLIZAR_DOMAIN ); ?>
			        	</span>
			        </div>
			        <div class="weblizar-job-apply mb-3 mt-3">
				        <?php if ( $candidate ) :
				        		if ( $application = Weblizar_Helper::is_applied( $candidate->ID, $post_id ) ) : ?>
				        			<strong class="weblizar-job-apply-date"><i class="fa fa-check-circle text-success"></i>
				        			<?php
				        			printf(
				        				/* translators: %s: Date of application */
				        				esc_html__( 'Already applied on %s', WEBLIZAR_DOMAIN ),
				        				date_i18n( 'd M, Y', strtotime( $application->created_at ) )
				        			); ?>
				        			</strong>
			        		<?php else: ?>
			        		<button data-id="<?php echo esc_attr($post_id); ?>" data-message="<?php esc_attr_e( 'Are you sure to apply to this job?', WEBLIZAR_DOMAIN ); ?>" id="weblizar-job-apply-button"><?php esc_html_e( 'Apply Now', WEBLIZAR_DOMAIN ); ?></button>
			        		<?php endif; ?>
				        <?php else : ?>
							<a href="<?php echo esc_url($account_page_url); ?>" class="weblizar-cv-apply-link pr-3 mb-3 border-bottom"><?php esc_html_e( 'Register your CV before applying', WEBLIZAR_DOMAIN ); ?></a>
		        		<?php endif; ?>
			        </div>
			    </header>
			    <div id="weblizar-job-content-<?php the_ID(); ?>" class="mb-4">
			        <?php the_content(); ?>
			    </div>
		    </article>
		    <?php endwhile;
		    wp_reset_postdata();
		    ?>
	    </section>
    </div>
</div>
<?php get_footer(); ?>
