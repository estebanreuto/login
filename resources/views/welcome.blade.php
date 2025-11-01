<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | SmartPanel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    
    <header class="relative overflow-hidden shadow">
        <!-- Animated Gradient BG -->
        <div class="absolute inset-0 animate-green-gradient bg-gradient-to-r 
        from-green-600 via-emerald-500 to-lime-400 opacity-90"></div>

        <!-- Blur layer -->
        <div class="absolute inset-0 backdrop-blur-md"></div>

        <div class="relative max-w-7xl mx-auto flex items-center justify-between py-4 px-6">
            <h1 class="text-xl font-bold text-white tracking-tight drop-shadow-sm">
                SmartPanel
            </h1>

            <nav class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-white font-medium hover:opacity-80 transition">
                    Sign In
                </a>

                <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-green-700 rounded-md font-semibold 
               hover:bg-gray-100 transition-shadow shadow-md hover:shadow-lg">
                    Create Account
                </a>
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section class="flex flex-1 justify-center items-center px-6">
        <div class="max-w-5xl grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">
                    Secure & Smart Management System
                </h2>
                <p class="text-gray-600 mb-6 text-lg">
                    Control users, security modules, and system activity with a clean and efficient dashboard.
                    Your productivity — upgraded.
                </p>

                <a href="{{ route('register') }}"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition font-semibold">
                    Create Your Account
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-lg border p-8">
                <h3 class="text-gray-800 font-semibold text-xl mb-4">Why SmartPanel?</h3>

                <div class="space-y-4 text-gray-600">
                    <div class="flex gap-3">
                        ✅ <span>Secure authentication & user roles</span>
                    </div>
                    <div class="flex gap-3">
                        ✅ <span>Modern dashboard experience</span>
                    </div>
                    <div class="flex gap-3">
                        ✅ <span>Real-time user activity tracking</span>
                    </div>
                    <div class="flex gap-3">
                        ✅ <span>Designed for business productivity</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t py-4 text-center text-sm text-gray-500">
        © {{ date('Y') }} SmartPanel — All rights reserved.
    </footer>

</body>

</html>