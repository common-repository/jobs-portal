<?php
defined( 'ABSPATH' ) || die(); ?>

<div class="col-sm-12 col-md-12 card p-3 mt-3">
	<header>
		<div class="weblizar-account-heading p-3">
			<span><?php esc_html_e( 'Account Settings', WEBLIZAR_DOMAIN ); ?></span>
		</div>
	</header>
	<form method="post" action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" id="weblizar-account-form" class="weblizar-account-form">
		<?php
			$user             = wp_get_current_user();
			$account_email    = $user->user_email;
			$account_username = $user->user_login;
		?>
        <input type="hidden" name="action" value="weblizar-account">

		<div class="form-group mt-4">
			<label><?php esc_html_e( 'Username', WEBLIZAR_DOMAIN ); ?></label><br>
			<span><?php esc_html_e( $account_username ); ?></span>
			<a href="javascript:void(0)" id="weblizar-change-password-email-button" class="ml-2"><?php esc_html_e( 'Change Password', WEBLIZAR_DOMAIN ); ?></a>
		</div>

		<div class="weblizar-change-password-email">
			<div class="form-group">
				<label for="weblizar-account-email"><?php esc_html_e( 'Email Address', WEBLIZAR_DOMAIN ); ?></label><br>
				<input type="email" name="email" id="weblizar-account-email" class="w-100 d-block col" value="<?php echo esc_attr( $account_email ); ?>">
			</div>

			<div class="form-group">
				<label for="weblizar-signup-password"><?php esc_html_e( 'Password', WEBLIZAR_DOMAIN ); ?></label>
				<input type="password" name="password" id="weblizar-signup-password" class="w-100 d-block col">
			</div>

			<div class="form-group">
				<label for="weblizar-account-confirm-password"><?php esc_html_e( 'Confirm Password', WEBLIZAR_DOMAIN ); ?></label>
				<input type="password" name="confirm_password" id="weblizar-account-confirm-password" class="w-100 d-block col">
			</div>

			<div class="float-right weblizar-account-submit-block">
				<button type="submit" class="weblizar-account-submit"><?php esc_html_e( 'Update', WEBLIZAR_DOMAIN ); ?></button>
			</div>
		</div>
	</form>
</div>