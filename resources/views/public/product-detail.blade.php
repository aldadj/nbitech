@extends('layouts.public')

@section('title', $product->name . ' - NBI TECH')

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <div class="flex gap-2 text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-indigo-600">Accueil</a>
                <span>/</span>
                <a href="{{ route('catalog') }}" class="hover:text-indigo-600">Catalogue</a>
                <span>/</span>
                <span class="text-gray-900 font-semibold">{{ $product->name }}</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <!-- Product Image -->
            <div class="bg-white rounded-lg shadow-lg p-4 md:p-6">
                <div class="w-full h-80 md:h-96 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                    @if($product->hasImage())
                        <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                    @else
                        <span class="text-base font-semibold text-gray-600">Image indisponible</span>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <!-- Breadcrumb Alternative -->
                <div>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $product->category === 'Ordinateur' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                        {{ $product->category }}
                    </span>
                </div>

                <!-- Name -->
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                    <p class="text-2xl text-gray-600">Marque: <strong>{{ $product->brand }}</strong></p>
                </div>

                <!-- Price -->
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-lg border-2 border-indigo-200">
                    <p class="text-gray-600 text-sm mb-2">Prix</p>
                    <p class="text-5xl font-bold text-indigo-600">
                        {{ number_format($product->price, 0, ',', ' ') }} FCFA
                    </p>
                </div>

                <!-- Stock Status -->
                <div class="bg-white rounded-lg border-2 p-6">
                    <p class="text-gray-600 text-sm mb-2">Disponibilité</p>
                    @if($product->isInStock())
                        <div class="flex items-center gap-3">
                            <span class="text-4xl">✅</span>
                            <div>
                                <p class="text-2xl font-bold text-green-600">En Stock</p>
                                <p class="text-gray-600">{{ $product->stock_quantity }} unité(s) disponible(s)</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <span class="text-4xl">❌</span>
                            <div>
                                <p class="text-2xl font-bold text-red-600">Actuellement Indisponible</p>
                                <p class="text-gray-600">Veuillez nous contacter pour plus d'informations</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Description -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">📋 Caractéristiques & Description</h3>
                    <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-6">
                    @if($product->isInStock())
                        <button 
                            type="button" 
                            onclick="addToCart(this, {{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->category }}')"
                            class="w-full block text-center bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg transition text-lg">
                            Ajouter au panier
                        </button>
                    @endif
                    
                    <a href="{{ route('contact') }}" class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-6 rounded-lg transition text-lg">
                        ✉️ Nous Contacter
                    </a>
                </div>

                <!-- Contact Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h4 class="font-bold text-blue-900 mb-3">📍 Nous Joindre</h4>
                    <ul class="space-y-2 text-blue-900">
                        <li>📞 <a href="tel:+22676172056" class="font-bold hover:underline">+226 76 17 20 56</a></li>
                        <li>📍 Hamdallaye, Ouagadougou</li>
                        <li>Près de la Mosquée de Hamdallaye</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <section class="py-12 border-t-2 border-gray-200">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Produits Similaires</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:scale-105">
                            <!-- Product Image -->
                            <div class="bg-gray-100 h-44 flex items-center justify-center text-5xl overflow-hidden p-2">
                                @if($related->hasImage())
                                    <img src="{{ $related->imageUrl() }}" alt="{{ $related->name }}" class="w-full h-full object-contain">
                                @else
                                    <span class="text-xs font-semibold text-gray-600">Image indisponible</span>
                                @endif
                            </div>

                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 truncate">{{ $related->name }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $related->brand }}</p>
                                
                                <div class="mb-3">
                                    <p class="text-xl font-bold text-indigo-600">
                                        {{ number_format($related->price, 0, ',', ' ') }} FCFA
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-2">
                                    <a href="{{ route('products.show', $related) }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-2 rounded transition text-sm">Details</a>
                                    <button 
                                        type="button" 
                                        onclick="addToCart(this, {{ $related->id }}, '{{ addslashes($related->name) }}', {{ $related->price }}, '{{ $related->category }}')"
                                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-2 rounded transition text-sm">
                                        Panier
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Back Link -->
        <div class="text-center pt-8">
            <a href="{{ route('catalog') }}" class="inline-block text-indigo-600 hover:text-indigo-800 font-bold text-lg">
                ← Retour au Catalogue
            </a>
        </div>
    </div>
@endsection
