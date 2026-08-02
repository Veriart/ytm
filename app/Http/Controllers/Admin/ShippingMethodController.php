<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    public function index()
    {
        $shippingMethods = ShippingMethod::latest()->get();
        return view('admin.shipping.index', compact('shippingMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        ShippingMethod::create([
            'name' => $request->name,
            'cost' => $request->cost,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? $request->is_active : true,
        ]);

        return redirect()->route('admin.shipping.index')->with('success', 'Metode pengiriman berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $shippingMethod->update([
            'name' => $request->name,
            'cost' => $request->cost,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? (bool)$request->is_active : $shippingMethod->is_active,
        ]);

        return redirect()->route('admin.shipping.index')->with('success', 'Metode pengiriman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);
        $shippingMethod->delete();

        return redirect()->route('admin.shipping.index')->with('success', 'Metode pengiriman berhasil dihapus!');
    }
}
