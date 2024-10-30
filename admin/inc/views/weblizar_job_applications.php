<?php
defined( 'ABSPATH' ) || die();
require_once( WEBLIZAR_PLUGIN_DIR_PATH . 'includes/Weblizar_Helper.php' );

$admin_applications_per_page = Weblizar_Helper::general_admin_applications_per_page();
?>
<div class="weblizar">
	<div class="container-fluid">
	<?php
	global $wpdb;
	$search = isset( $_GET['search'] ) ? sanitize_text_field( $_GET['search'] ) : '';
	if ( $search ) {
		$query = "SELECT {$wpdb->prefix}weblizar_candidate_job.* FROM {$wpdb->prefix}weblizar_candidate_job INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}weblizar_candidate_job.job_id = {$wpdb->prefix}posts.ID WHERE {$wpdb->prefix}posts.post_title LIKE '%$search%' UNION ALL SELECT {$wpdb->prefix}weblizar_candidate_job.* FROM {$wpdb->prefix}weblizar_candidate_job INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}weblizar_candidate_job.candidate_id = {$wpdb->prefix}posts.ID WHERE {$wpdb->prefix}posts.post_title LIKE '%$search%'";
	} else {
		$query = "SELECT * FROM {$wpdb->prefix}weblizar_candidate_job";
	}
	$total_query    = "SELECT COUNT(1) FROM ({$query}) AS combined_table";
	$total          = $wpdb->get_var( $total_query );
	$items_per_page = $admin_applications_per_page;
	$page           = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
	$offset         = ( $page * $items_per_page ) - $items_per_page;
	$applications   = $wpdb->get_results( $query . " ORDER BY created_at DESC LIMIT {$offset}, {$items_per_page}" ); ?>

		<div class="row">
			<div class="col">
				<h1 class="display-4 text-center"><span class="border-bottom"><i class="fa fa-envelope-open"></i> <?php esc_html_e( 'Job Applications', WEBLIZAR_DOMAIN ); ?></span></h1>
				<div class="mt-3 alert alert-secondary text-center" role="alert">
					<?php esc_html_e( "Here, you can view job applications.", WEBLIZAR_DOMAIN ); ?>
				</div>
			</div>
		</div>

		<div class="row justify-content-md-center">
			<div class="col-sm-6">
				<form method="GET" action="">
					<div class="input-group mb-3">
					<?php
					foreach( $_GET as $name => $value ) {
						$name  = htmlspecialchars( $name );
						$value = htmlspecialchars( $value );
						echo '<input type="hidden" name="'. $name .'" value="'. $value .'">';
					} ?>
						<input type="text" name="search" class="weblizar-search-job-input w-100 d-block col" placeholder="<?php esc_attr_e( "Search job title, candidate name", WEBLIZAR_DOMAIN ); ?>">
						<div class="input-group-append">
							<button type="submit" class="weblizar-search-button pt-2 pb-2"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</form>
				<?php
				if ( ! empty( $search ) ) : ?>
				<div class="weblizar-search-info text-center mb-3">
					<span><?php esc_html_e( "Showing search results for", WEBLIZAR_DOMAIN ); ?>: <strong><?php echo esc_attr( $search ); ?></strong></span>&nbsp;
					<span><a class="" href="<?php menu_page_url( 'job_applications', true ); ?>"><?php esc_html_e( "Clear filter", WEBLIZAR_DOMAIN ); ?></a></span>
				</div>
				<?php
				endif; ?>
			</div>
		</div>

		<div class="row">
			<div class="col">
				<table class="table table-hover" id="weblizar-job-application-table">
					<thead>
						<tr>
							<th scope="col"><?php esc_html_e( 'S.No.', WEBLIZAR_DOMAIN ); ?></th>
							<th scope="col"><?php esc_html_e( 'Candidate', WEBLIZAR_DOMAIN ); ?></th>
							<th scope="col"><?php esc_html_e( 'Job', WEBLIZAR_DOMAIN ); ?></th>
							<th scope="col"><?php esc_html_e( 'Applied on', WEBLIZAR_DOMAIN ); ?></th>
						</tr>
					</thead>
					<tbody>
				  	<?php foreach ( $applications as $key => $application ) {
				        $id           = $application->ID;
				        $candidate_id = $application->candidate_id;
				        $job_id       = $application->job_id;
				        $date         = date( 'd M, Y', strtotime( $application->created_at ) );

						/* Candidate link */
						$candidate_title = get_the_title( $candidate_id );
						$candidate_url   = get_edit_post_link( $candidate_id );
						$candidate_link  = '<a target="_blank" href="' . $candidate_url . '">' . $candidate_title . '</a>';

						/* Job link */
						$job_title     = get_the_title( $job_id );
						$job_permalink = get_the_permalink( $job_id );
						$job_link      = '<a target="_blank" href="' . $job_permalink . '">' . $job_title . '</a>';
				  	?>
						<tr>
							<th scope="row"><?php esc_html_e($offset + $key + 1); ?></th>
							<td><?php echo wp_kses_post( $candidate_link ); ?></td>
							<td><?php echo wp_kses_post($job_link); ?></td>
							<td><?php esc_html_e($date); ?></td>
						</tr>
				    <?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="text-right">
		<?php
		echo paginate_links( array(
				'base' => add_query_arg( 'cpage', '%#%' ),
				'format' => '',
				'prev_text' =>'&laquo;',
				'next_text' => '&raquo;',
				'total' => ceil( $total / $items_per_page ),
				'current' => $page
			) ); ?>
		</div>
	</div>
</div>
