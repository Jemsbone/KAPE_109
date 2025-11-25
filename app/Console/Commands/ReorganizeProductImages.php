<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ReorganizeProductImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:reorganize-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reorganize existing product images into category-specific folders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting image reorganization...');
        $this->newLine();

        $products = Product::whereNotNull('product_image')->get();
        
        if ($products->count() === 0) {
            $this->warn('No products with images found.');
            return Command::SUCCESS;
        }

        $moved = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($products as $product) {
            $oldImagePath = $product->product_image;
            $category = $product->product_category;
            
            $this->line("Processing: {$product->product_name}");
            $this->line("  Current path: {$oldImagePath}");
            $this->line("  Category: {$category}");
            
            // Check if already in category folder
            if (str_contains($oldImagePath, "products/{$category}/")) {
                $this->info("  ✓ Already in correct folder");
                $skipped++;
                $this->newLine();
                continue;
            }
            
            // Check if file exists
            if (!Storage::disk('public')->exists($oldImagePath)) {
                $this->error("  ✗ File not found: {$oldImagePath}");
                $errors++;
                $this->newLine();
                continue;
            }
            
            // Get filename
            $filename = basename($oldImagePath);
            
            // Create new path
            $newImagePath = "products/{$category}/{$filename}";
            
            // Move the file
            try {
                // Ensure directory exists
                $directory = dirname($newImagePath);
                Storage::disk('public')->makeDirectory($directory);
                
                // Move file
                if (Storage::disk('public')->move($oldImagePath, $newImagePath)) {
                    // Update database
                    $product->product_image = $newImagePath;
                    $product->save();
                    
                    $this->info("  ✓ Moved to: {$newImagePath}");
                    $moved++;
                } else {
                    $this->error("  ✗ Failed to move file");
                    $errors++;
                }
            } catch (\Exception $e) {
                $this->error("  ✗ Error: " . $e->getMessage());
                $errors++;
            }
            
            $this->newLine();
        }

        // Summary
        $this->info('========================================');
        $this->info('Image Reorganization Complete!');
        $this->info("  Files moved: {$moved}");
        $this->info("  Already organized: {$skipped}");
        if ($errors > 0) {
            $this->warn("  Errors: {$errors}");
        }
        $this->info('========================================');

        return Command::SUCCESS;
    }
}

