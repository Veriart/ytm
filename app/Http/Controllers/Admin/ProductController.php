<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'dosage_guidelines' => 'nullable|string',
            'indication' => 'nullable|string',
            'pharmacist_note' => 'nullable|string',
            'brand' => 'nullable|string|max:255',
            'target_animals' => 'nullable|array',
            'dosage_form' => 'nullable|string|max:255',
            'active_ingredients' => 'nullable|string',
            'registration_number' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'batch_number' => 'nullable|string|max:255',
            'needs_prescription' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'product_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/product');
            
            // Ensure folder exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            
            $image->move($destinationPath, $filename);
            $imagePath = '/img/product/' . $filename;
        }

        $targetAnimals = $request->has('target_animals') ? implode(', ', $request->target_animals) : null;

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath ?? 'https://placehold.co/400',
            'rating' => 5.00,
            'sold_count' => 0,
            'dosage_guidelines' => $request->dosage_guidelines,
            'indication' => $request->indication,
            'pharmacist_note' => $request->pharmacist_note,
            'brand' => $request->brand,
            'target_animals' => $targetAnimals,
            'dosage_form' => $request->dosage_form,
            'active_ingredients' => $request->active_ingredients,
            'registration_number' => $request->registration_number,
            'expiry_date' => $request->expiry_date,
            'batch_number' => $request->batch_number,
            'needs_prescription' => $request->has('needs_prescription'),
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'dosage_guidelines' => 'nullable|string',
            'indication' => 'nullable|string',
            'pharmacist_note' => 'nullable|string',
            'brand' => 'nullable|string|max:255',
            'target_animals' => 'nullable|array',
            'dosage_form' => 'nullable|string|max:255',
            'active_ingredients' => 'nullable|string',
            'registration_number' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'batch_number' => 'nullable|string|max:255',
            'needs_prescription' => 'nullable|boolean',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // Delete old image if it is stored locally
            if ($product->image && Str::startsWith($product->image, '/img/product/')) {
                $oldPath = public_path($product->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $image = $request->file('image');
            $filename = 'product_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/product');
            
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $image->move($destinationPath, $filename);
            $imagePath = '/img/product/' . $filename;
        }

        $targetAnimals = $request->has('target_animals') ? implode(', ', $request->target_animals) : null;

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'dosage_guidelines' => $request->dosage_guidelines,
            'indication' => $request->indication,
            'pharmacist_note' => $request->pharmacist_note,
            'brand' => $request->brand,
            'target_animals' => $targetAnimals,
            'dosage_form' => $request->dosage_form,
            'active_ingredients' => $request->active_ingredients,
            'registration_number' => $request->registration_number,
            'expiry_date' => $request->expiry_date,
            'batch_number' => $request->batch_number,
            'needs_prescription' => $request->has('needs_prescription'),
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image locally if exists
        if ($product->image && Str::startsWith($product->image, '/img/product/')) {
            $oldPath = public_path($product->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus!');
    }
}
