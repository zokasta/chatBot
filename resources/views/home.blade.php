<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot UI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            color: white;
        }
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
        }
        .neon-text {
            text-shadow: 0 0 5px cyan, 0 0 10px cyan, 0 0 20px cyan;
        }
        .typing-indicator span {
            animation: blink 1.5s infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-2xl p-4 glass">
        <h2 class="text-2xl neon-text text-center font-bold mb-4">Chatbot</h2>
        <div id="chatbox" class="h-96 overflow-y-auto p-3 space-y-2 border border-gray-500 rounded-lg">
            <div class="bg-gray-800 p-3 rounded-lg max-w-xs">Hello! How can I assist you today?</div>
        </div>
        <div class="flex mt-4">
            <input id="message" type="text" class="flex-1 p-2 bg-gray-900 border border-gray-600 rounded-lg focus:ring-2 focus:ring-cyan-400" placeholder="Type a message...">
            <button class="ml-2 p-2 bg-cyan-500 text-black font-bold rounded-lg hover:bg-cyan-400 transition-all">Send</button>
        </div>
    </div>
</body>
</html>
