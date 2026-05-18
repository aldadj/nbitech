<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - NBI Tech & Engineering SARL</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .navbar-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav x-data="{ mobileMenuOpen: false }" class="navbar-bg shadow-lg text-white sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="flex items-center rounded-lg bg-white/95 p-1.5 shadow-md ring-1 ring-white/70">
                    <img src="{{ asset('images/nbi.jpg') }}" alt="NBI Tech Logo" class="h-14 md:h-16 w-auto object-contain">
                </a>
            
                <div class="flex items-center gap-4">
                    <!-- Desktop Navigation (Caché sur mobile) -->
                    <div class="hidden md:flex gap-6 items-center">
                        <a href="{{ route('home') }}" class="hover:text-gray-200 transition">Accueil</a>
                        <a href="{{ route('catalog') }}" class="hover:text-gray-200 transition">Catalogue</a>
                        <a href="{{ route('contact') }}" class="hover:text-gray-200 transition">Contact</a>
                        
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded transition text-sm">Admin</a>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="hover:text-gray-200 transition text-sm">Déconnexion</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded transition text-sm">Admin Login</a>
                        @endauth
                    </div>

                    <!-- Cart Icon (Toujours visible) -->
                    <a href="#cart" onclick="showCart(event)" class="hover:text-gray-200 transition relative text-2xl pr-2">
                        🛒
                        <span id="cartCount" class="absolute -top-2 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center hidden">0</span>
                    </a>

                    <!-- Mobile Menu Button (Uniquement sur mobile) -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 focus:outline-none">
                        <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Links (S'affiche quand mobileMenuOpen est vrai) -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="md:hidden mt-4 pt-4 border-t border-white/20 flex flex-col gap-4 text-lg">
                <a href="{{ route('home') }}" class="hover:text-gray-200 transition py-2" @click="mobileMenuOpen = false">Accueil</a>
                <a href="{{ route('catalog') }}" class="hover:text-gray-200 transition py-2" @click="mobileMenuOpen = false">Catalogue</a>
                <a href="{{ route('contact') }}" class="hover:text-gray-200 transition py-2" @click="mobileMenuOpen = false">Contact</a>
                <hr class="border-white/20">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-yellow-400 font-bold py-2">Dashboard Admin</a>
                @else
                    <a href="{{ route('login') }}" class="text-yellow-400 font-bold py-2">Connexion Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16 pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4">NBI Tech & Engineering SARL</h3>
                    <p class="text-gray-400">
                        Votre partenaire de confiance pour l'acquisition de matériel informatique de qualité à Ouagadougou. Spécialisé dans la vente d'ordinateurs portables et de téléphones portables.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Liens Rapides</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a></li>
                        <li><a href="{{ route('catalog') }}" class="hover:text-white transition">Catalogue</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Nous Contacter</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📍 Hamdallaye, Ouagadougou</li>
                        <li>Près de la Mosquée de Hamdallaye</li>
                        <li class="pt-2">
                            📞 <a href="tel:+22676172056" class="hover:text-white transition">+226 76 17 20 56</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-6 text-center text-gray-400">
                <p>&copy; 2026 ALDADJ Tech, programmeur fullstack. Tous droits réservés.</p>
                <p class="text-sm mt-2">Spécialisé dans la conception et la maintenance informatique</p>
            </div>
        </div>
    </footer>

    <!-- Cart Modal -->
    <div id="cartModal" x-data="{ openCartModal: false }" x-show="openCartModal"
         @open-cart-modal.window="openCartModal = true"
         @close-cart-modal.window="openCartModal = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="openCartModal = false" class="fixed inset-0 bg-black bg-opacity-60 z-[60] flex items-center justify-center sm:p-4 overflow-y-auto">
        <div class="bg-white sm:rounded-2xl shadow-2xl max-w-lg w-full h-full sm:h-auto sm:max-h-[90vh] flex flex-col"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <div class="flex justify-between items-center p-5 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">🛒 Mon Panier</h2>
            </div>
            
            <div id="cartItems" class="flex-1 overflow-y-auto p-6">
            <div id="cartItems" class="flex-1 overflow-y-auto p-5">
                <!-- Cart items will be rendered here -->
            </div>
            
            <div id="cartFooter" class="border-t border-gray-200 p-6 space-y-4">
                <div class="flex justify-between text-lg font-bold mb-4">
                    <span>Total:</span>
                    <span id="cartTotal">0 FCFA</span>
                </div>

                <!-- Delivery Options -->
                <div id="deliverySection" class="hidden">
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <label class="relative flex flex-col items-center p-2 border-2 border-gray-100 rounded-xl cursor-pointer hover:bg-indigo-50 transition has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50">
                            <input type="radio" name="delivery" value="pickup" checked class="peer absolute opacity-0">
                            <span class="text-xl mb-1">🏪</span>
                            <span class="text-sm font-bold text-gray-900">Retrait Boutique</span>
                        </label>
                        <label class="relative flex flex-col items-center p-3 border-2 border-gray-100 rounded-xl cursor-pointer hover:bg-indigo-50 transition has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50">
                            <input type="radio" name="delivery" value="delivery" class="absolute opacity-0">
                        <label class="relative flex flex-col items-center p-2 border-2 border-gray-100 rounded-xl cursor-pointer hover:bg-indigo-50 transition has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50">
                            <span class="text-xs font-bold text-gray-900">Livraison Domicile</span>
                        </label>
                    </div>
                    
                    <!-- Delivery Address -->
                    <div id="deliveryAddress" class="hidden mt-4">
                        <textarea id="addressInput" class="w-full p-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 outline-none" rows="2" placeholder="📍 Adresse exacte de livraison..."></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <input type="tel" id="phoneInput" class="w-full p-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="📞 Téléphone">
                        <input type="text" id="nameInput" class="w-full p-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="👤 Votre nom">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6">
                    <button onclick="validateOrder(this)" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition text-sm mb-2">
                        ✅ Valider la Commande
                    </button>
                    <div class="grid grid-cols-2 gap-2">
                        <button onclick="cancelOrder()" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-bold py-3 px-4 rounded-xl transition text-sm">
                            Annuler
                        </button>
                        <button onclick="clearCart()" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2 px-4 rounded-xl transition text-sm">
                        <button onclick="clearCart()" class="w-full bg-gray-100 text-gray-600 font-bold py-3 rounded-xl transition text-xs">
                            Vider
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Notification -->
    <div id="cartNotification" class="fixed top-24 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-2xl hidden z-[60] transition-all transform translate-y-0">
    <div id="cartNotification" class="fixed bottom-6 right-4 left-4 sm:left-auto sm:w-80 bg-green-600 text-white px-6 py-4 rounded-xl shadow-2xl hidden z-[70] transition-all">
        <div class="flex items-center gap-3">
            <span class="text-xl">✅</span>
            <span class="font-bold">Produit ajouté au panier !</span>

    <script>
        function addToCart(button, productId, productName, price, category) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let existingItem = cart.find(item => item.id === productId);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: price,
                    category: category,
                    quantity: 1
                });
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            
            // Change button text and disable it
            const originalText = button.innerHTML;
            button.innerHTML = 'Ajouté ! ✅';
            button.disabled = true;
            
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 1500); // Revert after 1.5 seconds
            showCartNotification();
        }

        function showCartNotification() {
            const notification = document.getElementById('cartNotification');
            notification.classList.remove('hidden');
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 2500);
        }

        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            
            const cartBadge = document.getElementById('cartCount');
            if (cartBadge) {
                cartBadge.textContent = totalItems;
                if (totalItems > 0) {
                    cartBadge.classList.remove('hidden');
                } else {
                    cartBadge.classList.add('hidden');
                }
            }
        }
        
        function showCart(e) {
            if (e) e.preventDefault();
            
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const modal = document.getElementById('cartModal');
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            const deliverySection = document.getElementById('deliverySection');
            
            if (cart.length === 0) {
                cartItems.innerHTML = '<p class="text-gray-600 text-center py-8">Votre panier est vide</p>';
                cartTotal.textContent = '0 FCFA';
                deliverySection.classList.add('hidden');
            } else {
                let html = '';
                let total = 0;
                
                cart.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    
                    html += `
                        <div class="flex gap-3 items-center mb-4 pb-4 border-b border-gray-50">
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-900 text-sm truncate">${item.name}</p>
                                <p class="text-xs text-gray-600">${item.category}</p>
                                <p class="text-indigo-600 font-bold mt-1">${new Intl.NumberFormat('fr-FR').format(item.price)} FCFA</p>
                                <p class="text-indigo-600 font-bold mt-1 text-sm">${new Intl.NumberFormat('fr-FR').format(item.price)} FCFA</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center bg-gray-100 rounded-lg p-1">
                                    <button onclick="updateQuantity(${item.id}, -1)" class="bg-white hover:bg-gray-200 text-gray-900 font-bold w-6 h-6 rounded shadow-sm text-xs transition">-</button>
                                    <span class="w-8 text-center font-bold text-sm text-gray-700">${item.quantity}</span>
                                    <button onclick="updateQuantity(${item.id}, 1)" class="bg-white hover:bg-gray-200 text-gray-900 font-bold w-6 h-6 rounded shadow-sm text-xs transition">+</button>
                                </div>
                                <button onclick="removeFromCart(${item.id})" class="text-gray-300 hover:text-red-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `;
                });
                
                cartItems.innerHTML = html;
                cartTotal.textContent = new Intl.NumberFormat('fr-FR').format(total) + ' FCFA';
                deliverySection.classList.remove('hidden');
                
                // Setup delivery options change listener
                const deliveryRadios = document.querySelectorAll('input[name="delivery"]');
                deliveryRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        const addressDiv = document.getElementById('deliveryAddress');
                        if (this.value === 'delivery') {
                            addressDiv.classList.remove('hidden');
                        } else {
                            addressDiv.classList.add('hidden');
                        }
                    });
                });
            }
            
            document.dispatchEvent(new CustomEvent('open-cart-modal'));
        }
        
        function validateOrder(button) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            
            if (cart.length === 0) {
                alert('Votre panier est vide!');
                return;
            }
            
            // Get delivery info
            const delivery = document.querySelector('input[name="delivery"]:checked').value;
            const phone = document.getElementById('phoneInput').value.trim();
            const name = document.getElementById('nameInput').value.trim();
            const address = delivery === 'delivery' ? document.getElementById('addressInput').value.trim() : 'Retrait en boutique';
            
            // Validation
            if (!phone) {
                alert('Veuillez entrer votre numéro de téléphone');
                return;
            }
            if (!name) {
                alert('Veuillez entrer votre nom');
                return;
            }
            if (delivery === 'delivery' && !address) {
                alert('Veuillez entrer votre adresse de livraison');
                return;
            }
            
            // Add loading state
            const originalContent = button.innerHTML;
            button.disabled = true;
            button.innerHTML = `
                <span class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Traitement...
                </span>
            `;

            // Prepare order summary
            let total = 0;
            let itemsList = '';
            
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                itemsList += `${item.quantity}x ${item.name} - ${new Intl.NumberFormat('fr-FR').format(itemTotal)} FCFA\n`;
            });
            
            const orderSummary = `
✅ COMMANDE CONFIRMÉE

🛒 Articles:
${itemsList}
💰 Total: ${new Intl.NumberFormat('fr-FR').format(total)} FCFA

📦 Livraison: ${delivery === 'delivery' ? 'Livraison à domicile' : 'Retrait en boutique'}
${delivery === 'delivery' ? `📍 Adresse: ${address}\n` : ''}
👤 Client: ${name}
📞 Téléphone: ${phone}

Merci pour votre commande!
            `;
            
            // Send via WhatsApp
            const whatsappMessage = encodeURIComponent(orderSummary);
            const whatsappLink = `https://wa.me/22676172056?text=${whatsappMessage}`;
            
            // Simulate a small delay for better UX
            setTimeout(() => {
                // Clear cart
                localStorage.removeItem('cart');
                updateCartCount();
                closeCart();
                
                // Restore button for next time modal opens
                button.disabled = false;
                button.innerHTML = originalContent;
                
                // Show confirmation and redirect
                alert('Commande confirmée! Vous allez être redirigé vers WhatsApp pour finaliser votre commande.');
                window.open(whatsappLink, '_blank');
            }, 800);
        }
        
        function cancelOrder() {
            if (confirm('Êtes-vous sûr de vouloir annuler votre commande?')) {
                localStorage.removeItem('cart');
                updateCartCount();
                closeCart();
                alert('Commande annulée. Votre panier a été vidé.');
            }
        }
        
        function closeCart() {
            document.getElementById('cartModal').classList.add('hidden');
        }
        
        function updateQuantity(productId, change) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let item = cart.find(item => item.id === productId);
            
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    cart = cart.filter(item => item.id !== productId);
                }
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            showCart();
        }
        
        function removeFromCart(productId) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart = cart.filter(item => item.id !== productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            showCart();
        }
        
        function clearCart() {
            if (confirm('Êtes-vous sûr de vouloir vider votre panier?')) {
                localStorage.removeItem('cart');
                updateCartCount();
                showCart();
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('cartModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeCart();
            }
        });
        
        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', () => { updateCartCount(); });
    </script>
    @stack('scripts') {{-- This is where pushed scripts will be rendered --}}
</body>
</html>
