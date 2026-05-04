@extends('layouts.admin')

@section('title', 'Toutes les Commandes')
@section('heading', 'Toutes les Commandes')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="p-4 md:p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-sm md:text-lg font-bold text-gray-800">Liste des Commandes</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50">
                    <tr class="whitespace-nowrap uppercase text-[9px] md:text-[10px] font-black tracking-widest text-gray-400">
                        <th class="px-4 py-3 md:px-6">ID Commande</th>
                        <th class="px-4 py-3 md:px-6">Client</th>
                        <th class="px-4 py-3 md:px-6">Montant</th>
                        <th class="px-4 py-3 md:px-6">Statut</th>
                        <th class="px-4 py-3 md:px-6">Date</th>
                        <th class="px-4 py-3 md:px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-xs md:text-sm">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-3 md:px-6">#{{ $order->id }}</td>
                            <td class="px-4 py-3 md:px-6">
                                <div class="font-bold text-gray-900">{{ $order->customer_name }}</div>
                                <div class="text-[10px] text-gray-400">{{ $order->customer_phone }}</div>
                            </td>
                            <td class="px-4 py-3 md:px-6 font-bold text-gray-700">
                                {{ number_format($order->total_amount, 0, ',', ' ') }} <span class="text-[9px]">CFA</span>
                            </td>
                            <td class="px-4 py-3 md:px-6">
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $order->status === 'pending' ? 'En attente' : 'Livrée' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 md:px-6 text-gray-400 text-[10px] whitespace-nowrap">
                                {{ $order->created_at->diffForHumans() }}
                            </td>
                            <td class="px-4 py-3 md:px-6 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 font-bold text-[9px] uppercase hover:underline mr-2">Voir détails</a>
                                @if($order->status === 'pending')
                                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-[9px] font-black uppercase transition shadow-sm">
                                            Livrer
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400 text-xs italic">Aucune commande pour le moment</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($orders->hasPages())
            <div class="p-4 md:p-6 border-t border-gray-100">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
