# 🚀 BOM Setup Guide - Quick Start

## **Step 1: Install the Database Table**

1. **Open your browser** and go to:
   ```
   http://localhost/projects/snackoh/create_ingredient_usage_table.php
   ```

2. **You should see** a success message like:
   ```
   ✓ Ingredient usage table created successfully
   ✓ Index created successfully
   Installation completed!
   ```

## **Step 2: Test the BOM Tracking Page**

1. **Go to the BOM Tracking page**:
   ```
   http://localhost/projects/snackoh/ingredient_usage_tracking.php
   ```

2. **You should see** either:
   - ✅ **"No Data Yet"** message (normal if no sales made yet)
   - ✅ **Usage data table** (if you've already made sales)

## **Step 3: Create Your First BOM Flow**

### **A. Create a Recipe**
1. Go to **Recipes** page
2. Create a recipe (e.g., "Bread Recipe")
3. Add ingredients:
   - Flour: 500g
   - Yeast: 10g
   - Water: 300ml
4. Save the recipe

### **B. Create a Product with Recipe**
1. Go to **Create Product** page
2. Create a product (e.g., "White Bread")
3. **Important**: Select the recipe you created
4. Set quantity, price, etc.
5. Save the product

### **C. Add Ingredients to Stock**
1. Go to **Manage Stock** page
2. Add ingredients:
   - Flour (with quantity)
   - Yeast (with quantity)
   - Water (with quantity)
3. Save each ingredient

### **D. Test the BOM System**
1. Go to **POS** page
2. Add your product to cart
3. Complete the sale
4. Check that:
   - Product stock decreased
   - Ingredients were consumed
   - Usage was logged in BOM Tracking

## **🎯 What You'll See**

### **When Sale is Successful:**
```
✅ Order saved successfully! Inventory has been updated.
```

### **When Stock is Insufficient:**
```
❌ Cannot process order due to insufficient inventory:

Insufficient Product Stock:
White Bread (Available: 5, Needed: 10)

Insufficient Ingredients:
Flour (Available: 2000g, Needed: 5000g)
```

### **In BOM Tracking Page:**
- **Product consumption history**
- **Ingredient usage patterns**
- **Transaction details**
- **Payment information**

## **🔧 Troubleshooting**

### **If you get "Table doesn't exist" error:**
1. Run the installation script: `create_ingredient_usage_table.php`
2. Refresh the page

### **If no data shows in BOM Tracking:**
1. Make sure you've created recipes with ingredients
2. Make sure products are linked to recipes
3. Make sure ingredients are added to stock
4. Make a test sale in POS

### **If sales fail with "insufficient inventory":**
1. Check product stock quantities
2. Check ingredient stock quantities
3. Add more stock as needed

## **📊 Expected Results**

After a successful sale of 2 "White Bread" items:

**Product Stock:**
- White Bread: -2 units

**Ingredient Consumption:**
- Flour: -1000g (500g × 2)
- Yeast: -20g (10g × 2)
- Water: -600ml (300ml × 2)

**BOM Tracking Page:**
- Shows consumption records
- Links to transaction details
- Tracks usage history

---

**🎉 Your BOM system is now ready! The system will automatically track ingredient consumption and prevent overselling.** 