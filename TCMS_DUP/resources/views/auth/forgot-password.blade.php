<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-yellow-100 to-blue-100 font-serif">

    <div class="w-full max-w-md bg-white text-black p-8 rounded-2xl shadow-2xl">
        
       
        <div class="flex justify-center mb-6">
            <img src="/images/lock-icon.png" alt="Lock Icon" class="h-14 w-14">
        </div>

        <h2 class="text-2xl font-bold text-yellow-600 mb-4 text-center">Reset Your Password</h2>
        
        <p class="text-sm text-black-600 mb-6 font-semibold text-center">
            Forgot your password?  No problem. Enter your email below to receive a reset link.
        </p>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-center font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-black-700 mb-1">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required autofocus
                    class="w-full px-4 py-2 bg-gray-100 text-black rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400"
                />
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full bg-yellow-400 text-black font-semibold py-2 px-4 rounded-md hover:bg-yellow-500 transition-all shadow-md"
            >
                Email Password Reset Link
            </button>
        </form>
    </div>

</body>
</html>
