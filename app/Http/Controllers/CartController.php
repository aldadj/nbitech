<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if (!$product) {
                continue;
            }

            $lineTotal = $product->price * $quantity;
            $items[] = [
                'product' => $product,
                'quantity' => $quantity,
                'line_total' => $lineTotal,
            ];
            $total += $lineTotal;
        }

        return view('public.cart', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $qtyToAdd = $validated['quantity'] ?? 1;
        $cart = session('cart', []);
        $currentQty = $cart[$product->id] ?? 0;
        $newQty = min($currentQty + $qtyToAdd, max($product->stock_quantity, 1));

        $cart[$product->id] = $newQty;
        session(['cart' => $cart]);

        return back()->with('success', 'Produit ajoute au panier.');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session('cart', []);
        if (!isset($cart[$product->id])) {
            return back();
        }

        $cart[$product->id] = min($validated['quantity'], max($product->stock_quantity, 1));
        session(['cart' => $cart]);

        return back()->with('success', 'Quantite mise a jour.');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Produit retire du panier.');
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Votre panier est vide.']);
        }

        DB::transaction(function () use ($cart, $validated) {
            $items = [];
            $total = 0;

            foreach ($cart as $productId => $qty) {
                $product = Product::lockForUpdate()->find($productId);
                if (!$product || $qty < 1) {
                    continue;
                }

                $qty = min($qty, max($product->stock_quantity, 0));
                if ($qty === 0) {
                    continue;
                }

                $lineTotal = $product->price * $qty;
                $items[] = compact('product', 'qty', 'lineTotal');
                $total += $lineTotal;
            }

            if (empty($items)) {
                throw new \RuntimeException('Panier invalide');
            }

            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'total_amount' => $total,
                'status' => 'pending',
            ]);

            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item['product']->id,
                    'quantity' => $item['qty'],
                    'unit_price' => $item['product']->price,
                    'line_total' => $item['lineTotal'],
                ]);

                $item['product']->decrement('stock_quantity', $item['qty']);
            }
        });

        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Commande confirmee avec succes. L\'admin va vous contacter rapidement.');
    }
}
