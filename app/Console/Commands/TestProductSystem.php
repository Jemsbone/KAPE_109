<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TestProductSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the product system to verify everything is working correctly';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('========================================');
        $this->info('Product System Test');
        $this->info('========================================');
        $this->newLine();

        // Test 1: Check total products
        $totalProducts = Product::count();
        $this->info("✓ Total products in database: {$totalProducts}");
        $this->newLine();

        // Test 2: Check categories
        $this->info('Category Distribution:');
        $categories = Product::select('product_category', DB::raw('count(*) as count'))
            ->groupBy('product_category')
            ->get();

        if ($categories->count() > 0) {
            foreach ($categories as $cat) {
                $this->line("  - {$cat->product_category}: {$cat->count} product(s)");
            }
        } else {
            $this->warn('  No products found in database');
        }
        $this->newLine();

        // Test 3: Check for products with stock
        $productsInStock = Product::where('product_stock', '>', 0)->count();
        $this->info("✓ Products with stock > 0: {$productsInStock}");
        $this->newLine();

        // Test 4: Check category format
        $this->info('Checking Category Format:');
        $expectedCategories = ['coffee', 'main-dish', 'drinks', 'desserts'];
        $foundCategories = Product::select('product_category')->distinct()->pluck('product_category')->toArray();
        
        $needsUpdate = false;
        foreach ($foundCategories as $cat) {
            if (!in_array($cat, $expectedCategories)) {
                $this->error("  ✗ Found non-standard category: {$cat}");
                $needsUpdate = true;
            } else {
                $this->info("  ✓ {$cat}");
            }
        }

        if ($needsUpdate) {
            $this->newLine();
            $this->warn('⚠ Some categories need updating!');
            $this->warn('Run: php artisan products:update-categories');
        } else {
            $this->info('  All categories are in correct format!');
        }
        $this->newLine();

        // Test 5: Check image paths
        $this->info('Checking Image Organization:');
        $productsWithImages = Product::whereNotNull('product_image')->get();
        
        if ($productsWithImages->count() > 0) {
            $organized = 0;
            $needsReorganizing = 0;

            foreach ($productsWithImages as $product) {
                $imagePath = $product->product_image;
                $category = $product->product_category;
                
                // Check if image is in category folder
                if (str_contains($imagePath, "products/{$category}/")) {
                    $organized++;
                } else {
                    $needsReorganizing++;
                }
            }

            $this->info("  ✓ Images in category folders: {$organized}");
            if ($needsReorganizing > 0) {
                $this->warn("  ⚠ Images needing reorganization: {$needsReorganizing}");
                $this->warn('  Run: php artisan products:update-categories');
            }
        } else {
            $this->line('  No product images found');
        }
        $this->newLine();

        // Test 6: Sample products by category
        $this->info('Sample Products by Category:');
        foreach ($expectedCategories as $cat) {
            $count = Product::where('product_category', $cat)
                ->where('product_stock', '>', 0)
                ->count();
            
            $categoryName = ucwords(str_replace('-', ' ', $cat));
            $this->line("  - {$categoryName}: {$count} available");
        }
        $this->newLine();

        // Final summary
        $this->info('========================================');
        if (!$needsUpdate && $needsReorganizing == 0) {
            $this->info('✓ System Status: All checks passed!');
            $this->info('Your product system is working correctly.');
        } else {
            $this->warn('⚠ System Status: Some issues found');
            $this->warn('Run the migration command to fix:');
            $this->warn('  php artisan products:update-categories');
        }
        $this->info('========================================');

        return Command::SUCCESS;
    }
}

