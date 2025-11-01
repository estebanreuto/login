@extends('layouts.app')

<style>
    @keyframes shake {

        0%,
        100% {
            transform: translateX(0)
        }

        20%,
        60% {
            transform: translateX(-6px)
        }

        40%,
        80% {
            transform: translateX(6px)
        }
    }

    .input-error {
        animation: shake .35s ease-in-out;
        border-bottom-color: #e53935 !important;
    }

    .error-text {
        color: #e53935;
        font-size: .75rem;
        margin-top: 4px;
        transition: opacity .4s ease;
    }
</style>

@section('content')
    {{-- Botón Home arriba derecha --}}
    <a href="/"
        class="absolute top-5 right-5 text-gray-600 hover:text-green-600 transition flex items-center gap-1 font-semibold">

        {{-- Icono Home mejorado y consistente con tu estilo --}}
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20px" height="20px">
            <path
                d="M39.5,43h-9c-1.381,0-2.5-1.119-2.5-2.5v-9c0-1.105-0.895-2-2-2h-4c-1.105,0-2,0.895-2,2v9c0,1.381-1.119,2.5-2.5,2.5h-9 C7.119,43,6,41.881,6,40.5V21.413c0-2.299,1.054-4.471,2.859-5.893L23.071,4.321c0.545-0.428,1.313-0.428,1.857,0L39.142,15.52 C40.947,16.942,42,19.113,42,21.411V40.5C42,41.881,40.881,43,39.5,43z" />
        </svg>
    </a>
    <div class="min-h-screen grid md:grid-cols-2">

        {{-- Left section --}}
        <div class="flex items-center justify-center bg-white px-8">
            <div class="w-full max-w-md">

                {{-- Error Animation --}}
                @if ($errors->any())
                    <div id="loginErrorBox" class="mb-4">
                        <p class="error-text" id="loginErrorText">Invalid credentials, try again</p>
                    </div>

                    <script>
                        window.addEventListener("DOMContentLoaded", () => {
                            const passInput = document.getElementById("password");
                            const box = document.getElementById("loginErrorBox");
                            const text = document.getElementById("loginErrorText");

                            passInput.classList.add("input-error");
                            setTimeout(() => passInput.classList.remove("input-error"), 600);

                            setTimeout(() => {
                                text.style.opacity = "0";
                                setTimeout(() => {
                                    box?.remove();
                                }, 500);
                            }, 2500);
                        });
                    </script>
                @endif

                <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Welcome back!</h1>
                <p class="text-sm text-gray-500 mb-8 max-w-sm">
                    Simplify your workflow and boost your productivity.
                    Get started for free.
                </p>

                @if(session('status'))
                    <div class="mb-4 text-green-600 text-sm">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div class="relative mb-6">
                        <input type="email" name="email" required autofocus placeholder="Email" class="w-full bg-transparent border-0 border-b-2 border-gray-400 
                                                               text-gray-900 focus:border-black focus:ring-0 
                                                               placeholder-gray-400 pr-10 text-sm">
                    </div>

                    {{-- Password --}}
                    <div class="relative mb-6">
                        <input id="password" type="password" name="password" required placeholder="Password" class="w-full bg-transparent border-0 border-b-2 border-gray-400 
                                                               text-gray-900 focus:border-black focus:ring-0
                                                               placeholder-gray-400 pr-10 text-sm">

                        <button type="button" onclick="togglePassword()"
                            class="absolute right-0 bottom-1 text-gray-400 hover:text-black">

                            {{-- Eye Open --}}
                            <svg id="eyeIconOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M1.5 12s4-7 10.5-7S22.5 12 22.5 12 18.5 19 12 19 1.5 12 1.5 12z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>

                            {{-- Eye Closed --}}
                            <svg id="eyeIconClose" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M1.5 12s4-7 10.5-7 10.5 7 10.5 7-4 7-10.5 7S1.5 12 1.5 12z" />
                                <circle cx="12" cy="12" r="3" />
                                <line x1="2" y1="2" x2="22" y2="22" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('password.request') }}" class="text-xs text-gray-500 hover:text-black">
                            Forgot Password?
                        </a>
                    </div>

                    {{-- Login button --}}
                    <button class="w-full bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-900 transition">
                        Login
                    </button>
                </form>

                <p class="mt-6 text-sm text-gray-600 text-center">
                    Not a member?
                    <a href="{{ route('register') }}" class="text-green-600 font-medium hover:text-green-700">
                        Register now
                    </a>
                </p>

            </div>
        </div>

        {{-- Right section --}}
        <div class="flex items-center justify-center bg-transparent px-6"></div>
    </div>

    </div>
@endsection

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const openIcon = document.getElementById('eyeIconOpen');
        const closeIcon = document.getElementById('eyeIconClose');

        input.type = input.type === "password" ? "text" : "password";
        openIcon.classList.toggle("hidden");
        closeIcon.classList.toggle("hidden");
    }
</script>