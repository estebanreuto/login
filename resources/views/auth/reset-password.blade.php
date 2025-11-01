@extends('layouts.app')

@section('content')
    <style>
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-6px);
            }

            40%,
            80% {
                transform: translateX(6px);
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
        }
    </style>

    <div class="min-h-screen grid md:grid-cols-2">

        {{-- Left Side Form --}}
        <div class="flex items-center justify-center bg-white px-8">
            <div class="w-full max-w-md">

                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Reset Password</h1>
                <p class="text-sm text-gray-500 mb-8">
                    Enter your new password below to recover access.
                </p>

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="mb-4 text-green-600 text-sm">{{ session('status') }}</div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <script>
                        window.addEventListener("DOMContentLoaded", () => {
                            const passInput = document.getElementById("password");
                            passInput.classList.add("input-error");
                            setTimeout(() => passInput.classList.remove("input-error"), 600);
                        });
                    </script>
                    <p class="error-text mb-4">Please verify your information.</p>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email --}}
                    <div>
                        <input id="email" name="email" type="email"
                            class="w-full bg-transparent border-0 border-b-2 border-gray-400 text-gray-900 focus:border-black focus:ring-0 placeholder-gray-400 text-sm"
                            placeholder="Email" required autofocus value="{{ old('email', $request->email) }}">
                    </div>

                    {{-- New Password --}}
                    <div class="relative">
                        <input id="password" type="password" name="password"
                            class="w-full bg-transparent border-0 border-b-2 border-gray-400 text-gray-900 focus:border-black focus:ring-0 placeholder-gray-400 pr-10 text-sm"
                            placeholder="New Password" required>
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-0 bottom-1 text-gray-400 hover:text-black">
                            <svg id="eyeIconOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M1.5 12s4-7 10.5-7S22.5 12 22.5 12 18.5 19 12 19 1.5 12 1.5 12z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg id="eyeIconClose" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M1.5 12s4-7 10.5-7 10.5 7 10.5 7-4 7-10.5 7S1.5 12 1.5 12z" />
                                <circle cx="12" cy="12" r="3" />
                                <line x1="2" y1="2" x2="22" y2="22" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="w-full bg-transparent border-0 border-b-2 border-gray-400 text-gray-900 focus:border-black focus:ring-0 placeholder-gray-400 text-sm"
                            placeholder="Confirm Password" required>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-900 transition">
                        Reset Password
                    </button>
                </form>

                <p class="mt-6 text-sm text-gray-600 text-center">
                    Remember your password?
                    <a class="text-green-600 font-medium hover:text-green-700" href="{{ route('login') }}">
                        Login
                    </a>
                </p>

            </div>
        </div>

        {{-- Right side --}}
        <div class="flex items-center justify-center bg-transparent px-6"></div>
    </div>
    {{-- Puedes poner una ilustración o mensaje aquí --}}
    </div>

    </div>

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

@endsection