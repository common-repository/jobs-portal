<?php

defined('ABSPATH') || die();

require_once WEBLIZAR_PLUGIN_DIR_PATH . 'admin/inc/Weblizar_Job.php';
require_once WEBLIZAR_PLUGIN_DIR_PATH . 'admin/inc/Weblizar_Candidate.php';
require_once WEBLIZAR_PLUGIN_DIR_PATH . 'admin/inc/Weblizar_Menu.php';
require_once WEBLIZAR_PLUGIN_DIR_PATH . 'admin/inc/Weblizar_Setting.php';
require_once WEBLIZAR_PLUGIN_DIR_PATH . 'includes/Weblizar_Helper.php';

/* Add plugin settings link */
add_filter('plugin_action_links_' . WEBLIZAR_PLUGIN_BASE_NAME, ['Weblizar_Setting', 'add_settings_link']);

/* Add metaboxes */
add_action('add_meta_boxes', ['Weblizar_Job', 'add_meta_boxes']);
add_action('add_meta_boxes', ['Weblizar_Candidate', 'add_meta_boxes']);

/* Enqueue scripts and styles */
add_action('admin_enqueue_scripts', ['Weblizar_Job', 'enqueue_scripts_styles']);
add_action('admin_enqueue_scripts', ['Weblizar_Candidate', 'enqueue_scripts_styles']);

/* Save metaboxes */
add_action('save_post', ['Weblizar_Job', 'save_metaboxes'], 10, 2);
add_action('save_post', ['Weblizar_Candidate', 'save_metaboxes'], 10, 2);

/* Delete candidate's document */
add_action('before_delete_post', ['Weblizar_Candidate', 'delete_document'], 10, 2);

/* File uploads in candidate post type */
add_action('post_edit_form_tag', ['Weblizar_Candidate', 'edit_form_tag']);

/* Change title text */
add_filter('enter_title_here', ['Weblizar_Candidate', 'change_title_text']);

/* Set candidate columns */
add_filter('manage_candidate_posts_columns', ['Weblizar_Candidate', 'set_columns']);

/* Create menu */
add_action('admin_menu', ['Weblizar_Menu', 'create_menu']);

/* Register settings */
add_action('admin_init', ['Weblizar_Setting', 'register_settings']);

// Review Notice Box
add_action('admin_notices', 'review_admin_notice_job_portal_free');

function review_admin_notice_job_portal_free() {
    global $pagenow;
    $aatp_screen = get_current_screen();

    if (isset($_GET['page']) && $_GET['page'] === 'go_to_pro') {
        include 'banner.php';
    }
}
