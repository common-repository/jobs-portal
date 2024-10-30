<?php
defined( 'ABSPATH' ) || die();

global $wpdb;

?>

<div class="weblizar">
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<h1 class="mt-3 display-4 text-center bg-primary text-white pt-1 pb-3 mt-2"><span class="border-bottom"><i class="fa fa-tachometer"></i> <?php esc_html_e( 'Job Portal', WEBLIZAR_DOMAIN ); ?></span></h1>
				<!-- <div class="mt-3 alert alert-secondary text-center" role="alert">
					<?php esc_html_e( "Here, you can view job portal stats.", WEBLIZAR_DOMAIN ); ?>
				</div> -->
			</div>
		</div>

		<div class="row">
			<div class="col">
				<div class="row">					
					<div class="col-lg-12 col-md-12 col-sm-12 mb-4">
						<div class="weblizar-recent-list-title bg-primary text-white"><?php esc_html_e( "Jobs Portal Pro Features", WEBLIZAR_DOMAIN ); ?><span class="float-right"><i class="fa fa-star"></i></span></div>
						<ul class="list-group list-group-flush weblizar-recent-list">
							<li class="list-group-item">
								<div class="alert alert-primary">
									<h6><i class="fa fa-check"></i>&nbsp;&nbsp;<?php esc_html_e( "Signup as Recruiter", WEBLIZAR_DOMAIN ); ?></h6>
								</div>
								<div class="alert alert-warning">
									<h6><i class="fa fa-check"></i>&nbsp;&nbsp;<?php esc_html_e( "Separate Recruiter Dashboard", WEBLIZAR_DOMAIN ); ?></h6>
								</div>
								<div class="alert alert-info">
									<h6><i class="fa fa-check"></i>&nbsp;&nbsp;<?php esc_html_e( "Unlimited Recruiters", WEBLIZAR_DOMAIN ); ?></h6>
								</div>
								<div class="alert alert-success">
									<h6><i class="fa fa-check"></i>&nbsp;&nbsp;<?php esc_html_e( "Recruiter's Account Approval", WEBLIZAR_DOMAIN ); ?></h6>
								</div>
								<div class="row mt-2">
									<div class="col">
										<a href="http://demo.weblizar.com/jobs-portal-pro/" class="btn btn-block btn-info" target="_blank"><?php esc_html_e( "Try Pro", WEBLIZAR_DOMAIN ); ?></a>
									</div>
									<div class="col">
										<a href="https://weblizar.com/plugins/jobs-portal-pro/" class="btn btn-block btn-success" target="_blank"><?php esc_html_e( "Buy Pro", WEBLIZAR_DOMAIN ); ?></a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>