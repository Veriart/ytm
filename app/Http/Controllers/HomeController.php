<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        
        $query = Product::with('category');
        
        if ($request->has('category') && $request->category != 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('target') && $request->target != 'all') {
            $targetAnimal = $request->target;
            $query->where('target_animals', 'like', '%' . $targetAnimal . '%');
        }

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                  ->orWhere('active_ingredients', 'like', '%' . $searchTerm . '%');
            });
        }

        $products = $query->latest()->get();
        $selectedCategory = $request->query('category', 'all');
        $selectedTarget = $request->query('target', 'all');
        $searchQuery = $request->query('search', '');

        return view('home', compact('categories', 'products', 'selectedCategory', 'selectedTarget', 'searchQuery'));
    }
}
