<?php

defined('ABSPATH') || die();

require_once WEBLIZAR_PLUGIN_DIR_PATH . 'includes/Weblizar_Helper.php';
require_once WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/Weblizar_Language.php';
require_once WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/Weblizar_Job_Front.php';
require_once WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/Weblizar_Candidate_Front.php';
require_once WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/Weblizar_Shortcode.php';
require_once WEBLIZAR_PLUGIN_DIR_PATH . 'public/inc/Weblizar_User.php';

/* Load translation */
add_action('plugins_loaded', ['Weblizar_Language', 'load_translation']);

/* Register post types */
add_action('init', ['Weblizar_Job_Front', 'register_job_post_type']);
add_action('init', ['Weblizar_Candidate_Front', 'register_candidate_post_type']);

/* Flush rewrite rule if flag is set */
add_action('init', ['Weblizar_Helper', 'flush_rewrite_rules_maybe'], 20);

/* Register taxonomies */
add_action('init', ['Weblizar_Job_Front', 'register_job_type_taxonomy']);
add_action('init', ['Weblizar_Job_Front', 'register_industry_taxonomy']);
add_action('init', ['Weblizar_Job_Front', 'register_department_taxonomy']);
add_action('init', ['Weblizar_Job_Front', 'register_skill_taxonomy']);
add_action('init', ['Weblizar_Job_Front', 'register_job_location_taxonomy']);

/* Include templates */
add_filter('single_template', ['Weblizar_Job_Front', 'single_template']);

/* Enqueue scripts and styles */
add_action('wp_enqueue_scripts', ['Weblizar_Job_Front', 'enqueue_scripts_styles']);

/* Shortcodes */
add_shortcode('job_portal', ['Weblizar_Shortcode', 'job_portal']);
add_shortcode('job_portal_account', ['Weblizar_Shortcode', 'job_portal_account']);

/* Shortcode Assets */
add_action('wp_enqueue_scripts', ['Weblizar_Shortcode', 'shortcode_assets']);

/* Action to signup user */
add_action('wp_ajax_nopriv_weblizar-signup', ['Weblizar_User', 'signup']);

/* Action to login user */
add_action('wp_ajax_nopriv_weblizar-login', ['Weblizar_User', 'login']);

/* Action to update account settings */
add_action('wp_ajax_weblizar-account', ['Weblizar_User', 'update_account_settings']);

/* Action to register cv */
add_action('wp_ajax_weblizar-cv', ['Weblizar_Candidate_Front', 'register_cv']);

/* Action to update cv */
add_action('wp_ajax_weblizar-cv-update', ['Weblizar_Candidate_Front', 'update_cv']);

/* Action to delete cv */
add_action('wp_ajax_weblizar-cv-delete', ['Weblizar_Candidate_Front', 'delete_cv']);

/* Action to apply job */
add_action('wp_ajax_weblizar-job-apply', ['Weblizar_Candidate_Front', 'apply_to_job']);
