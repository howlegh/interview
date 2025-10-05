<?php
/**
 * DEBUGGING EXERCISE 2: Custom Product Fee Not Working
 *
 * SCENARIO: Client wants to add a $5 "express shipping fee" when
 * express shipping is selected, but only for orders under $100.
 * This code was written but doesn't work correctly.
 *
 * TASK: Identify all bugs and explain the issues.
 */

add_action('woocommerce_cart_calculate_fees', 'add_express_shipping_fee');
function add_express_shipping_fee() {
    $chosen_methods = WC()->session->get('chosen_shipping_methods');
    $chosen_shipping = $chosen_methods[0];

    if ($chosen_shipping == 'express') {
        if (WC()->cart->subtotal < 100) {
            WC()->cart->add_fee('Express Handling', 5);
        }
    }
}

/**
 * ISSUES TO FIND:
 * 1. Shipping method ID is unlikely to be just 'express' (usually 'flat_rate:1' or similar)
 * 2. Should check if $chosen_methods exists and is an array before accessing [0]
 * 3. Using == instead of strpos() or more robust matching for shipping method
 * 4. Not checking if WC()->cart or WC()->session exist
 * 5. Fee amount should probably be negative or use proper fee structure
 * 6. subtotal might not be the right property (could be cart->get_subtotal())
 * 7. No escaping/sanitization of values
 * 8. Magic numbers (5, 100) should be constants or options
 */
