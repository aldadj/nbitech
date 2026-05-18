@extends('layouts.public')

@section('title', 'Catalogue - NBI TECH')

@section('content')
    <!-- Hero Banner -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">📦 Catalogue Complet</h1>
            <p class="text-xl text-gray-100">Trouvez votre ordinateur portable ou téléphone portable idéal</p>
        </div>
    </section>

    <div class="container mx-auto px-4 py-12" x-data="catalogSearch()" x-init="init()">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar - Filters -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-20">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Filtres</h3>

                    <div class="space-y-6">
                        <!-- Category Filter -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Catégorie</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} class="mr-3">
                                    <span class="text-gray-700">Tous les Produits</span>
                                </label>
                                @foreach($categories as $category)
                                    <label class="flex items-center">
                                        <input type="radio" name="category" value="{{ $category }}" {{ request('category') === $category ? 'checked' : '' }} class="mr-3">
                                        <span class="text-gray-700">{{ $category }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Sort -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Trier par</h4>
                            <select x-model="sort" x-on:change="applyFilters()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                <option value="latest">Plus Récents</option>
                                <option value="price_low">Prix: Bas &rarr; Haut</option>
                                <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Prix: Haut → Bas</option>
                                <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Nom (A-Z)</option>
                            </select>
                        </div>

                        <!-- Search -->
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-3">Rechercher</h4>
                            <input
                                type="text" 
                                x-model.debounce.500ms="search"
                                placeholder="Marque, modèle..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                            >
                        </div>

                        <!-- Submit Buttons -->
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition">
                            🔍 Filtrer
                        </button>
                        <button type="button" @click="resetFilters()" class="block w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold py-2 px-4 rounded-lg transition">
                            ✕ Réinitialiser
                        </button>
                    </div>
                </div>
            </aside>

            <!-- Main Content - Products Grid -->
            <main class="lg:col-span-3">
                <div x-show="loading" class="text-center text-gray-500 mb-4">Chargement...</div>
                <div x-ref="productResults">
                    @include('public.partials.product_grid', ['products' => $products])
                </div>
            </main>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function catalogSearch() {
        return {
            search: '{{ $search ?? '' }}', // Initial search value from controller
            category: '{{ $category ?? '' }}', // Initial category value from controller
            sort: '{{ $sort ?? 'latest' }}', // Initial sort value from controller
            loading: false,

            init() {
                // Listen for changes on category radio buttons
                this.$refs.categoryFilters.querySelectorAll('input[name="category"]').forEach(radio => {
                    radio.addEventListener('change', () => {
                        this.category = radio.value;
                        this.applyFilters();
                    });
                });

                // Intercept pagination links
                this.$watch('$refs.productResults', () => {
                    this.$nextTick(() => {
                        this.$refs.productResults.querySelectorAll('.pagination a').forEach(link => {
                            link.onclick = (e) => { // Use onclick to overwrite previous listeners
                                e.preventDefault();
                                const url = new URL(e.target.href);
                                this.fetchProducts(url.searchParams);
                            };
                        });
                    });
                });
            },

            applyFilters() {
                const params = new URLSearchParams();
                if (this.search) params.append('search', this.search);
                if (this.category) params.append('category', this.category);
                if (this.sort) params.append('sort', this.sort);
                this.fetchProducts(params);
            },

            resetFilters() {
                this.search = '';
                this.category = '';
                this.sort = 'latest';
                // Reset category radio buttons visually
                this.$refs.categoryFilters.querySelector('input[name="category"][value=""]').checked = true;
                this.applyFilters();
            },

            async fetchProducts(params) {
                this.loading = true;
                const response = await fetch(`{{ route('catalog') }}?${params.toString()}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                // Update URL without full page reload for better UX (back/forward buttons)
                history.pushState(null, '', `{{ route('catalog') }}?${params.toString()}`);

                this.$refs.productResults.innerHTML = await response.text();
                this.loading = false;
            }
        }
    }
</script>
@endpush
