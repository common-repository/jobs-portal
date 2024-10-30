<?php
defined( 'ABSPATH' ) || die();
require_once( WEBLIZAR_PLUGIN_DIR_PATH . 'includes/Weblizar_Helper.php' );

$jobs_per_page       = Weblizar_Helper::general_jobs_per_page();
$job_portal_page_url = Weblizar_Helper::general_job_portal_page_url();
$account_page_url    = Weblizar_Helper::general_account_page_url();

$url_divison   = explode( '?', get_pagenum_link(1), 2 );
$query = array(
	'post_type'      => 'job',
	'post_status'    => 'publish',
	'posts_per_page' => $jobs_per_page,
	'paged'          => get_query_var( 'page' ) ? get_query_var( 'page' ) : 1
);
if ( isset( $_GET['search-job'] ) ) {
	$search     = sanitize_text_field( $_GET['search-job'] );
	$query['s'] = $search;
}
$jobs = new WP_Query( $query );

$is_user_logged_in = is_user_logged_in();
?>
<div class="container wrap weblizar">
	<nav class="weblizar-job-search-nav">
		<div class="row justify-content-md-center mt-4">
			<div class="col-sm-9">
				<form method="get" action="<?php echo esc_url($url_divison[0]); ?>">
					<div class="input-group mb-4">
						<input type="text" name="search-job" class="weblizar-search-job-input w-100 d-block col" placeholder="<?php esc_attr_e( "Job title, skills", WEBLIZAR_DOMAIN ); ?>">
						<div class="input-group-append">
							<button type="submit" class="weblizar-search-job-button pt-2 pb-2"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</form>
				<?php
				if ( isset( $search ) ) : ?>
				<div class="weblizar-search-info text-center mb-3">
					<span class="border-bottom pb-1"><?php esc_html_e( "Showing search results for", WEBLIZAR_DOMAIN ); ?>: <?php echo esc_attr( $search ); ?></span>&nbsp;
					<span><a class="" href="<?php echo esc_url($url_divison[0]); ?>"><?php esc_html_e( "Clear filter", WEBLIZAR_DOMAIN ); ?></a></span>
				</div>
				<?php
				endif; ?>
			</div>
			<div class="col-sm-3">
				<?php if ( $is_user_logged_in ) : ?>
					<?php if ( $candidate = Weblizar_Helper::user_has_cv( get_current_user_id() ) ) : ?>
					<div class="col-sm-12 text-right weblizar-your-cv-navigation weblizar-navigation">
						<a href="<?php echo esc_url($account_page_url); ?>" class="weblizar-navigation-link pr-3 mb-3 border-bottom"><?php esc_html_e( 'Your CV', WEBLIZAR_DOMAIN ); ?></a>
					</div>
					<?php else: ?>
					<div class="col-sm-12 text-right weblizar-register-cv-navigation weblizar-navigation">
						<a href="<?php echo esc_url($account_page_url); ?>" class="weblizar-navigation-link pr-3 mb-3 border-bottom"><?php esc_html_e( 'Register CV', WEBLIZAR_DOMAIN ); ?></a>
					</div>
					<?php endif; ?>
				<div class="col-sm-12 text-right weblizar-logout-navigation">
					<a href="<?php echo wp_logout_url( $job_portal_page_url ); ?>" class="weblizar-navigation-link pr-3 pb-3"><?php esc_html_e( 'Logout', WEBLIZAR_DOMAIN ); ?></a>
				</div>
				<?php else : ?>
				<div class="col-sm-12 text-right weblizar-login-signup-navigation weblizar-navigation">
					<a href="<?php echo esc_url($account_page_url); ?>" class="weblizar-login-signup-link pr-3 mb-3 border-bottom"><?php esc_html_e( 'Login / Signup', WEBLIZAR_DOMAIN ); ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</nav>
	<section class="weblizar-jobs">
	    <?php
	    if ( $jobs->have_posts() ) {
		    while ( $jobs->have_posts() ) : $jobs->the_post();
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
		        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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
	        			<i class="fa fa-credit-card"></i>&nbsp; <?php echo wp_kses_post($salary); ?>
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
		        		<?php esc_html_e( 'Skills:', WEBLIZAR_DOMAIN ) . ' ' . $skill_data; ?>
		        	</span>&nbsp;&nbsp;
			        <?php } ?>
		        	<span class="float-right weblizar-job-posted-date text-secondary">
		        	<?php esc_html_e( 'Posted', WEBLIZAR_DOMAIN ); ?> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ' . esc_html__( 'ago', WEBLIZAR_DOMAIN ); ?>
		        	</span>
		        </div>
		    </header>
		    <div id="weblizar-job-content-<?php the_ID(); ?>">
		        <?php the_excerpt(); ?>
		    </div>
	    </article>
		    <?php endwhile;

			$query_string = isset( $url_divison[1] ) ? $url_divison[1] : '';
		    $total_pages  = $jobs->max_num_pages;
		    if ( $total_pages > 1 ) {
		        $current_page = max( 1, get_query_var( 'page' ) ); ?>
				<div class="text-right">
				<?php
		        echo paginate_links( array (
		            'base'      => $url_divison[0] . '%_%' . '?' . $query_string,
		            'format'    => 'page/%#%',
		            'current'   => $current_page,
		            'total'     => $total_pages,
		            'prev_text' => esc_html__( '« prev', WEBLIZAR_DOMAIN ),
		            'next_text' => esc_html__( 'next »', WEBLIZAR_DOMAIN )
		        ) ); ?>
		        </div>
		        <?php
		    }
		    wp_reset_postdata(); ?>
		    <?php
		}
	    ?>
    </section>
</div>