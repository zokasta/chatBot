{{-- <!-- Updated Register Form with Avatar Upload -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Chatbot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div x-data="{ darkMode: true }" :class="darkMode ? 'bg-gray-900 text-white' : 'bg-white text-black'">
        <button @click="darkMode = !darkMode" class="absolute top-5 right-5 p-2 bg-cyan-400 rounded-full">
            Toggle Mode
        </button>
    </div>

    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
        x-show="show" x-transition.duration.700ms
        class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full text-white">

        <h2 class="text-3xl font-bold text-center text-cyan-400">Create Account</h2>

        <form action="#" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-300">Username</label>
                <input type="text" name="username" required class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300 focus:scale-105">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300 focus:scale-105">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300 focus:scale-105">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300">Profile Picture</label>
                <input type="file" name="avatar" accept="image/*" required class="w-full px-4 py-2 mt-1 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-cyan-400 focus:outline-none transition-all duration-300 focus:scale-105">
            </div>
            <button class="w-full py-2 text-lg font-semibold text-black bg-cyan-400 rounded-lg hover:bg-cyan-300 transition-all duration-300 transform hover:scale-105">Register</button>
        </form>

        <p class="text-sm text-center text-gray-400 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-cyan-400 hover:underline transition-all duration-300 hover:text-cyan-300">Login</a>
        </p>
    </div>
</body>
</html> --}}
