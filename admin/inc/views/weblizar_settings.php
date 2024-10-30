<?php
defined( 'ABSPATH' ) || die(); ?>

<div class="wrap">
    <h2><?php esc_html_e( 'Job Portal Settings', WEBLIZAR_DOMAIN ) ?></h2>
    <form action="options.php" method="post">
        <?php settings_fields( 'weblizar' ); ?>
        <?php do_settings_sections( 'weblizar' ); ?>
        <input name="submit" type="submit" value="<?php esc_attr_e( 'Save Changes', WEBLIZAR_DOMAIN ); ?>" class="button button-primary" id="weblizar-setting"/>
    </form>
</div>