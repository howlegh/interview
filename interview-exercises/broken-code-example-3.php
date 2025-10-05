<?php
/**
 * DEBUGGING EXERCISE 3: Custom Product Field Issues
 *
 * SCENARIO: Client wants to add a "Gift Message" field to products.
 * The field should show on product page, save to cart, and display in orders.
 * This code partially works but has bugs.
 *
 * TASK: Find the issues and explain how this could fail.
 */

// Add gift message field to product page
add_action('woocommerce_before_add_to_cart_button', 'add_gift_message_field');
function add_gift_message_field() {
    echo '<div class="gift-message">';
    echo '<label>Gift Message:</label>';
    echo '<textarea name="gift_message"></textarea>';
    echo '</div>';
}

// Save gift message to cart
add_filter('woocommerce_add_cart_item_data', 'save_gift_message_to_cart', 10, 2);
function save_gift_message_to_cart($cart_item_data, $product_id) {
    if (isset($_POST['gift_message'])) {
        $cart_item_data['gift_message'] = $_POST['gift_message'];
    }
    return $cart_item_data;
}

// Display in cart
add_filter('woocommerce_get_item_data', 'display_gift_message_in_cart', 10, 2);
function display_gift_message_in_cart($item_data, $cart_item) {
    if (isset($cart_item['gift_message'])) {
        $item_data[] = array(
            'name' => 'Gift Message',
            'value' => $cart_item['gift_message']
        );
    }
    return $item_data;
}

/**
 * ISSUES TO FIND:
 * 1. No sanitization of $_POST['gift_message'] (XSS vulnerability!)
 * 2. No nonce verification (CSRF vulnerability)
 * 3. No escaping when outputting in cart
 * 4. Gift message not saved to order meta (only cart, will be lost after purchase)
 * 5. No character limit on textarea
 * 6. Field displays on ALL products (might want to restrict to certain types)
 * 7. No label 'for' attribute linking to textarea ID
 * 8. Textarea has no ID or proper attributes
 * 9. No CSS classes for styling
 * 10. Missing action to save to order meta (woocommerce_checkout_create_order_line_item)
 */
