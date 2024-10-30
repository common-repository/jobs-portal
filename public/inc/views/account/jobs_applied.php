<?php
defined( 'ABSPATH' ) || die();
require_once WEBLIZAR_PLUGIN_DIR_PATH . 'includes/Weblizar_Helper.php';
$candidate_jobs_applied_per_page = Weblizar_Helper::general_candidate_jobs_applied_per_page();
?>
<div class="container">
<?php
$candidate = Weblizar_Helper::user_has_cv( get_current_user_id() );
if ( $candidate ) :
	?>
	<header>
		<div class="weblizar-cv-heading card p-3 text-center">
			<span><?php esc_html_e( 'Jobs Applied', WEBLIZAR_DOMAIN ); ?></span>
		</div>
	</header>
	<?php
	global $wpdb;
	$search = isset( $_GET['search_job'] ) ? sanitize_text_field( $_GET['search_job'] ) : '';
	if ( $search ) {
		$query = "SELECT {$wpdb->prefix}weblizar_candidate_job.* FROM {$wpdb->prefix}weblizar_candidate_job INNER JOIN {$wpdb->prefix}posts ON {$wpdb->prefix}weblizar_candidate_job.job_id = {$wpdb->prefix}posts.ID WHERE {$wpdb->prefix}weblizar_candidate_job.candidate_id = {$candidate->ID} AND {$wpdb->prefix}posts.post_title LIKE '%$search%'";
	} else {
		$query = "SELECT * FROM {$wpdb->prefix}weblizar_candidate_job WHERE candidate_id = {$candidate->ID}";
	}
	$total_query = "SELECT COUNT(1) FROM ({$query}) AS combined_table";
	$total       = $wpdb->get_var( $total_query );

	if ( $total ) :
		$items_per_page = $candidate_jobs_applied_per_page;
		$page           = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
		$offset         = ( $page * $items_per_page ) - $items_per_page;
		$applications   = $wpdb->get_results( $query . " ORDER BY created_at DESC LIMIT {$offset}, {$items_per_page}" );
		?>
	<div class="row justify-content-md-center">
		<div class="col-sm-6">
			<form method="GET" action="">
				<div class="input-group mb-3">
					<?php
					foreach ( $_GET as $name => $value ) {
						$name = htmlspecialchars( $name );
						if ( $name != 'search_job' && $name != 'cpage' ) {
							$value = htmlspecialchars( $value );
							echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
						}
					}
					?>
					<input type="text" name="search_job" class="weblizar-search-job-input w-100 d-block col" placeholder="<?php esc_attr_e( 'Search job title', WEBLIZAR_DOMAIN ); ?>">
					<div class="input-group-append">
						<button type="submit" class="weblizar-search-button pt-2 pb-2"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
				<?php
				if ( ! empty( $search ) ) :
					?>
			<div class="weblizar-search-info text-center mb-3">
				<span><?php esc_html_e( 'Showing search results for', WEBLIZAR_DOMAIN ); ?>: <strong><?php echo esc_attr( $search ); ?></strong></span>&nbsp;
				<span><a class="" href="<?php echo esc_url( $account_page_url ); ?>"><?php esc_html_e( 'Clear filter', WEBLIZAR_DOMAIN ); ?></a></span>
			</div>
					<?php
				endif;
				?>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<table class="table table-hover" id="weblizar-job-application-table" aria-describedby="job">
				<thead>
					<tr>
						<th scope="col"><?php esc_html_e( 'S.No.', WEBLIZAR_DOMAIN ); ?></th>
						<th scope="col"><?php esc_html_e( 'Job', WEBLIZAR_DOMAIN ); ?></th>
						<th scope="col"><?php esc_html_e( 'Applied on', WEBLIZAR_DOMAIN ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ( $applications as $key => $application ) {
						$id     = $application->ID;
						$job_id = $application->job_id;
						$date   = date( 'd M, Y', strtotime( $application->created_at ) );

						/* Job link */
						$job_title     = get_the_title( $job_id );
						$job_permalink = get_the_permalink( $job_id );
						$job_link      = '<a target="_blank" href="' . $job_permalink . '">' . $job_title . '</a>';
						?>
					<tr>
						<th scope="row"><?php esc_html_e( $offset + $key + 1 ); ?></th>
						<td><?php echo wp_kses_post( $job_link ); ?></td>
						<td><?php esc_html_e( $date ); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="text-right">
		<?php
		echo paginate_links(
			array(
				'base'      => add_query_arg( 'cpage', '%#%' ),
				'format'    => '',
				'prev_text' => '&laquo;',
				'next_text' => '&raquo;',
				'total'     => ceil( $total / $items_per_page ),
				'current'   => $page,
			)
		);
		?>
	</div>
		<?php
	else :
		?>
		<div class="alert alert-info text-center" role="alert">
			<?php esc_html_e( 'You have not applied to any job.', WEBLIZAR_DOMAIN ); ?>&nbsp;
			<a href="<?php echo esc_url( $job_portal_page_url ); ?>"><?php esc_html_e( 'Browse Jobs', WEBLIZAR_DOMAIN ); ?></a>
		</div>
		<?php
	endif;
else :
	?>
	<div class="alert alert-info text-center float-left mt-3" role="alert">
		<?php esc_html_e( 'Please register your CV before applying to jobs.', WEBLIZAR_DOMAIN ); ?>
	</div>
	<?php
endif;
?>
</div>
