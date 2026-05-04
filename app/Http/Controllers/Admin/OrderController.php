<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->latest()->paginate(10); // Récupère toutes les commandes avec leurs articles et produits
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product'); // Charge les articles de la commande et leurs produits associés
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Order $order)
    {
        // On change le statut de 'pending' à 'delivered'
        $order->update([
            'status' => 'delivered'
        ]);

        return back()->with('success', 'La commande a été marquée comme livrée.');
    }
}