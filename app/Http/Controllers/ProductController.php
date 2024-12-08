<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the search term from the query string
        $search = $request->input('search');

        // If there's a search term, filter products by title
        if ($search) {
            $product = Product::where('title', 'like', '%' . $search . '%')->get();
        } else {
            // If no search term, retrieve all products
            $product = Product::all();
        }

        return view('products.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Gunakan store untuk menyimpan gambar
            $imagePath = $request->file('image')->store('products', 'public');

            Product::create([
                'title' => $request->input('title'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'product_code' => $request->input('product_code'),
                'description' => $request->input('description'),
                'image' => $imagePath, // Simpan path relatif
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('products')->with('success', 'Product added successfully');
        }

        return back()->with('error', 'Image upload failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'product_code' => 'required',
            'description' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image update
        ]);

        // Jika ada file gambar baru diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Upload gambar baru
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update produk
        $product->update($validatedData);

        return redirect()->route('products')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products')->with('success', 'product deleted successfully');
    }
}
