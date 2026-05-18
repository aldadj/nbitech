{{-- resources/views/public/partials/product_grid.blade.php --}}

<!-- Results Header -->
<div class="mb-6">
    <p class="text-gray-600">
        @if(request('search'))
            Résultats pour "<strong>{{ request('search') }}</strong>"
        @elseif(request('category'))
            Catégorie: <strong>{{ request('category') }}</strong>
        @else
            Tous les produits
        @endif
        ({{ $products->total() }} résultats)
    </p>
</div>

@if($products->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:scale-105">
                <!-- Product Image -->
                <div class="bg-gray-100 h-56 flex items-center justify-center text-6xl relative overflow-hidden p-2">
                    @if($product->hasImage())
                        <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                    @else
                        <span class="text-base font-semibold text-gray-600">Image indisponible</span>
                    @endif
                    @if(!$product->isInStock())
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                            <span class="text-white text-xl font-bold">Rupture</span>
                        </div>
                    @endif
                </div>

                <div class="p-5">
                    <!-- Name -->
                    <h3 class="text-lg font-bold text-gray-900 mb-2 truncate">{{ $product->name }}</h3>

                    <!-- Brand -->
                    <p class="text-gray-600 text-sm mb-2">{{ $product->brand }}</p>

                    <!-- Category Badge -->
                    <div class="mb-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $product->category === 'Ordinateur' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ $product->category }}
                        </span>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <span class="text-2xl font-bold text-indigo-600">
                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                        </span>
                    </div>

                    <!-- Stock Status -->
                    <div class="mb-4">
                        @if($product->isInStock())
                            <span class="text-sm font-semibold text-green-600">✅ {{ $product->stock_quantity }} en stock</span>
                        @else
                            <span class="text-sm font-semibold text-red-600">❌ Indisponible</span>
                        @endif
                    </div>

                    <!-- View Details Button -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <a href="{{ route('products.show', $product) }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-2 rounded transition">
                            Details
                        </a>
                        <button
                            type="button"
                            onclick="addToCart(this, {{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->category }}')"
                            {{ !$product->isInStock() ? 'disabled' : '' }}
                            class="w-full bg-green-600 hover:bg-green-700 disabled:bg-gray-400 text-white font-bold py-2 px-2 rounded transition">
                            Panier
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-12">
        {{ $products->links() }}
    </div>
@else
    <!-- Empty State -->
    <div class="bg-white rounded-lg shadow-lg p-12 text-center">
        <div class="text-6xl mb-4">🔍</div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucun Produit Trouvé</h3>
        <p class="text-gray-600 mb-6">
            @if(request('search') || request('category'))
                Essayez de modifier vos filtres ou votre recherche.
            @else
                Aucun produit n'est actuellement disponible.
            @endif
        </p>
        <a href="{{ route('catalog') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-8 rounded-lg transition">
            ← Retour au Catalogue Complet
        </a>
    </div>
@endif