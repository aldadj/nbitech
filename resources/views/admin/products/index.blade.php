@extends('layouts.admin')

@section('title', 'Gestion des Produits')
@section('heading', 'Gestion des Produits')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">Inventaire NBI TECH</h2>
            <p class="text-xs md:text-sm text-gray-500 font-medium">Gestion du stock et des prix</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-indigo-100 transition-all flex items-center justify-center text-sm">
            <span class="mr-2">➕</span> Ajouter un Produit
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr class="whitespace-nowrap">
                        <th class="px-3 md:px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Produit</th>
                        <th class="px-3 md:px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest hidden md:table-cell">Catégorie</th>
                        <th class="px-3 md:px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Stock</th>
                        <th class="px-3 md:px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-indigo-50/20 transition-colors group">
                            
                            <td class="px-3 md:px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 md:w-12 md:h-12 flex-shrink-0 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center overflow-hidden">
                                        @if ($product->hasImage())
                                            <img src="{{ $product->imageUrl() }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-lg">💻</span>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-xs md:text-sm font-black text-gray-900 truncate max-w-[100px] md:max-w-none">
                                            {{ $product->name }}
                                        </div>
                                        <div class="text-[9px] md:text-xs text-gray-400 font-bold uppercase tracking-tighter sm:tracking-normal">
                                            {{ $product->brand }} <span class="md:hidden text-indigo-400">| {{ number_format($product->price, 0, ',', ' ') }} F</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-3 md:px-6 py-4 hidden md:table-cell">
                                <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase {{ $product->category === 'Ordinateur' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                                    {{ $product->category }}
                                </span>
                            </td>
                            
                            <td class="px-3 md:px-6 py-4 text-center">
                                @if ($product->stock_quantity > 0)
                                    <span class="text-xs md:text-sm font-black text-gray-700">{{ $product->stock_quantity }}</span>
                                @else
                                    <span class="text-[9px] bg-red-50 text-red-500 px-1.5 py-0.5 rounded font-black uppercase">OFF</span>
                                @endif
                            </td>
                            
                            <td class="px-3 md:px-6 py-4 text-right">
                                <div class="flex justify-end items-center gap-1 md:gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="p-2 rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition" title="Modifier">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce produit ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="text-4xl mb-3">🔎</div>
                                <p class="text-gray-400 font-medium text-sm">Aucun produit trouvé dans votre inventaire.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($products->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $products->links() }}
        </div>
    @endif
@endsection