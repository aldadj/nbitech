@extends('layouts.admin')

@section('title', 'Modifier le Produit')
@section('heading', 'Modifier: ' . $product->name)

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom du Produit *</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                            value="{{ old('name', $product->name) }}"
                            required
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Brand -->
                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">Marque *</label>
                        <input 
                            type="text" 
                            name="brand" 
                            id="brand" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('brand') border-red-500 @enderror"
                            value="{{ old('brand', $product->brand) }}"
                            required
                        >
                        @error('brand')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Catégorie *</label>
                        <select 
                            name="category" 
                            id="category" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror"
                            required
                        >
                            <option value="">Sélectionner une catégorie</option>
                            <option value="Ordinateur" {{ old('category', $product->category) === 'Ordinateur' ? 'selected' : '' }}>💻 Ordinateur</option>
                            <option value="Téléphone" {{ old('category', $product->category) === 'Téléphone' ? 'selected' : '' }}>📱 Téléphone</option>
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Prix (FCFA) *</label>
                        <input 
                            type="number" 
                            name="price" 
                            id="price" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('price') border-red-500 @enderror"
                            value="{{ old('price', $product->price) }}"
                            step="0.01"
                            min="0"
                            required
                        >
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description (Caractéristiques) *</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                        required
                    >{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantité en Stock *</label>
                    <input 
                        type="number" 
                        name="stock_quantity" 
                        id="stock_quantity" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stock_quantity') border-red-500 @enderror"
                        value="{{ old('stock_quantity', $product->stock_quantity) }}"
                        min="0"
                        required
                    >
                    @error('stock_quantity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image du Produit</label>
                    @if ($product->hasImage())
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Image actuelle:</p>
                            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="w-32 h-32 object-contain rounded-lg">
                        </div>
                    @endif
                    <input 
                        type="file" 
                        name="image" 
                        id="image" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror"
                        accept="image/*"
                    >
                    <p class="text-gray-500 text-sm mt-1">Max 2MB. Format: JPEG, PNG, JPG, GIF</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-6">
                    <button 
                        type="submit" 
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition"
                    >
                        💾 Sauvegarder les Modifications
                    </button>
                    <a 
                        href="{{ route('admin.products.index') }}" 
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition text-center"
                    >
                        ❌ Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection




