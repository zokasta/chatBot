<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Chatbot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">


    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
        x-show="show" x-transition.duration.700ms
        class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full text-white">


        <h2 class="text-3xl font-bold text-center text-cyan-400">Welcome Back</h2>

        <form action="{{route('login')}}" method="POST" class="mt-4 space-y-4">
            @csrf



            <div>
                <label class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-lg
                    focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300 focus:scale-105">
            </div>


            <div>
                <label class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-lg
                    focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300 focus:scale-105">
            </div>
            <button class="w-full py-2 text-lg font-semibold text-black bg-cyan-400 rounded-lg
                hover:bg-cyan-300 transition-all duration-300 transform hover:scale-105">Login</button>
        </form>

        <p class="text-sm text-center text-gray-400 mt-4">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-cyan-400 hover:underline transition-all duration-300 hover:text-cyan-300">Register</a>
        </p>
    </div>


</body>

</html>
