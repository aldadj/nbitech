@extends('layouts.admin')

@section('title', 'Tableau de Bord')
@section('heading', 'Tableau de Bord')

@section('content')
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-5 gap-3 md:gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 border border-gray-100">
            <div class="flex flex-col sm:flex-row items-center justify-between text-center sm:text-left">
                <div class="order-2 sm:order-1 mt-2 sm:mt-0">
                    <p class="text-gray-500 text-[10px] md:text-sm font-bold uppercase tracking-wider">Total</p>
                    <p class="text-xl md:text-3xl font-black text-gray-900">{{ $totalProducts }}</p>
                </div>
                <div class="text-2xl md:text-4xl order-1 sm:order-2">📦</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 border border-gray-100">
            <div class="flex flex-col sm:flex-row items-center justify-between text-center sm:text-left">
                <div class="order-2 sm:order-1 mt-2 sm:mt-0">
                    <p class="text-gray-500 text-[10px] md:text-sm font-bold uppercase tracking-wider">Stock</p>
                    <p class="text-xl md:text-3xl font-black text-green-600">{{ $inStockProducts }}</p>
                </div>
                <div class="text-2xl md:text-4xl order-1 sm:order-2">✅</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 border border-gray-100">
            <div class="flex flex-col sm:flex-row items-center justify-between text-center sm:text-left">
                <div class="order-2 sm:order-1 mt-2 sm:mt-0">
                    <p class="text-gray-500 text-[10px] md:text-sm font-bold uppercase tracking-wider">Rupture</p>
                    <p class="text-xl md:text-3xl font-black text-red-600">{{ $outOfStockProducts }}</p>
                </div>
                <div class="text-2xl md:text-4xl order-1 sm:order-2">❌</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 border border-gray-100">
            <div class="flex flex-col sm:flex-row items-center justify-between text-center sm:text-left">
                <div class="order-2 sm:order-1 mt-2 sm:mt-0">
                    <p class="text-gray-500 text-[10px] md:text-sm font-bold uppercase tracking-wider">PC</p>
                    <p class="text-xl md:text-3xl font-black text-blue-600">{{ $laptops }}</p>
                </div>
                <div class="text-2xl md:text-4xl order-1 sm:order-2">💻</div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6 border border-gray-100">
            <div class="flex flex-col sm:flex-row items-center justify-between text-center sm:text-left">
                <div class="order-2 sm:order-1 mt-2 sm:mt-0">
                    <p class="text-gray-500 text-[10px] md:text-sm font-bold uppercase tracking-wider">Tél</p>
                    <p class="text-xl md:text-3xl font-black text-purple-600">{{ $phones }}</p>
                </div>
                <div class="text-2xl md:text-4xl order-1 sm:order-2">📱</div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-4 md:p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Derniers ajouts</h3>
            <a href="{{ route('admin.products.index') }}" class="text-indigo-600 text-xs font-bold hover:underline uppercase tracking-tight">Voir tout →</a>
        </div>
        
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50">
                    <tr class="whitespace-nowrap uppercase text-[10px] font-bold tracking-widest text-gray-400">
                        <th class="px-4 py-3">Désignation</th>
                        <th class="px-4 py-3">Catégorie</th>
                        <th class="px-4 py-3">Prix</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($recentProducts as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-3">
                                <div class="font-bold text-gray-900 text-xs md:text-sm truncate max-w-[120px] md:max-w-none">
                                    {{ $product->name }}
                                </div>
                                <div class="text-[10px] text-gray-400 font-medium">{{ $product->brand }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase {{ $product->category === 'Ordinateur' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                                    {{ $product->category }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs md:text-sm font-bold text-gray-700 whitespace-nowrap">
                                {{ number_format($product->price, 0, ',', ' ') }} <span class="text-[9px]">CFA</span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex justify-end items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:bg-indigo-50 p-1.5 rounded-lg transition" title="Modifier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-400 text-xs italic">Aucun produit en stock</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection