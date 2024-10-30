<?php
defined( 'ABSPATH' ) || die();

$job_portal_page_url = Weblizar_Helper::general_job_portal_page_url();
$account_page_url    = Weblizar_Helper::general_account_page_url();
$is_user_logged_in   = is_user_logged_in();
$signup_as           = 'candidate';
if ( $is_user_logged_in ) {
	$signup_as = get_user_meta( get_current_user_id(), 'weblizar_signup_as', true );
}
?>
<div class="wrap weblizar">
	<div class="container mt-4 mb-3">
		<div class="row justify-content-md-between">
			<div class="col-sm-12">
				<div class="float-right">
					<div class="row">
						<div class="col-sm-12 text-right weblizar-job-portal-navigation">
							<a href="<?php echo esc_url($job_portal_page_url); ?>" class="weblizar-job-portal-link pr-3 mb-3 border-bottom">&#8594; <?php esc_html_e( 'Back to Job Portal', WEBLIZAR_DOMAIN ); ?></a>
						</div>
						<?php if ( $is_user_logged_in ) : ?>
						<div class="col-sm-12 text-right weblizar-logout-navigation">
							<a href="<?php echo wp_logout_url( $job_portal_page_url ); ?>" class="weblizar-logout-link pr-3 pb-3"><?php esc_html_e( 'Logout', WEBLIZAR_DOMAIN ); ?></a>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php
				if ( $is_user_logged_in ) :
					/* Jobs Applied */
					require_once( WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/views/account/jobs_applied.php' );
					/* End Jobs Applied */
				endif;
				?>
			</div>
		</div>
		<?php if ( ! $is_user_logged_in ) :
				/* Login - Signup */
				require_once( WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/views/account/login_signup.php' );
				/* End Login - Signup */
			else : ?>
		<div class="weblizar-profile-cv-company justify-content-md-between ">
			<?php
				/* Account Settings */
				require_once( WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/views/account/settings.php' );
				/* End Account Settings */

				/* Candidate Profile */
				require_once( WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/views/account/candidate.php' );
				/* End Candidate Profile */

				
			?>
		</div>
		<?php endif; ?>
	</div>
</div>