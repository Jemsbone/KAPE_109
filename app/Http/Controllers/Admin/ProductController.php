<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('Admin.admin_product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not needed as we have the form on the index page
        return redirect()->route('admin.products');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:coffee,main-dish,drinks,desserts',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload - store in category-specific folder
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Create folder name based on category
            $categoryFolder = 'products/' . $request->category;
            $imagePath = $request->file('image')->store($categoryFolder, 'public');
        }

        Product::create([
            'admin_id' => auth()->guard('admin')->id(),
            'product_name' => $request->name,
            'product_price' => $request->price,
            'product_category' => $request->category,
            'product_stock' => $request->stock,
            'product_image' => $imagePath,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not needed for this implementation
        return redirect()->route('admin.products');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('Admin.admin_product_edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:coffee,main-dish,drinks,desserts',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'product_name' => $request->name,
            'product_price' => $request->price,
            'product_category' => $request->category,
            'product_stock' => $request->stock,
        ];

        // Handle image upload if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
                Storage::disk('public')->delete($product->product_image);
            }

            // Store in category-specific folder
            $categoryFolder = 'products/' . $request->category;
            $data['product_image'] = $request->file('image')->store($categoryFolder, 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete image from storage
        if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
            Storage::disk('public')->delete($product->product_image);
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
}
