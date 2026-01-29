<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left Side -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">
                    Laundry Ukhuwah
                </a>

                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                    Beranda
                </a>

                @guest
                <a href="{{ route('profil') }}" class="text-gray-700 hover:text-blue-600">
                    Profil Usaha
                </a>

                <a href="{{ route('layanan') }}" class="text-gray-700 hover:text-blue-600">
                    Layanan
                </a>

                <a href="{{ route('harga') }}" class="text-gray-700 hover:text-blue-600">
                    Harga
                </a>
                @endguest

                @auth
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
                        <!-- Admin/Staff Menu -->
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">
                            Dashboard Admin
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="text-gray-700 hover:text-blue-600">
                            Data Order
                        </a>
                        <a href="{{ route('admin.invoices.index') }}" class="text-gray-700 hover:text-blue-600">
                            Invoice
                        </a>
                    @else
                        <!-- Regular User Menu -->
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600">
                            Dashboard
                        </a>
                        <a href="{{ route('wallet.index') }}" class="text-gray-700 hover:text-blue-600">
                            Wallet
                        </a>
                        <a href="{{ route('transactions.index') }}" class="text-gray-700 hover:text-blue-600">
                            Transaksi
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                @guest
                <a href="{{ route('login') }}"
                    class="text-gray-700 hover:text-blue-600">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="text-gray-700 hover:text-blue-600">
                    Register
                </a>
                @endguest

                @auth
                <!-- Dropdown -->
                <div class="relative">
                    <button onclick="toggleDropdown()"
                        class="flex items-center text-gray-700 hover:text-blue-600">
                        {{ Auth::user()->name }}
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="dropdownMenu"
                        class="hidden absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md border">

                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 hover:bg-gray-100">
                            Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>

        </div>
    </div>
</nav>

<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    }
</script>