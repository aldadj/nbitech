<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - NBI TECH Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen bg-gray-100">
        <div id="adminOverlay" class="fixed inset-0 z-30 bg-black/40 hidden lg:hidden"></div>

        <aside id="adminSidebar" class="fixed lg:static inset-y-0 left-0 z-40 w-72 max-w-[85vw] lg:w-64 bg-gray-900 text-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-out">
            <div class="p-6">
                <h1 class="text-2xl font-bold">NBI TECH</h1>
                <p class="text-gray-400 text-sm">Administration</p>
            </div>

            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 border-r-4 border-blue-400' : '' }} hover:bg-gray-800 transition">
                    Tableau de bord
                </a>
                <a href="{{ route('admin.products.index') }}" class="block px-6 py-3 {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 border-r-4 border-blue-400' : '' }} hover:bg-gray-800 transition">
                    Produits
                </a>
                <a href="{{ route('admin.orders.index') }}" class="block px-6 py-3 {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600 border-r-4 border-blue-400' : '' }} hover:bg-gray-800 transition">
                    Commandes
                </a>
                <a href="{{ route('admin.messages.index') }}" class="block px-6 py-3 {{ request()->routeIs('admin.messages.*') ? 'bg-blue-600 border-r-4 border-blue-400' : '' }} hover:bg-gray-800 transition">
                    Messages
                </a>
            </nav>

            <div class="absolute bottom-0 w-full border-t border-gray-700 p-4">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-left px-6 py-3 hover:bg-gray-800 transition">
                        Deconnexion
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col lg:min-w-0">
            <header class="bg-white shadow">
                <div class="px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <button id="adminMenuButton" type="button" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-100 transition" aria-label="Ouvrir le menu">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <h2 class="text-lg sm:text-2xl font-bold text-gray-800 truncate">@yield('heading')</h2>
                    </div>
                    <div class="text-gray-600">
                        <span class="text-sm sm:text-base">{{ Auth::user()->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-auto p-4 sm:p-6 lg:p-8">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        (() => {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('adminOverlay');
            const menuButton = document.getElementById('adminMenuButton');

            if (!sidebar || !overlay || !menuButton) {
                return;
            }

            const openMenu = () => {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            };

            const closeMenu = () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            };

            menuButton.addEventListener('click', openMenu);
            overlay.addEventListener('click', closeMenu);

            window.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeMenu();
                }
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    overlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        })();
    </script>
</body>
</html>
