<?php

namespace Database\Seeders;

use App\Models\products;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\coffee_shop_admin;
use App\Models\coffee_shop_employee;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Seed Users
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'password' => Hash::make('password123'),
                'address' => $faker->address,
                'email_verified_at' => $faker->optional()->dateTimeThisYear(),
            ]);
        }

        // Seed Admins
        for ($i = 0; $i < 50; $i++) {
            $password = substr(md5('admin' . $i), 0, 50);
            
            coffee_shop_admin::create([
                'admin_name' => $faker->userName() . '_admin_' . ($i + 1),
                'admin_password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Employees
        for ($i = 0; $i < 50; $i++) {
            $admin = coffee_shop_admin::inRandomOrder()->first();
            
            coffee_shop_employee::create([
                'admin_id' => $admin ? $admin->admin_id : null,
                'employee_name' => substr($faker->name, 0, 50),
                'employee_age' => (string) $faker->numberBetween(18, 65),
                'employee_sex' => $faker->randomElement(['Male','Female']),
                'employee_phone' => substr($faker->phoneNumber, 0, 50),
                'employee_email' => substr($faker->unique()->safeEmail, 0, 50),
                'employee_address' => substr($faker->address, 0, 50),
                'employee_password' => substr(md5('employee123'), 0, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Products with realistic names
        for ($i = 0; $i < 50; $i++) {
            $category = $faker->randomElement(['Beverage', 'Tea', 'Cold Coffee', 'Hot Coffee', 'Pastry', 'Snack']);
            
            products::create([
                'product_name' => $this->generateProductName($category, $faker),
                'product_category' => $category,
                'product_price' => $this->generateProductPrice($category, $faker),
                'product_stock' => $faker->numberBetween(0, 100),
                'product_image' => null,
                'admin_id' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Cart
        $userIds = User::pluck('user_id')->toArray();
        $productIds = products::pluck('product_id')->toArray();

        // Generate cart names A1–E10 (50 total)
        $cartNames = [];
        foreach (range('A', 'E') as $letter) {
            foreach (range(1, 10) as $num) {
                $cartNames[] = "{$letter}{$num}";
            }
        }

        foreach ($cartNames as $cartName) {
            $userId = $faker->randomElement($userIds);
            $productId = $faker->randomElement($productIds);
            $product = products::find($productId);

            if ($product) {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'cart_name' => $cartName, // A1–E10 naming pattern
                    'quantity' => $faker->numberBetween(1, 5),
                    'product_image' => $product->product_image,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Seed Orders
        for ($i = 0; $i < 50; $i++) {
            $employeeId = $faker->randomElement(\App\Models\coffee_shop_employee::pluck('employee_id')->toArray());
            $orderTotalPrice = $faker->randomFloat(2, 10, 500);
            $orderPaymentMethod = $faker->randomElement(['gcash', 'cash', 'bank_transfer']);
            $orderNumber = $faker->numberBetween(100000, 999999);
            
            \App\Models\orders::create([
                'employee_id' => $employeeId,
                'order_name' => $faker->name,
                'order_number' => $orderNumber,
                'order_payment_method' => $orderPaymentMethod,
                'order_total_price' => $orderTotalPrice,
                'payment_status' => $faker->randomElement(['pending', 'completed', 'failed']),
                'order_date' => $faker->dateTimeThisYear(),
            ]);
        }

        // Seed Order Items
        $orders = \App\Models\orders::pluck('order_id')->toArray();
        $products = products::pluck('product_id', 'product_name')->toArray();
        
        // Sample product details for realistic order items
        $productDetails = [
            ['name' => 'Espresso', 'price' => 120.00],
            ['name' => 'Cappuccino', 'price' => 150.00],
            ['name' => 'Latte', 'price' => 160.00],
            ['name' => 'Americano', 'price' => 130.00],
            ['name' => 'Mocha', 'price' => 170.00],
            ['name' => 'Macchiato', 'price' => 140.00],
            ['name' => 'Flat White', 'price' => 155.00],
            ['name' => 'Cold Brew', 'price' => 145.00],
            ['name' => 'Iced Coffee', 'price' => 135.00],
            ['name' => 'Caramel Macchiato', 'price' => 180.00],
            ['name' => 'Vanilla Latte', 'price' => 165.00],
            ['name' => 'Hazelnut Coffee', 'price' => 155.00],
            ['name' => 'Croissant', 'price' => 85.00],
            ['name' => 'Blueberry Muffin', 'price' => 95.00],
            ['name' => 'Chocolate Chip Cookie', 'price' => 65.00],
            ['name' => 'Bagel', 'price' => 75.00],
            ['name' => 'Danish Pastry', 'price' => 110.00],
            ['name' => 'Scone', 'price' => 90.00],
            ['name' => 'Sandwich', 'price' => 220.00],
            ['name' => 'Salad', 'price' => 180.00],
        ];

        // Create 50 order items
        for ($i = 0; $i < 50; $i++) {
            $orderId = $faker->randomElement($orders);
            $productDetail = $productDetails[array_rand($productDetails)];
            
            // Find a product that matches the name or get a random product
            $productId = array_search($productDetail['name'], $products) ?: $faker->randomElement(array_values($products));
            
            // For products that don't exist in our predefined list, use random price
            $unitPrice = $productDetail['price'] ?? $faker->randomFloat(2, 50, 200);
            
            // Get product name for the order item
            $productName = array_search($productId, $products) ?: $productDetail['name'];
            
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $productId,
                'product_name' => $productName,
                'quantity' => $faker->numberBetween(1, 3),
                'unit_price' => $unitPrice,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Ratings
        $foodDrinkReviews = [
            "The espresso has a perfect crema and rich flavor profile.",
            "Best latte I've ever had. Perfect temperature and flavor balance.",
            "Their cold brew is smooth and refreshing, not bitter at all.",
            "The cappuccino had perfect foam consistency and coffee-to-milk ratio.",
            "Mocha was rich and chocolatey without being overly sweet.",
            "Americano is strong and robust, just how I like my coffee.",
            "The flat white was creamy with excellent espresso shots.",
            "Iced coffee maintains its flavor even with melting ice.",
            "The pour-over coffee brings out subtle fruity notes beautifully.",
            "Turkish coffee was authentic and perfectly brewed.",
            "Green tea is fresh and has a delicate, soothing flavor.",
            "Chai latte is perfectly spiced with just the right sweetness.",
            "Earl Grey tea has a wonderful bergamot aroma and taste.",
            "Iced tea is refreshing with natural fruit flavors.",
            "Herbal tea selection is diverse and always fresh.",
            "Croissants are flaky, buttery, and baked to perfection.",
            "The chocolate chip cookies are chewy with rich chocolate chunks.",
            "Blueberry muffins are moist and bursting with fresh berries.",
            "Danish pastries have light, airy layers and delicious fillings.",
            "Scones are crumbly and perfect with coffee.",
            "The avocado toast is generous with ripe avocado and seasoning.",
            "Bagels are fresh with perfect chewy texture.",
            "Sandwiches are made with quality ingredients and fresh bread.",
            "Quiche has a flaky crust and flavorful filling.",
            "Energy balls are nutritious and not too sweet.",
            "All beverages are consistently well-made across visits.",
            "Food portions are generous and reasonably priced.",
            "Ingredients taste fresh and high-quality in every item.",
            "The flavor combinations in specialty drinks are innovative.",
            "Pastries are always fresh-baked daily.",
        ];

        for ($i = 0; $i < 50; $i++) {
            $userId = $faker->randomElement($userIds);
            \App\Models\rating::create([
                'user_id' => $userId,
                'rating' => $faker->numberBetween(7, 10),
                'rating_message' => $faker->randomElement($foodDrinkReviews),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Generate realistic product names based on category
     */
    private function generateProductName($category, $faker)
    {
        $names = [
            'Hot Coffee' => [
                'Classic Espresso', 'Rich Cappuccino', 'Creamy Latte', 'Bold Americano', 
                'Chocolate Mocha', 'Caramel Macchiato', 'Smooth Flat White', 'Turkish Delight Coffee',
                'Irish Cream Coffee', 'Hazelnut Brew', 'Vanilla Bean Latte', 'Cinnamon Dolce Latte',
                'French Press Roast', 'Pour Over Blend', 'Dark Roast Coffee', 'Breakfast Blend',
                'Colombian Supreme', 'Ethiopian Yirgacheffe', 'Guatemalan Antigua', 'Sumatra Mandheling'
            ],
            'Cold Coffee' => [
                'Iced Americano', 'Cold Brew Delight', 'Iced Caramel Macchiato', 'Vanilla Sweet Cream Cold Brew',
                'Nitro Cold Brew', 'Iced Mocha', 'Caramel Frappuccino', 'Java Chip Frappe',
                'Iced White Chocolate Mocha', 'Vietnamese Iced Coffee', 'Spanish Latte Iced',
                'Hazelnut Iced Coffee', 'Coconut Cold Brew', 'Salted Caramel Iced Coffee',
                'Mocha Frappe', 'Iced Latte', 'Cold Brew with Sweet Foam', 'Iced Espresso',
                'Caramel Cloud Brew', 'Iced Cinnamon Coffee'
            ],
            'Tea' => [
                'English Breakfast Tea', 'Earl Grey Classic', 'Jasmine Green Tea', 'Chamomile Herbal Tea',
                'Peppermint Refresh', 'Matcha Green Tea Latte', 'Spiced Chai Latte', 'Honey Lemon Ginger Tea',
                'Thai Iced Tea', 'Moroccan Mint Tea', 'Oolong Tea', 'Darjeeling First Flush',
                'Hibiscus Sunrise Tea', 'Berry Fusion Herbal Tea', 'Mango Black Tea', 'Peach Iced Tea',
                'Lemon Grass Tea', 'Rooibos Red Tea', 'White Peach Tea', 'Citrus Green Tea'
            ],
            'Beverage' => [
                'Hot Chocolate', 'White Chocolate Mocha', 'Steamed Milk', 'Caramel Apple Cider',
                'Vanilla Steamer', 'Fresh Orange Juice', 'Apple Cranberry Juice', 'Sparkling Lemonade',
                'Strawberry Smoothie', 'Mango Banana Smoothie', 'Mixed Berry Blast', 'Vanilla Milkshake',
                'Chocolate Shake', 'Caramel Frappe', 'Italian Soda', 'Sparkling Water with Lime',
                'Coconut Water', 'Almond Milk Latte', 'Oat Milk Steamer', 'Iced Chocolate'
            ],
            'Pastry' => [
                'Butter Croissant', 'Chocolate Croissant', 'Almond Croissant', 'Blueberry Muffin',
                'Chocolate Chip Muffin', 'Cinnamon Roll', 'Apple Danish', 'Cheese Danish',
                'Scone with Jam', 'Chocolate Chip Scone', 'Banana Nut Bread', 'Pound Cake Slice',
                'Red Velvet Cake', 'Classic Tiramisu', 'Chocolate Éclair', 'Fruit Tart',
                'Lemon Bar', 'Double Chocolate Brownie', 'Blondie Square', 'Macaron Assortment'
            ],
            'Snack' => [
                'Bagel with Cream Cheese', 'Avocado Toast', 'Breakfast Sandwich', 'Ham & Cheese Croissant',
                'Turkey Panini', 'Caprese Sandwich', 'Granola Bar', 'Protein Energy Bar',
                'Trail Mix Cup', 'Yogurt Parfait', 'Fresh Fruit Cup', 'Vegetable Hummus Wrap',
                'Spinach & Feta Quiche', 'Potato Chips', 'Mixed Nuts', 'Rice Krispie Treat',
                'Cheese Stick', 'Apple Slices with Peanut Butter', 'Veggie Sticks with Dip', 'Hard Boiled Eggs'
            ]
        ];

        return $faker->randomElement($names[$category]);
    }

    /**
     * Generate realistic prices based on category
     */
    private function generateProductPrice($category, $faker)
    {
        $priceRanges = [
            'Hot Coffee' => [2.50, 6.00],
            'Cold Coffee' => [3.00, 7.50],
            'Tea' => [2.00, 5.50],
            'Beverage' => [1.50, 5.00],
            'Pastry' => [2.00, 8.00],
            'Snack' => [3.00, 12.00]
        ];

        [$min, $max] = $priceRanges[$category];
        return $faker->randomFloat(2, $min, $max);
    }
}