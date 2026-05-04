@extends('layouts.public')

@section('title', 'Accueil')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-5xl font-bold mb-4">Bienvenue chez NBI Tech & Engineering</h1>
                    <p class="text-xl mb-6 text-gray-100">
                        Découvrez notre collection d'ordinateurs portables et de téléphones portables de qualité, disponibles à Ouagadougou.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('catalog') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-3 px-8 rounded-lg transition">
                            🛍️ Voir le Catalogue
                        </a>
                        <a href="{{ route('contact') }}" class="border-2 border-white hover:bg-white hover:text-purple-600 text-white font-bold py-3 px-8 rounded-lg transition">
                            📞 Nous Contacter
                        </a>
                    </div>
                </div>
                <div class="text-6xl text-center">
                    💻 📱
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-900">Pourquoi Choisir NBI TECH?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-lg border border-blue-200">
                    <div class="text-5xl mb-4">✅</div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">Produits Authentiques</h3>
                    <p class="text-gray-600">
                        Tous nos produits sont authentiques et proviennent de sources fiables. Garantie et support après-vente inclus.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-8 rounded-lg border border-green-200">
                    <div class="text-5xl mb-4">💰</div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">Prix Compétitifs</h3>
                    <p class="text-gray-600">
                        Bénéficiez des meilleurs prix du marché sans compromettre la qualité. Promotions régulières disponibles.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-lg border border-purple-200">
                    <div class="text-5xl mb-4">🚀</div>
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">Service Rapide</h3>
                    <p class="text-gray-600">
                        Livraison rapide et service clientèle réactif. Disponible du lundi au samedi pour votre commodité.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-16 w-full">
        <div class="w-full px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-900">Nos Produits en Vedette</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8 w-full">
                @forelse($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition hover:scale-105">
                        <!-- Product Image -->
                        <div class="bg-gray-100 h-40 flex items-center justify-center overflow-hidden p-2">
                            @if($product->hasImage())
                                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                            @else
                                <span class="text-xs font-semibold text-gray-600">Image indisponible</span>
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <div class="mb-2">
                                <h3 class="text-sm font-bold text-gray-900 truncate">{{ $product->name }}</h3>
                                <p class="text-gray-500 text-xs">{{ $product->brand }}</p>
                            </div>
                            
                            <span class="inline-block px-2 py-1 rounded text-xs font-semibold mb-3 {{ $product->category === 'Ordinateur' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                {{ $product->category }}
                            </span>
                            
                            <div class="mb-3">
                                <span class="text-lg font-bold text-indigo-600">
                                    {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                </span>
                                <div class="text-xs mt-1">
                                    @if($product->isInStock())
                                        <span class="text-green-600 font-semibold">✅ En Stock</span>
                                    @else
                                        <span class="text-red-600 font-semibold">❌ Rupture</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('products.show', $product) }}" class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 rounded transition">
                                    Voir
                                </a>
                                <button 
                                    type="button" 
                                    onclick="addToCart(this, {{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->category }}')"
                                    {{ !$product->isInStock() ? 'disabled' : '' }}
                                    class="w-full bg-green-600 hover:bg-green-700 disabled:bg-gray-400 text-white text-xs font-bold py-2 rounded transition">
                                    🛒 Panier
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-600 text-lg">Aucun produit disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center">
                <a href="{{ route('catalog') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg transition">
                    Voir le Catalogue Complet →
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-5xl font-bold text-yellow-400 mb-2">{{ $totalProducts }}+</div>
                    <p class="text-xl text-gray-300">Produits Disponibles</p>
                </div>
                <div>
                    <div class="text-5xl font-bold text-yellow-400 mb-2">24/7</div>
                    <p class="text-xl text-gray-300">Service Client</p>
                </div>
                <div>
                    <div class="text-5xl font-bold text-yellow-400 mb-2">✓</div>
                    <p class="text-xl text-gray-300">Garantie Produit</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4 text-gray-900">Prêt à Trouver Votre Appareil Idéal?</h2>
            <p class="text-xl text-gray-600 mb-8">Parcourez notre catalogue ou contactez-nous directement pour plus d'informations.</p>
            <div class="flex gap-4 justify-center">
                <a href="{{ route('catalog') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg transition">
                    Parcourir le Catalogue
                </a>
                <a href="tel:+22676172056" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg transition">
                    📞 Appeler Maintenant
                </a>
            </div>
        </div>
    </section>
@endsection
