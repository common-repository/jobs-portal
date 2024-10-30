<?php
defined( 'ABSPATH' ) || die(); ?>

<div class="weblizar-login-signup row justify-content-md-between">
	<div class="col-sm-12 col-md-6 card p-3 mt-3">
		<header>
			<div class="weblizar-signup-heading">
				<span><?php esc_html_e( 'Register and find your dream job', WEBLIZAR_DOMAIN ); ?></span>
			</div>
		</header>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="weblizar-signup-form" class="weblizar-signup-form">
			<?php $nonce = wp_create_nonce( 'signup' ); ?>
            <input type="hidden" name="signup" value="<?php echo esc_attr( $nonce ); ?>">
            <input type="hidden" name="action" value="weblizar-signup">

			<div class="form-group">
				<label for="weblizar-signup-email"><?php esc_html_e( 'Email Address', WEBLIZAR_DOMAIN ); ?></label><br>
				<input type="email" name="email" id="weblizar-signup-email" class="w-100 d-block col">
			</div>

			<div class="form-group">
				<label for="weblizar-signup-username"><?php esc_html_e( 'Username', WEBLIZAR_DOMAIN ); ?></label>
				<input type="text" name="username" id="weblizar-signup-username" class="w-100 d-block col">
			</div>

			<div class="form-group">
				<label for="weblizar-signup-password"><?php esc_html_e( 'Password', WEBLIZAR_DOMAIN ); ?></label>
				<input type="password" name="password" id="weblizar-signup-password" class="w-100 d-block col">
			</div>

			<div class="form-group">
				<label for="weblizar-signup-confirm-password"><?php esc_html_e( 'Confirm Password', WEBLIZAR_DOMAIN ); ?></label>
				<input type="password" name="confirm_password" id="weblizar-signup-confirm-password" class="w-100 d-block col">
			</div>

			<div class="float-right weblizar-signup-submit-block">
				<button type="submit" class="weblizar-signup-submit"><?php esc_html_e( 'Register', WEBLIZAR_DOMAIN ); ?></button>
			</div>
		</form>
	</div>
	<div class="col-sm-12 col-md-5 card p-3 mt-3">
		<header>
			<div class="weblizar-login-heading">
				<span><?php esc_html_e( 'Login if you already have an account', WEBLIZAR_DOMAIN ); ?></span>
			</div>
		</header>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="weblizar-login-form" class="weblizar-login-form">
			<?php $nonce = wp_create_nonce( 'login' ); ?>
            <input type="hidden" name="login" value="<?php echo esc_attr($nonce); ?>">
            <input type="hidden" name="action" value="weblizar-login">

			<div class="form-group">
				<label for="weblizar-login-username"><?php esc_html_e( 'Email Address or Username', WEBLIZAR_DOMAIN ); ?></label>
				<input type="text" name="username" id="weblizar-login-username" class="w-100 d-block col">
			</div>

			<div class="form-group">
				<label for="weblizar-login-password"><?php esc_html_e( 'Password', WEBLIZAR_DOMAIN ); ?></label>
				<input type="password" name="password" id="weblizar-login-password" class="w-100 d-block col">
			</div>

			<div class="float-right weblizar-login-submit-block">
				<button type="submit" class="weblizar-login-submit"><?php esc_html_e( 'Login', WEBLIZAR_DOMAIN ); ?></button>
			</div>
		</form>
	</div>
</div>