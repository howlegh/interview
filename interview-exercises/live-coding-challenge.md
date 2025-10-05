# Live Coding Challenges

These are exercises to give candidates during the interview. They can use AI tools, but watch their process.

---

## Challenge 1: Cart Fee Based on Shipping Method

**Difficulty:** Medium

**Scenario:**
A client sells fragile items. When customers select "Express Shipping", add a $5 "Express Handling Fee" to the cart, but ONLY for orders under $100 (orders over $100 get free express handling).

**Requirements:**
1. Add the fee using WooCommerce's fee system
2. Check the selected shipping method properly
3. Only apply to orders under $100 subtotal
4. Make sure the fee updates when shipping method changes
5. Handle edge cases (no shipping method selected, cart empty, etc.)

**Add the code to:** `wp-content/themes/interview-theme/functions.php`

**What to watch for:**
- ✅ Uses `woocommerce_cart_calculate_fees` hook
- ✅ Checks if cart/session exists before accessing
- ✅ Properly validates shipping method (not just checking string equality)
- ✅ Uses `WC()->cart->get_subtotal()` or similar method
- ✅ Tests edge cases
- ❌ Copies code without understanding it
- ❌ Doesn't test if it actually works
- ❌ Hardcodes values without explaining them

---

## Challenge 2: Custom Product Tab with Dynamic Content

**Difficulty:** Medium-Hard

**Scenario:**
Client wants a "Shipping Info" tab on product pages that displays:
- "Free shipping on orders over $50" (always shown)
- Product dimensions if they exist
- Estimated delivery time based on product weight:
  - Under 5 lbs: "2-3 business days"
  - 5-20 lbs: "3-5 business days"
  - Over 20 lbs: "5-7 business days"

**Requirements:**
1. Add a new product tab
2. Display content dynamically based on product data
3. Handle products without weight/dimensions gracefully
4. Make the content easily editable (bonus: use constants or options)

**Add the code to:** `wp-content/plugins/interview-plugin/interview-plugin.php`

**What to watch for:**
- ✅ Uses `woocommerce_product_tabs` filter
- ✅ Gets product object correctly
- ✅ Checks if product data exists before displaying
- ✅ Clean, semantic HTML output
- ✅ Considers accessibility (headings, structure)
- ❌ Doesn't check if data exists (causes warnings/errors)
- ❌ Messy output with inline styles
- ❌ Uses deprecated methods

---

## Challenge 3: Custom Order Status

**Difficulty:** Hard

**Scenario:**
Client has a custom fulfillment process. They need a custom order status called "Quality Check" that comes after "Processing" but before "Completed".

**Requirements:**
1. Register the custom order status
2. Add it to the order status list in admin
3. Make it available in bulk actions
4. Add it to the order status workflow (appears in dropdown)
5. Bonus: Add a custom color/icon for the status

**Add the code to:** `wp-content/plugins/interview-plugin/interview-plugin.php`

**What to watch for:**
- ✅ Uses `wc_register_order_status` correctly
- ✅ Adds to `wc_order_statuses` filter
- ✅ Adds to bulk actions (`bulk_actions-edit-shop_order`)
- ✅ Understands the 'wc-' prefix requirement
- ✅ Tests it in admin UI
- ❌ Forgets the 'wc-' prefix (common mistake!)
- ❌ Registers status but doesn't add to admin UI
- ❌ Can't explain when/why you'd use custom statuses

**Follow-up questions:**
- "Why does the status need the 'wc-' prefix?"
- "How would you trigger an email when an order reaches this status?"
- "What's the difference between order status and order post status?"

---

## Challenge 4: Price Modifier Based on Quantity

**Difficulty:** Medium

**Scenario:**
Client wants bulk pricing:
- 1-9 items: Regular price
- 10-49 items: 10% off
- 50+ items: 20% off

This should apply PER PRODUCT in the cart (not total cart quantity).

**Requirements:**
1. Modify prices in cart based on quantity
2. Display the discount clearly
3. Don't break variable products or other product types
4. Make sure it recalculates correctly

**Add the code to:** `wp-content/themes/interview-theme/functions.php`

**What to watch for:**
- ✅ Uses `woocommerce_before_calculate_totals` hook
- ✅ Checks if it's admin/AJAX to avoid issues
- ✅ Iterates cart items correctly
- ✅ Sets prices using correct methods
- ✅ Doesn't cause infinite loops
- ❌ Uses wrong hook (calculate_fees, etc.)
- ❌ Breaks the cart total calculation
- ❌ Doesn't check for admin/AJAX context

**Gotcha question:**
"What happens if someone changes quantity in cart? Does it recalculate?"

---

## How to Use These Challenges

### Setup:
1. Share your screen or have them share theirs
2. Paste the scenario into chat or show it on screen
3. Set a timer (15-20 minutes)
4. Tell them AI tools are encouraged

### During:
- Watch their workflow, not just the end result
- Ask "what are you thinking?" if they're quiet
- Note if they test as they go
- See if they read WooCommerce docs or just ask AI

### After:
- Ask them to explain their code line-by-line
- Ask "what could break this?"
- Ask "how would you test this in production?"
- Give them a hypothetical edge case

### Red Flags:
- 🚩 Copies large blocks without reading
- 🚩 Can't explain what their code does
- 🚩 Doesn't test anything
- 🚩 Gives up immediately when something doesn't work
- 🚩 No consideration for edge cases

### Green Flags:
- ✅ Tests incrementally as they build
- ✅ Checks WooCommerce documentation
- ✅ Explains tradeoffs ("I could do X or Y, but...")
- ✅ Asks clarifying questions
- ✅ Uses AI as a tool, not a crutch
- ✅ Considers performance and security
