<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white px-4 py-3 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">TourPay</div>
            <ul class="flex flex-wrap text-sm items-baseline">
                <li><a href="#home" class="hover:underline">Home</a></li>
                <li><a href="#about" class="hover:underline">About</a></li>
                <li><a href="#features" class="hover:underline">Features</a></li>
                <li><a href="#contact" class="hover:underline">Contact Us</a></li>
                @if (Route::has('login'))
                    @auth
                        <li>
                            <a href="{{ url('/dashboard') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Dashboard
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                                Log in
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}"
                                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                    Register
                                </a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="bg-cover bg-center min-h-screen flex items-center justify-center text-white"
        style="background-image: url('/images/bg-main.jpg')">
        <div class="bg-blue-800 bg-opacity-60 p-8 rounded-xl text-center max-w-xl">
            <h1 class="text-3xl font-bold mb-4">Welcome to TourPay Wallet</h1>
            <p class="text-sm mb-6">Your travel wallet in Saudi Arabia. Deposit in any currency, use a Mada-compatible
                digital card, and pay easily in local stores.</p>
            <div class="space-x-4">
                <a href="{{ route('login') }}"
                    class="bg-white text-blue-600 px-4 py-2 rounded shadow hover:bg-gray-100 transition">Login</a>
                <a href="{{ route('register') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition">Register</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-12 px-6 bg-blue-50 text-center">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">About TourPay</h2>
        <p class="text-gray-700 max-w-2xl mx-auto">
            TourPay is a digital wallet made for tourists in Saudi Arabia. It allows visitors to deposit money using
            credit cards from anywhere in the world and use a Mada-compatible digital card to pay in stores,
            restaurants, taxis, and more.
        </p>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-12 px-6 text-center bg-white">
        <h2 class="text-2xl font-bold text-blue-700 mb-6">Features</h2>
        <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            <div class="p-6 bg-blue-100 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-2">Multi-Currency Support</h3>
                <p class="text-sm text-gray-700">Deposit in your currency and we'll convert it to SAR with transparent
                    fees.</p>
            </div>
            <div class="p-6 bg-blue-100 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-2">Digital Mada Card</h3>
                <p class="text-sm text-gray-700">Use our simulated Mada card at local Saudi businesses and services.</p>
            </div>
            <div class="p-6 bg-blue-100 rounded-lg shadow">
                <h3 class="font-semibold text-lg mb-2">NFC Payments</h3>
                <p class="text-sm text-gray-700">Tap to pay at supported stores using a simulated NFC experience.</p>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 px-6 bg-blue-600 text-white text-center">
        <h2 class="text-2xl font-bold mb-4">Ready to Start Your Trip?</h2>
        <p class="mb-6">Create your wallet now and experience seamless payments in Saudi Arabia.</p>
        <div class="space-x-4">
            <a href="{{ route('login') }}"
                class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-gray-200 transition">Login</a>
            <a href="{{ route('register') }}"
                class="bg-blue-400 px-4 py-2 rounded hover:bg-blue-500 transition">Register</a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-12 px-6 bg-blue-50 text-center">
        <h2 class="text-2xl font-bold text-blue-700 mb-4">Contact Us</h2>
        <p class="text-gray-700 mb-2">Email: support@tourpay.sa</p>
        <p class="text-gray-700">Phone: +966 555 123 456</p>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-700 text-white py-4 text-center text-sm">
        &copy; {{ date('Y') }} TourPay. All rights reserved.
    </footer>



    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
