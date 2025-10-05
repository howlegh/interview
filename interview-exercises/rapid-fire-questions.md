# Rapid-Fire Verbal Questions

Use these to quickly assess deep knowledge. Experts should answer in 30-60 seconds.

---

## WooCommerce Architecture (10 questions)

### 1. Product Types vs Product Classes
**Question:** "What's the difference between a product type and a product class in WooCommerce?"

**Expert Answer:**
- Product type = simple, variable, grouped, external (the kind of product)
- Product class = the PHP class that handles it (WC_Product_Simple, WC_Product_Variable, etc.)
- Types are user-facing, classes are developer-facing
- Custom product types need custom classes extending WC_Product

**Red Flag:** Doesn't know the difference or thinks they're the same thing.

---

### 2. Order Status Flow
**Question:** "Walk me through WooCommerce's default order status flow and where you'd hook in for custom statuses."

**Expert Answer:**
- Pending → Processing (or On-Hold for certain payment methods) → Completed
- Failed, Cancelled, Refunded are alternate paths
- Hook: `wc_register_order_status` to create custom status
- Hook: `wc_order_statuses` filter to add to admin UI
- Custom statuses need 'wc-' prefix in slug but not in display

**Red Flag:** Can't name the statuses or doesn't know about the 'wc-' prefix.

---

### 3. Cart Calculation Hooks
**Question:** "When would you use `woocommerce_before_calculate_totals` vs `woocommerce_cart_calculate_fees`?"

**Expert Answer:**
- `before_calculate_totals`: Modify item prices, quantities, or cart items before calculations
- `cart_calculate_fees`: Add fees (shipping, handling, etc.) after totals are calculated
- Wrong hook = infinite loops or incorrect totals
- `before_calculate_totals` runs multiple times (AJAX, checkout, cart page)

**Red Flag:** Doesn't know the difference or uses them interchangeably.

---

### 4. WC() vs Global $woocommerce
**Question:** "Explain the difference between `WC()->cart` and `global $woocommerce; $woocommerce->cart`."

**Expert Answer:**
- `WC()` is the modern way (WooCommerce 2.1+)
- `global $woocommerce` is deprecated but still works
- `WC()` is a function that returns the main WooCommerce instance
- Same object, different access method
- Always use `WC()` in new code

**Red Flag:** Doesn't know `WC()` exists or prefers global for no reason.

---

### 5. WooCommerce Session
**Question:** "What does `WC()->session` do and when would you use it?"

**Expert Answer:**
- Stores cart data, chosen shipping, customer info across page loads
- Uses cookies + database (not PHP sessions)
- Persists for logged-out users
- Use it for temporary data that needs to survive page refresh
- Example: storing custom cart metadata

**Red Flag:** Doesn't know what it is or thinks it's just PHP sessions.

---

### 6. Template Override
**Question:** "What's the proper way to override a WooCommerce template in a child theme?"

**Expert Answer:**
- Copy template from `woocommerce/templates/` to `child-theme/woocommerce/`
- Keep the same folder structure (e.g., `woocommerce/cart/cart.php`)
- Don't edit plugin files directly (lost on updates)
- Add a comment noting WooCommerce version for compatibility tracking
- Can also use hooks instead of template overrides

**Red Flag:** Wants to edit plugin files directly or doesn't know about the `woocommerce/` folder.

---

### 7. Hook Priority
**Question:** "Why does hook priority matter in WooCommerce? Give an example."

**Expert Answer:**
- Default priority is 10
- Lower numbers run first (5 before 10)
- Important for order of operations (e.g., modify price before calculating fees)
- Conflicts happen when multiple plugins use same hook
- Example: Price modification must happen before tax calculation

**Red Flag:** Doesn't understand priority or says "I just use 10 for everything."

---

### 8. Product Data Store
**Question:** "What is `WC_Product_Data_Store_CPT` and when would you interact with it?"

**Expert Answer:**
- Handles reading/writing product data to database
- CPT = Custom Post Type (products are posts)
- Direct interaction rare (usually use `WC_Product` methods)
- Useful for bulk operations or custom product types
- Part of WooCommerce's CRUD system

**Red Flag:** Never heard of it (suggests surface-level knowledge only).

---

### 9. Action Scheduler
**Question:** "What is WooCommerce's Action Scheduler and when would you use it?"

**Expert Answer:**
- Background task/cron system built into WooCommerce
- Used for scheduled emails, subscription renewals, etc.
- Better than WP-Cron (more reliable)
- Schedule tasks with `as_schedule_single_action()` or `as_schedule_recurring_action()`
- View scheduled actions in WooCommerce → Status → Scheduled Actions

**Red Flag:** Doesn't know about it or confuses it with WP-Cron.

---

### 10. REST API vs WP-Admin
**Question:** "When would you use the WooCommerce REST API instead of direct database queries?"

**Expert Answer:**
- REST API: External integrations, mobile apps, headless setups
- Respects permissions, validation, and hooks
- Direct queries bypass WooCommerce logic (dangerous)
- Always use WooCommerce CRUD methods (`wc_create_order()`, etc.), not raw SQL
- REST API for external, CRUD for internal

**Red Flag:** Suggests direct database queries or doesn't know CRUD methods exist.

---

## Performance & Best Practices (5 questions)

### 11. Slow Checkout Investigation
**Question:** "A client says checkout is slow. What are your first three investigation points?"

**Expert Answer:**
1. Check payment gateway (external API calls can timeout)
2. Check for plugin conflicts (disable non-essential plugins)
3. Look at server logs and Query Monitor for slow queries
4. Bonus: Check if tax calculations are slow (complex tax rules)

**Red Flag:** Immediately blames hosting without investigating.

---

### 12. Transients vs Object Cache
**Question:** "When would you use transients vs object cache vs custom database tables for storing WooCommerce data?"

**Expert Answer:**
- **Transients:** Temporary data with expiration (API responses, calculated values)
- **Object Cache:** Per-page-load caching (with Redis/Memcached for persistence)
- **Custom Tables:** Large datasets, complex queries, data that doesn't fit post meta
- WooCommerce uses custom tables for orders (HPOS), analytics
- Never store in options table (slow for large datasets)

**Red Flag:** Doesn't know the difference or only knows one method.

---

### 13. HPOS (High-Performance Order Storage)
**Question:** "What is HPOS and how does it affect WooCommerce development?"

**Expert Answer:**
- Stores orders in custom tables instead of posts (WooCommerce 7.0+)
- Much faster for stores with many orders
- Use `wc_get_order()` instead of `get_post_meta()` for compatibility
- Check compatibility mode (can run both simultaneously)
- Custom code must use WooCommerce CRUD, not direct post queries

**Red Flag:** Never heard of it or still uses `get_post_meta()` for orders.

---

### 14. Unhooking WooCommerce Actions
**Question:** "What's the risk of unhooking WooCommerce's default actions without understanding them?"

**Expert Answer:**
- Can break core functionality (e.g., stock management, emails)
- Example: Removing `woocommerce_order_status_completed` breaks stock reduction
- Always check what the action does before removing
- Better to add your own action at different priority
- Document why you unhooked something

**Red Flag:** "I just remove stuff that's in the way" without research.

---

### 15. WooCommerce Logging
**Question:** "How do you properly log debugging information in WooCommerce?"

**Expert Answer:**
- Use `wc_get_logger()` for WooCommerce-specific logging
- Better than `error_log()` because it's centralized
- View logs in WooCommerce → Status → Logs
- Example: `wc_get_logger()->debug('Message', ['source' => 'my-plugin']);`
- Don't use `var_dump()` or `print_r()` in production

**Red Flag:** Only knows `var_dump()` or doesn't log at all.

---

## Plugin & Theme Development (5 questions)

### 16. Update-Proof Custom Code
**Question:** "How do you make custom plugin/theme code update-proof when WooCommerce core changes?"

**Expert Answer:**
- Never edit plugin files directly (use child themes/custom plugins)
- Use hooks and filters instead of template overrides when possible
- Follow semantic versioning and test before updating WooCommerce
- Subscribe to WooCommerce developer blog for breaking changes
- Use `wc_deprecated_function()` notices during development

**Red Flag:** Edits core files or doesn't test updates.

---

### 17. Child Theme vs Plugin
**Question:** "When should WooCommerce customizations go in a child theme vs a plugin?"

**Expert Answer:**
- **Child Theme:** Display/presentation changes, template overrides, styling
- **Plugin:** Business logic, custom functionality, features that work across themes
- Rule of thumb: If it should survive a theme change, use a plugin
- Example: Custom product types = plugin, custom checkout layout = theme

**Red Flag:** Puts everything in functions.php regardless of purpose.

---

### 18. WooCommerce Naming Conventions
**Question:** "Why do WooCommerce order statuses need the 'wc-' prefix?"

**Expert Answer:**
- WordPress post status limitation (namespace collision)
- WooCommerce uses post statuses for orders (legacy, changing with HPOS)
- Prefix prevents conflicts with core WP statuses (publish, draft, etc.)
- When registering: use 'wc-', when displaying: remove prefix
- Example: slug = 'wc-processing', label = 'Processing'

**Red Flag:** Doesn't know or has been confused by this before.

---

### 19. Variable Products
**Question:** "How do variable products work under the hood? What's a variation vs a variable product?"

**Expert Answer:**
- Variable product = parent (e.g., "T-Shirt")
- Variations = children with specific attributes (e.g., "T-Shirt - Blue - Large")
- Parent is `WC_Product_Variable`, children are `WC_Product_Variation`
- Variations are separate posts (post_type = 'product_variation')
- Attributes must be product-level before creating variations

**Red Flag:** Confuses the two or doesn't know variations are separate posts.

---

### 20. Payment Gateway Integration
**Question:** "What's the basic structure of a custom WooCommerce payment gateway?"

**Expert Answer:**
- Extend `WC_Payment_Gateway` class
- Implement required methods: `process_payment()`, `init_form_fields()`
- Register with `woocommerce_payment_gateways` filter
- Handle IPN/webhooks for async payments
- Use `$order->payment_complete()` when payment succeeds

**Red Flag:** Never built one and can't describe the process.

---

## Scoring

- **18-20 correct:** Expert level
- **14-17 correct:** Strong senior developer
- **10-13 correct:** Solid mid-level
- **6-9 correct:** Junior with some experience
- **<6 correct:** Insufficient WooCommerce knowledge

**Time each question:** If they take >90 seconds, they're likely guessing or don't really know.
