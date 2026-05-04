@extends('layouts.public')

@section('title', 'Contact - NBI TECH')

@section('content')
    <!-- Hero Banner -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">📞 Nous Contacter</h1>
            <p class="text-xl text-gray-100">Une question? Un besoin spécifique? Nous sommes là pour vous aider!</p>
        </div>
    </section>

    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Information -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Informations de Contact</h2>
                </div>

                <!-- Phone -->
                <div class="flex gap-6 bg-white rounded-lg shadow-lg p-6">
                    <div class="text-4xl">📞</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Téléphone</h3>
                        <p class="text-gray-600 mb-3">Appelez-nous directement</p>
                        <a href="tel:+22676172056" class="text-2xl font-bold text-indigo-600 hover:text-indigo-800">
                            +226 76 17 20 56
                        </a>
                    </div>
                </div>

                <!-- Location -->
                <div class="flex gap-6 bg-white rounded-lg shadow-lg p-6">
                    <div class="text-4xl">📍</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Localisation</h3>
                        <p class="text-gray-600 space-y-1">
                            <div class="font-semibold">Hamdallaye, Ouagadougou</div>
                            <div>Près de la Mosquée de Hamdallaye</div>
                            <div class="text-sm text-gray-500 pt-2">Burkina Faso 🇧🇫</div>
                        </p>
                    </div>
                </div>

                <!-- Hours -->
                <div class="flex gap-6 bg-white rounded-lg shadow-lg p-6">
                    <div class="text-4xl">🕐</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Horaires d'Ouverture</h3>
                        <div class="space-y-2 text-gray-600">
                            <div class="flex justify-between">
                                <span>Lundi - Vendredi:</span>
                                <span class="font-semibold">8:00 - 18:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Samedi:</span>
                                <span class="font-semibold">9:00 - 17:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Dimanche:</span>
                                <span class="font-semibold">Fermé</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About Us -->
                <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">À Propos de Nous</h3>
                    <p class="text-gray-700 leading-relaxed">
                        NBI TECH est votre partenaire de confiance depuis plusieurs années pour l'acquisition d'appareils électroniques de qualité. 
                        Nous nous engageons à fournir les meilleurs produits au meilleur prix, avec un service après-vente irréprochable.
                    </p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Envoyez-nous un Message</h2>
                
                @if(session('success'))
                    <div class="mb-4 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom Complet *</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Votre nom"
                            value="{{ old('name') }}"
                            required
                        >
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="votre@email.com"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                        <input 
                            type="tel" 
                            name="phone" 
                            id="phone"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="+226 XX XX XX XX"
                            value="{{ old('phone') }}"
                        >
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Sujet *</label>
                        <select 
                            name="subject" 
                            id="subject"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            required
                        >
                            <option value="">Sélectionner un sujet</option>
                            <option value="Informations Produit" {{ old('subject') === 'Informations Produit' ? 'selected' : '' }}>Informations Produit</option>
                            <option value="Commande" {{ old('subject') === 'Commande' ? 'selected' : '' }}>Commande</option>
                            <option value="Garantie" {{ old('subject') === 'Garantie' ? 'selected' : '' }}>Garantie</option>
                            <option value="Autre" {{ old('subject') === 'Autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                        <textarea 
                            name="message" 
                            id="message"
                            rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Votre message..."
                            required
                        >{{ old('message') }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition transform hover:scale-105"
                    >
                        ✉️ Envoyer le Message
                    </button>

                    <p class="text-sm text-gray-600 text-center">
                        💡 Ou appelez-nous directement au <a href="tel:+22676172056" class="font-bold text-indigo-600 hover:underline">+226 76 17 20 56</a>
                    </p>
                </form>
            </div>
        </div>

        <!-- Quick Actions -->
        <section class="mt-16 pt-12 border-t border-gray-200">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Besoin d'Aide Rapide?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Browse Catalog -->
                <a href="{{ route('catalog') }}" class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition transform hover:scale-105">
                    <div class="text-5xl mb-4">📦</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Parcourir le Catalogue</h3>
                    <p class="text-gray-600">Découvrez nos {{ $totalProducts ?? 8 }}+ produits disponibles</p>
                </a>

                <!-- Call Us -->
                <a href="tel:+22676172056" class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition transform hover:scale-105">
                    <div class="text-5xl mb-4">📞</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Nous Appeler</h3>
                    <p class="text-gray-600">+226 76 17 20 56</p>
                    <p class="text-sm text-gray-500 mt-2">Disponible 24h/24, 7j/7</p>
                </a>

                <!-- Visit Us -->
                <div class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition transform hover:scale-105">
                    <div class="text-5xl mb-4">📍</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Visitez Notre Boutique</h3>
                    <p class="text-gray-600">Hamdallaye, Ouagadougou</p>
                    <p class="text-sm text-gray-500 mt-2">Près de la Mosquée de Hamdallaye</p>
                </div>
            </div>
        </section>
    </div>
@endsection



