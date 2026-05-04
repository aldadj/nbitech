@extends('layouts.public')

@section('title', 'Panier - NBI TECH')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Mon Panier</h1>

    @if(session('success'))
        <div class="mb-6 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-green-800">{{ session('success') }}</div>
    @endif

    @if($errors->has('cart'))
        <div class="mb-6 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-red-800">{{ $errors->first('cart') }}</div>
    @endif

    @if(count($items) === 0)
        <div class="bg-white rounded-lg shadow p-10 text-center">
            <p class="text-xl text-gray-700 mb-4">Votre panier est vide.</p>
            <a href="{{ route('catalog') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition">Voir le catalogue</a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                @foreach($items as $item)
                    <div class="bg-white rounded-lg shadow p-4 flex gap-4 items-center">
                        <div class="w-24 h-24 bg-gray-100 rounded overflow-hidden flex items-center justify-center p-2">
                            @if($item['product']->hasImage())
                                <img src="{{ $item['product']->imageUrl() }}" alt="{{ $item['product']->name }}" class="w-full h-full object-contain">
                            @else
                                <span class="text-xs text-gray-500">Image indisponible</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900">{{ $item['product']->name }}</h3>
                            <p class="text-sm text-gray-600">{{ number_format($item['product']->price, 0, ',', ' ') }} FCFA / unite</p>
                            <p class="text-sm font-semibold text-indigo-700 mt-1">Sous-total: {{ number_format($item['line_total'], 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div>
                            <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-2 mb-2">
                                @csrf
                                <input type="number" min="1" name="quantity" value="{{ $item['quantity'] }}" class="w-16 border rounded px-2 py-1">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">OK</button>
                            </form>
                            <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Retirer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-white rounded-lg shadow p-6 h-fit">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Confirmation</h2>
                <p class="text-gray-700 mb-4">Total: <span class="font-bold text-2xl text-indigo-700">{{ number_format($total, 0, ',', ' ') }} FCFA</span></p>

                <form action="{{ route('cart.checkout') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="text" name="customer_name" placeholder="Nom complet" value="{{ old('customer_name') }}" class="w-full border rounded-lg px-3 py-2" required>
                    <input type="text" name="customer_phone" placeholder="Telephone" value="{{ old('customer_phone') }}" class="w-full border rounded-lg px-3 py-2" required>
                    <input type="email" name="customer_email" placeholder="Email (optionnel)" value="{{ old('customer_email') }}" class="w-full border rounded-lg px-3 py-2">
                    <textarea name="notes" rows="3" placeholder="Message/precision (optionnel)" class="w-full border rounded-lg px-3 py-2">{{ old('notes') }}</textarea>
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition">Confirmer l'achat</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
