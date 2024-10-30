<?php
defined( 'ABSPATH' ) || die();

global $wpdb;

$count_jobs = wp_count_posts( 'job' );
$count_jobs = $count_jobs ? $count_jobs->publish : 0;

$job_types       = get_terms( array( 'taxonomy'   => 'job_type', 'hide_empty' => false ) );
$count_job_types = is_array( $job_types ) ? count( $job_types ) : 0;

$industries       = get_terms( array( 'taxonomy'   => 'industry', 'hide_empty' => false ) );
$count_industries = is_array( $industries ) ? count( $industries ) : 0;

$departments       = get_terms( array( 'taxonomy'   => 'department', 'hide_empty' => false ) );
$count_departments = is_array( $departments ) ? count( $departments ) : 0;

$skills       = get_terms( array( 'taxonomy'   => 'skill', 'hide_empty' => false ) );
$count_skills = is_array( $skills ) ? count( $skills ) : 0;

$job_locations       = get_terms( array( 'taxonomy'   => 'job_location', 'hide_empty' => false ) );
$count_job_locations = is_array( $job_locations ) ? count( $job_locations ) : 0;

$count_candidates = wp_count_posts( 'candidate' );
$count_candidates = $count_candidates ? $count_candidates->publish : 0;

$count_applications = $wpdb->get_var( "SELECT COUNT(*) as count FROM {$wpdb->prefix}weblizar_candidate_job" );

$recent_jobs = wp_get_recent_posts( array(
	'post_type'   => 'job',
	'numberposts' => 10,
	'post_status' => 'publish'
));

$recent_candidates = wp_get_recent_posts( array(
	'post_type'   => 'candidate',
	'numberposts' => 10,
	'post_status' => 'publish'
));

$recent_applications = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}weblizar_candidate_job ORDER BY created_at DESC LIMIT 10" );
?>
<div class="weblizar">
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<h1 class="display-4 text-center bg-primary text-white pt-1 pb-3 mt-2"><span class="border-bottom"><i class="fa fa-tachometer"></i> <?php esc_html_e( 'Job Portal Dashboard', WEBLIZAR_DOMAIN ); ?></span></h1>
				<div class="mt-3 alert alert-secondary text-center" role="alert">
					<?php esc_html_e( "Here, you can view job portal stats.", WEBLIZAR_DOMAIN ); ?>
				</div>
			</div>
		</div>

		<div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
            	<div class="weblizar-stats-item">
            		<div class="row d-flex h-100 ">
            			<div class="col-4 justify-content-center align-self-center"><div class="weblizar-stats-icon"><i class="fa fa-bullhorn"></i></div></div>
            			<div class="col-8 justify-content-center align-self-center text-right">
            				<div class="weblizar-stats-count"><?php esc_html_e($count_jobs); ?></div>
            				<div class="weblizar-stats-title"><a href="<?php echo admin_url( 'edit.php?post_type=job' ); ?>" class="weblizar-stats-item-link"><?php esc_html_e( 'Jobs Published', WEBLIZAR_DOMAIN ); ?></a></div>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
            	<div class="weblizar-stats-item">
            		<div class="row d-flex h-100">
            			<div class="col-4 justify-content-center align-self-center"><div class="weblizar-stats-icon"><i class="fa fa-industry"></i></div></div>
            			<div class="col-8 justify-content-center align-self-center text-right">
            				<div class="weblizar-stats-count"><?php esc_html_e($count_industries); ?></div>
            				<div class="weblizar-stats-title"><a href="<?php echo admin_url( 'edit-tags.php?taxonomy=industry&post_type=job' ); ?>" class="weblizar-stats-item-link"><?php esc_html_e( 'Industries', WEBLIZAR_DOMAIN ); ?></a></div>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
            	<div class="weblizar-stats-item">
            		<div class="row d-flex h-100">
            			<div class="col-4 justify-content-center align-self-center"><div class="weblizar-stats-icon"><i class="fa fa-building"></i></div></div>
            			<div class="col-8 justify-content-center align-self-center text-right">
            				<div class="weblizar-stats-count"><?php esc_html_e($count_departments); ?></div>
            				<div class="weblizar-stats-title"><a href="<?php echo admin_url( 'edit-tags.php?taxonomy=department&post_type=job' ); ?>" class="weblizar-stats-item-link"><?php esc_html_e( 'Departments', WEBLIZAR_DOMAIN ); ?></a></div>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
            	<div class="weblizar-stats-item">
            		<div class="row d-flex h-100">
            			<div class="col-4 justify-content-center align-self-center"><div class="weblizar-stats-icon"><i class="fa fa-asterisk"></i></div></div>
            			<div class="col-8 justify-content-center align-self-center text-right">
            				<div class="weblizar-stats-count"><?php esc_html_e($count_skills); ?></div>
            				<div class="weblizar-stats-title"><a href="<?php echo admin_url( 'edit-tags.php?taxonomy=skill&post_type=job' ); ?>" class="weblizar-stats-item-link"><?php esc_html_e( 'Skills', WEBLIZAR_DOMAIN ); ?></a></div>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
            	<div class="weblizar-stats-item">
            		<div class="row d-flex h-100">
            			<div class="col-4 justify-content-center align-self-center"><div class="weblizar-stats-icon"><i class="fa fa-map"></i></div></div>
            			<div class="col-8 justify-content-center align-self-center text-right">
            				<div class="weblizar-stats-count"><?php esc_html_e($count_job_locations); ?></div>
            				<div class="weblizar-stats-title"><a href="<?php echo admin_url( 'edit-tags.php?taxonomy=job_location&post_type=job' ); ?>" class="weblizar-stats-item-link"><?php esc_html_e( 'Job Locations', WEBLIZAR_DOMAIN ); ?></a></div>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
            	<div class="weblizar-stats-item">
            		<div class="row d-flex h-100">
            			<div class="col-4 justify-content-center align-self-center"><div class="weblizar-stats-icon"><i class="fa fa-users"></i></div></div>
            			<div class="col-8 justify-content-center align-self-center text-right">
            				<div class="weblizar-stats-count"><?php esc_html_e( $count_candidates ); ?></div>
            				<div class="weblizar-stats-title"><a href="<?php echo admin_url( 'edit.php?post_type=candidate' ); ?>" class="weblizar-stats-item-link"><?php esc_html_e( 'Candidates', WEBLIZAR_DOMAIN ); ?></a></div>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4">
            	<div class="weblizar-stats-item">
            		<div class="row d-flex h-100">
            			<div class="col-4 justify-content-center align-self-center"><div class="weblizar-stats-icon"><i class="fa fa-envelope-open"></i></div></div>
            			<div class="col-8 justify-content-center align-self-center text-right">
            				<div class="weblizar-stats-count"><?php esc_html_e( $count_applications ); ?></div>
            				<div class="weblizar-stats-title"><a href="<?php menu_page_url( 'job_applications', true ); ?>" class="weblizar-stats-item-link"><?php esc_html_e( 'Job Applications', WEBLIZAR_DOMAIN ); ?></a></div>
            			</div>
            		</div>
            	</div>
            </div>
		</div>

		<div class="row">
			<div class="col">
				<div class="text-center weblizar-recent-activities-heading"><?php esc_html_e( "Recent Activities", WEBLIZAR_DOMAIN ); ?></div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
						<?php if ( count( $recent_jobs ) ) { ?>
						<div class="weblizar-recent-list-title"><?php esc_html_e( "Last 10 Jobs Published", WEBLIZAR_DOMAIN ); ?><span class="float-right"><i class="fa fa-bullhorn"></i></span></div>
						<ul class="list-group weblizar-recent-list">
							<?php foreach ( $recent_jobs as $recent_job ) {
									$job_url = get_the_permalink( $recent_job['ID'] ); ?>
							<li class="list-group-item">
								<span class="weblizar-recent-item-left"><a target="_blank" href="<?php echo esc_url( $job_url ); ?>"><?php esc_html_e( $recent_job['post_title'] ); ?></a></span>
								<span class="weblizar-recent-item-right float-right"><?php echo date_format( date_create( $recent_job['post_date'] ), 'd-m-Y g:i A' ); ?></span>
							</li>
							<?php } ?>
						</ul>
						<?php } else { ?>
							<div class="alert alert-secondary"><?php esc_html_e( "There is no recent job.", WEBLIZAR_DOMAIN ); ?></div>
						<?php } ?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
						<?php if ( count( $recent_candidates ) ) { ?>
						<div class="weblizar-recent-list-title"><?php esc_html_e( "Last 10 Candidate Registrations", WEBLIZAR_DOMAIN ); ?><span class="float-right"><i class="fa fa-users"></i></span></div>
						<ul class="list-group weblizar-recent-list">
							<?php foreach ( $recent_candidates as $recent_candidate ) {
									$candidate_url = get_edit_post_link( $recent_candidate['ID'] ); ?>
							<li class="list-group-item">
								<span class="weblizar-recent-item-left"><a target="_blank" href="<?php echo esc_url( $candidate_url ); ?>"><?php esc_html_e($recent_candidate['post_title']); ?></a></span>
								<span class="weblizar-recent-item-right float-right"><?php echo date_format( date_create( $recent_candidate['post_date'] ), 'd-m-Y g:i A' ); ?></span>
							</li>
							<?php } ?>
						</ul>
						<?php } else { ?>
							<div class="alert alert-secondary"><?php esc_html_e( "There is no recent candidate registration.", WEBLIZAR_DOMAIN ); ?></div>
						<?php } ?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 mb-4">
						<?php if ( count( $recent_applications ) ) { ?>
						<div class="weblizar-recent-list-title"><?php esc_html_e( "Last 10 Job Applications", WEBLIZAR_DOMAIN ); ?><span class="float-right"><i class="fa fa-envelope-open"></i></span></div>
						<ul class="list-group weblizar-recent-list">
							<?php foreach ( $recent_applications as $application ) {
									$candidate_id = $application->candidate_id;
									$job_id       = $application->job_id;
									$date         = date_i18n( 'd-m-Y g:i A', strtotime( $application->created_at ) );

									/* Candidate link */
									$candidate_title = get_the_title( $candidate_id );
									$candidate_url   = get_edit_post_link( $candidate_id );
									$candidate_link  = '<a target="_blank" href="' . $candidate_url . '">' . $candidate_title . '</a>';

									/* Job link */
									$job_title     = get_the_title( $job_id );
									$job_permalink = get_the_permalink( $job_id );
									$job_link      = '<a target="_blank" href="' . $job_permalink . '">' . $job_title . '</a>';
							?>
							<li class="list-group-item">
								<span class="weblizar-recent-item-left"><?php echo wp_kses_post( $candidate_link ); ?>&nbsp;<?php esc_html_e( "applied to", WEBLIZAR_DOMAIN ); ?>&nbsp;<?php echo wp_kses_post($job_link); ?></span>
								<span class="weblizar-recent-item-right float-right"><?php esc_html_e($date); ?></span>
							</li>
							<?php } ?>
						</ul>
						<?php } else { ?>
							<div class="alert alert-secondary"><?php esc_html_e( "There is no recent job application.", WEBLIZAR_DOMAIN ); ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>