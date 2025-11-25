<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateProductCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:update-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update existing product categories to use the new standardized format and reorganize images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting product category update...');

        // Mapping of old category names to new ones
        $categoryMap = [
            'Coffee' => 'coffee',
            'Main Dish' => 'main-dish',
            'Drinks' => 'drinks',
            'Desserts' => 'desserts',
        ];

        $products = Product::all();
        $updatedCount = 0;
        $imagesMoved = 0;

        foreach ($products as $product) {
            $oldCategory = $product->product_category;
            
            // Check if category needs updating
            if (isset($categoryMap[$oldCategory])) {
                $newCategory = $categoryMap[$oldCategory];
                
                $this->line("Updating product: {$product->product_name}");
                $this->line("  Old category: {$oldCategory}");
                $this->line("  New category: {$newCategory}");
                
                // Update the category
                $product->product_category = $newCategory;
                
                // Move the image to the new category folder if it exists
                if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
                    $oldImagePath = $product->product_image;
                    
                    // Get the filename from the old path
                    $filename = basename($oldImagePath);
                    
                    // Create new path with category folder
                    $newImagePath = "products/{$newCategory}/{$filename}";
                    
                    // Move the file
                    if (Storage::disk('public')->move($oldImagePath, $newImagePath)) {
                        $product->product_image = $newImagePath;
                        $imagesMoved++;
                        $this->line("  Image moved to: {$newImagePath}");
                    } else {
                        $this->error("  Failed to move image: {$oldImagePath}");
                    }
                }
                
                $product->save();
                $updatedCount++;
                $this->line('');
            } else {
                // Category is already in the new format or unknown
                $this->line("Skipping product: {$product->product_name} (category: {$oldCategory})");
            }
        }

        $this->info("Update complete!");
        $this->info("Products updated: {$updatedCount}");
        $this->info("Images moved: {$imagesMoved}");

        return Command::SUCCESS;
    }
}

