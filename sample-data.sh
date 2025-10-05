#!/bin/bash

echo "📦 Adding sample WooCommerce products..."
echo ""

# Create simple products
docker-compose run --rm wpcli wp wc product create \
  --name="Classic T-Shirt" \
  --type=simple \
  --regular_price=29.99 \
  --description="A comfortable cotton t-shirt perfect for everyday wear." \
  --short_description="Classic cotton t-shirt" \
  --manage_stock=true \
  --stock_quantity=100 \
  --user=admin

docker-compose run --rm wpcli wp wc product create \
  --name="Premium Hoodie" \
  --type=simple \
  --regular_price=59.99 \
  --sale_price=49.99 \
  --description="Premium quality hoodie with soft fleece lining." \
  --short_description="Cozy fleece hoodie on sale" \
  --manage_stock=true \
  --stock_quantity=50 \
  --user=admin

docker-compose run --rm wpcli wp wc product create \
  --name="Baseball Cap" \
  --type=simple \
  --regular_price=19.99 \
  --description="Adjustable baseball cap with embroidered logo." \
  --short_description="Adjustable baseball cap" \
  --manage_stock=true \
  --stock_quantity=75 \
  --user=admin

docker-compose run --rm wpcli wp wc product create \
  --name="Running Shoes" \
  --type=simple \
  --regular_price=89.99 \
  --description="Lightweight running shoes with cushioned sole." \
  --short_description="Lightweight performance running shoes" \
  --manage_stock=true \
  --stock_quantity=30 \
  --user=admin

docker-compose run --rm wpcli wp wc product create \
  --name="Water Bottle" \
  --type=simple \
  --regular_price=14.99 \
  --description="Insulated stainless steel water bottle, 32oz." \
  --short_description="32oz insulated water bottle" \
  --manage_stock=true \
  --stock_quantity=200 \
  --user=admin

echo ""
echo "✅ Sample products created successfully!"
echo ""
echo "🛍️  Products created:"
echo "   • Classic T-Shirt ($29.99)"
echo "   • Premium Hoodie ($49.99 - on sale!)"
echo "   • Baseball Cap ($19.99)"
echo "   • Running Shoes ($89.99)"
echo "   • Water Bottle ($14.99)"
echo ""
echo "Visit http://localhost:8080/shop to see them!"
echo ""
