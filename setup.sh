#!/bin/bash

echo "🚀 Starting WooCommerce Interview Environment Setup..."
echo ""

# Start Docker containers
echo "📦 Starting Docker containers..."
docker-compose up -d

echo "⏳ Waiting for WordPress to initialize (45 seconds)..."
sleep 45

echo ""
echo "📥 Installing WooCommerce..."
docker-compose run --rm wpcli wp plugin install woocommerce --activate

echo "🎨 Installing Storefront theme..."
docker-compose run --rm wpcli wp theme install storefront --activate

echo "👶 Activating Interview child theme..."
docker-compose run --rm wpcli wp theme activate interview-theme

echo "🔌 Activating Interview plugin..."
docker-compose run --rm wpcli wp plugin activate interview-plugin

echo ""
echo "⚙️  Configuring WooCommerce..."
docker-compose run --rm wpcli wp option update woocommerce_store_address "123 Interview St"
docker-compose run --rm wpcli wp option update woocommerce_store_city "Test City"
docker-compose run --rm wpcli wp option update woocommerce_default_country "US:CA"
docker-compose run --rm wpcli wp option update woocommerce_currency "USD"
docker-compose run --rm wpcli wp option update woocommerce_calc_taxes "no"

# Skip WooCommerce setup wizard
docker-compose run --rm wpcli wp option update woocommerce_task_list_hidden "yes"
docker-compose run --rm wpcli wp option update woocommerce_onboarding_opt_in "no"

# Set permalinks to pretty URLs
echo "🔗 Setting up permalinks..."
docker-compose run --rm wpcli wp rewrite structure '/%postname%/' --hard

echo ""
echo "✅ Setup complete!"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🌐 Site URL:     http://localhost:8080"
echo "🔧 Admin URL:    http://localhost:8080/wp-admin"
echo "👤 Username:     admin"
echo "🔑 Password:     admin"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "📝 Your workspace files:"
echo "   • wp-content/themes/interview-theme/functions.php"
echo "   • wp-content/plugins/interview-plugin/interview-plugin.php"
echo ""
echo "💡 Optional: Run ./sample-data.sh to add sample products"
echo ""
