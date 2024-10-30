<?php
if (!defined('ABSPATH')) {
    exit;
}
wp_enqueue_style('job-banner', WEBLIZAR_PLUGIN_URL.'/assets/css/banner.css');
$testi_banner_imgpath = WEBLIZAR_PLUGIN_URL.'/assets/images/banner.jpg'; ?>
<div class="wb_plugin_feature notice  is-dismissible">
    <div class="wb_plugin_feature_banner default_pattern pattern_ ">
        <div class="wb-col-md-12 wb-col-sm-12 box">
            <div class="ribbon"><span><?php esc_html_e('Go Pro', 'WEBLIZAR_DOMAIN'); ?></span></div>
            <a href="https://weblizar.com/plugins/jobs-portal-pro/" target="_blank">
                <img class="wp-img-responsive" src="<?php echo esc_url($testi_banner_imgpath); ?>" alt="img">
            </a>
        </div>
    </div>
</div>
