<?php
/**
 * Plugin Name: Interview Plugin
 * Description: Custom WooCommerce functionality for interview exercises
 * Version: 1.0
 * Author: Interview Candidate
 * Requires at least: 5.8
 * Requires PHP: 7.4
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Check if WooCommerce is active
 */
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_action('admin_notices', 'interview_plugin_woocommerce_missing_notice');
    return;
}

function interview_plugin_woocommerce_missing_notice() {
    echo '<div class="error"><p><strong>Interview Plugin</strong> requires WooCommerce to be installed and activated.</p></div>';
}

// ===========================
// CANDIDATE WORKSPACE BELOW
// ===========================

/**
 * Example: Add custom tab to product page
 * Candidates will modify this during exercises
 */
add_filter('woocommerce_product_tabs', 'interview_custom_product_tab');
function interview_custom_product_tab($tabs) {
    // Example tab - candidates can modify or remove
    $tabs['interview_tab'] = array(
        'title'    => __('Custom Info', 'interview-plugin'),
        'priority' => 50,
        'callback' => 'interview_custom_product_tab_content'
    );
    return $tabs;
}

function interview_custom_product_tab_content() {
    echo '<h2>' . __('Custom Information', 'interview-plugin') . '</h2>';
    echo '<p>' . __('This is a placeholder tab for interview exercises.', 'interview-plugin') . '</p>';
}

/**
 * Your custom code goes below this line
 */
