<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Chatbot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen p-4">


    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
        x-show="show" x-transition.duration.700ms
        class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full text-white space-y-6">

        <h2 class="text-3xl font-bold text-center text-cyan-400">Create Account</h2>

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-300">Username</label>
                <input type="text" name="name" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-300">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300">
            </div>

            <!-- Avatar Upload -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-300">Upload Avatar</label>
                <input type="file" name="avatar" accept="image/*" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300">
            </div>

            <button class="w-full py-2 text-lg font-semibold text-black bg-cyan-400 rounded-lg hover:bg-cyan-300 transition-all duration-300 transform hover:scale-105">
                Register
            </button>


        </form>

        <p class="text-sm text-center text-gray-400 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-cyan-400 hover:underline transition-all duration-300 hover:text-cyan-300">Login</a>
        </p>
    </div>
    {{-- @if ($errors->any())
    <div class="bg-red-500 text-white p-3 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
</body>
</html>
