<?php
/**
 * DEBUGGING EXERCISE 1: Broken Discount Code
 *
 * SCENARIO: Client reports that this discount code isn't working.
 * The discount should apply automatically when cart has more than 5 items.
 *
 * TASK: Find all the bugs and explain what's wrong.
 */

add_action('woocommerce_before_checkout_form', 'apply_bulk_discount');
function apply_bulk_discount() {
    global $woocommerce;

    if (WC()->cart->get_cart_contents_count() > 5) {
        WC()->cart->add_discount('BULK10');
    }
}

/**
 * ISSUES TO FIND:
 * 1. Hook runs on every page load, not just on form submission
 * 2. add_discount() is deprecated (use apply_coupon() instead)
 * 3. No validation if coupon 'BULK10' exists
 * 4. No check if coupon already applied (will try to apply repeatedly)
 * 5. Using global $woocommerce when WC() is available
 * 6. Should check if WC()->cart exists
 * 7. Hook priority not specified (could conflict with other plugins)
 */
