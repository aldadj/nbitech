<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::paginate(15);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:Ordinateur,Téléphone'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $product = new Product($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit créé avec succès!');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        // 1. Nombre total de produits
        $totalProducts = Product::count();
    
        // 2. Nombre de produits en stock (quantité > 0)
        $inStockProducts = Product::where('stock_quantity', '>', 0)->count();
    
        // 3. Nombre de produits en rupture (quantité = 0)
        $outOfStockProducts = Product::where('stock_quantity', '<=', 0)->count();
    
        // 4. Nombre d'ordinateurs (catégorie 'Ordinateur')
        $laptops = Product::where('category', 'Ordinateur')->count();
    
        // 5. Nombre de téléphones (on filtre sur la catégorie 'Téléphone' ou similaire)
        $phones = Product::where('category', 'Téléphone')->count();
    
        // On injecte TOUT d'un coup dans la vue
        return view('admin.products.show', compact(
            'product', 
            'totalProducts', 
            'inStockProducts', 
            'outOfStockProducts', 
            'laptops',
            'phones'
        ));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in database.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:Ordinateur,Téléphone'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Produit modifié avec succès!');
    }

    /**
     * Remove the specified product from database.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès!');
    }
}
