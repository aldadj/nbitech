@extends('layouts.admin')

@section('title', 'Tableau de Bord')
@section('heading', 'Tableau de Bord')

@section('content')
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-2 md:gap-6 mb-8">
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-2 md:p-5 transition hover:shadow-md">
            <div class="flex flex-col lg:flex-row items-center justify-between text-center lg:text-left">
                <div>
                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-widest">Commandes</p>
                    <p class="text-base md:text-3xl font-black text-orange-600 mt-1">{{ $totalOrders ?? 0 }}</p>
                </div>
                <div class="hidden sm:block bg-orange-50 p-2 md:p-3 rounded-lg text-xl md:text-2xl mt-2 lg:mt-0">🛍️</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-2 md:p-5 transition hover:shadow-md">
            <div class="flex flex-col lg:flex-row items-center justify-between text-center lg:text-left">
                <div>
                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-widest">Produits</p>
                    <p class="text-base md:text-3xl font-black text-gray-900 mt-1">{{ $totalProducts }}</p>
                </div>
                <div class="hidden sm:block bg-gray-50 p-2 md:p-3 rounded-lg text-xl md:text-2xl mt-2 lg:mt-0">📦</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-2 md:p-5 transition hover:shadow-md">
            <div class="flex flex-col lg:flex-row items-center justify-between text-center lg:text-left">
                <div>
                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-widest">En Stock</p>
                    <p class="text-base md:text-3xl font-black text-green-600 mt-1">{{ $inStockProducts }}</p>
                </div>
                <div class="hidden sm:block bg-green-50 p-2 md:p-3 rounded-lg text-xl md:text-2xl mt-2 lg:mt-0">✅</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-2 md:p-5 transition hover:shadow-md">
            <div class="flex flex-col lg:flex-row items-center justify-between text-center lg:text-left">
                <div>
                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-widest">Rupture</p>
                    <p class="text-base md:text-3xl font-black text-red-600 mt-1">{{ $outOfStockProducts }}</p>
                </div>
                <div class="hidden sm:block bg-red-50 p-2 md:p-3 rounded-lg text-xl md:text-2xl mt-2 lg:mt-0">❌</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-2 md:p-5 transition hover:shadow-md">
            <div class="flex flex-col lg:flex-row items-center justify-between text-center lg:text-left">
                <div>
                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-widest">PC</p>
                    <p class="text-base md:text-3xl font-black text-indigo-600 mt-1">{{ $laptops }}</p>
                </div>
                <div class="hidden sm:block bg-indigo-50 p-2 md:p-3 rounded-lg text-xl md:text-2xl mt-2 lg:mt-0">💻</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-2 md:p-5 transition hover:shadow-md">
            <div class="flex flex-col lg:flex-row items-center justify-between text-center lg:text-left">
                <div>
                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-widest">Tél</p>
                    <p class="text-base md:text-3xl font-black text-purple-600 mt-1">{{ $phones }}</p>
                </div>
                <div class="hidden sm:block bg-purple-50 p-2 md:p-3 rounded-lg text-xl md:text-2xl mt-2 lg:mt-0">📱</div>
            </div>
        </div>
    </div>

    <!-- Dernières Commandes -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="p-4 md:p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-sm md:text-lg font-bold text-gray-800">Dernières commandes</h3> 
            {{-- Add a link to view all orders --}}
            <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 text-xs font-bold hover:underline uppercase">Voir toutes les commandes</a>
            <span class="text-gray-400 text-[10px] uppercase font-bold tracking-widest">Temps réel</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50">
                    <tr class="whitespace-nowrap uppercase text-[9px] md:text-[10px] font-black tracking-widest text-gray-400">
                        <th class="px-4 py-3 md:px-6">Client</th>
                        <th class="px-4 py-3 md:px-6">Total</th>
                        <th class="px-4 py-3 md:px-6 hidden sm:table-cell">Statut</th>
                        <th class="px-4 py-3 md:px-6 hidden md:table-cell">Date</th>
                        <th class="px-4 py-3 md:px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-xs md:text-sm">
                    @forelse ($recentOrders ?? [] as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-3 md:px-6">
                                <div class="font-bold text-gray-900">{{ $order->customer_name }}</div>
                                <div class="text-[10px] text-gray-400">{{ $order->customer_phone }}</div>
                                {{-- Badge de statut visible uniquement sur mobile sous le nom --}}
                                <div class="sm:hidden mt-1">
                                    <span class="px-1.5 py-0.5 rounded-full text-[8px] font-black uppercase {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                        {{ $order->status === 'pending' ? 'Attente' : 'Prêt' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-4 py-3 md:px-6 font-bold text-gray-700 whitespace-nowrap">
                                {{ number_format($order->total_amount, 0, ',', ' ') }} <span class="text-[9px]">CFA</span>
                            </td>
                            <td class="px-4 py-3 md:px-6 hidden sm:table-cell">
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $order->status === 'pending' ? 'En attente' : 'Livrée' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 md:px-6 text-gray-400 text-[10px] whitespace-nowrap hidden md:table-cell">
                                {{ $order->created_at->diffForHumans() }}
                            </td>
                            <td class="px-4 py-3 md:px-6 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 font-bold text-[9px] uppercase hover:underline mr-2">Voir</a>
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
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400 text-xs italic">Aucune commande pour le moment</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 md:p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-sm md:text-lg font-bold text-gray-800">Derniers ajouts</h3>
            <a href="{{ route('admin.products.index') }}" class="text-indigo-600 text-xs font-bold hover:underline uppercase">Voir tout</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50">
                    <tr class="whitespace-nowrap uppercase text-[9px] md:text-[10px] font-black tracking-widest text-gray-400">
                        <th class="px-4 py-3 md:px-6">Produit</th>
                        <th class="px-4 py-3 md:px-6">Prix</th>
                        <th class="px-4 py-3 md:px-6 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-xs md:text-sm">
                    @forelse ($recentProducts as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-3 md:px-6">
                                <div class="font-bold text-gray-900 truncate max-w-[100px] md:max-w-none">{{ $product->name }}</div>
                                <div class="text-[10px] text-gray-400 uppercase">{{ $product->category }}</div>
                            </td>
                            <td class="px-4 py-3 md:px-6 font-bold text-gray-700 whitespace-nowrap">
                                {{ number_format($product->price, 0, ',', ' ') }} <span class="text-[9px]">CFA</span>
                            </td>
                            <td class="px-4 py-3 md:px-6 text-right">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 font-bold text-[10px] uppercase">Éditer</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-gray-400 text-xs italic">Aucun produit récent</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection