@extends('layouts.admin')

@section('title', 'Détails de la Commande #' . $order->id)
@section('heading', 'Détails de la Commande #' . $order->id)

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Informations sur le Client</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <div>
                    <p><span class="font-semibold">Nom:</span> {{ $order->customer_name }}</p>
                    <p><span class="font-semibold">Téléphone:</span> {{ $order->customer_phone }}</p>
                    @if ($order->customer_email)
                        <p><span class="font-semibold">Email:</span> {{ $order->customer_email }}</p>
                    @endif
                </div>
                <div>
                    <p><span class="font-semibold">Date de commande:</span> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><span class="font-semibold">Statut:</span> 
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                            {{ $order->status === 'pending' ? 'En attente' : 'Livrée' }}
                        </span>
                    </p>
                    <p><span class="font-semibold">Montant Total:</span> {{ number_format($order->total_amount, 0, ',', ' ') }} CFA</p>
                </div>
            </div>
            @if ($order->notes)
                <div class="mt-4">
                    <p class="font-semibold">Notes:</p>
                    <p class="bg-gray-50 p-3 rounded-lg text-gray-600">{{ $order->notes }}</p>
                </div>
            @endif
            <div class="mt-6 text-right">
                @if($order->status === 'pending')
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm font-bold uppercase transition shadow-sm">
                            Marquer comme Livrée
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-4 md:p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Produits Commandés</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/50">
                        <tr class="whitespace-nowrap uppercase text-[9px] md:text-[10px] font-black tracking-widest text-gray-400">
                            <th class="px-4 py-3 md:px-6">Produit</th>
                            <th class="px-4 py-3 md:px-6">Quantité</th>
                            <th class="px-4 py-3 md:px-6">Prix Unitaire</th>
                            <th class="px-4 py-3 md:px-6 text-right">Total Ligne</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs md:text-sm">
                        @forelse ($order->items as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-3 md:px-6">
                                    <div class="font-bold text-gray-900">{{ $item->product->name ?? 'Produit Inconnu' }}</div>
                                    <div class="text-[10px] text-gray-400">{{ $item->product->brand ?? '' }}</div>
                                </td>
                                <td class="px-4 py-3 md:px-6">{{ $item->quantity }}</td>
                                <td class="px-4 py-3 md:px-6">{{ number_format($item->unit_price, 0, ',', ' ') }} CFA</td>
                                <td class="px-4 py-3 md:px-6 text-right font-bold text-gray-700">{{ number_format($item->line_total, 0, ',', ' ') }} CFA</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-400 text-xs italic">Aucun produit dans cette commande.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('admin.orders.index') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition">
                ← Retour à la liste des commandes
            </a>
        </div>
    </div>
@endsection