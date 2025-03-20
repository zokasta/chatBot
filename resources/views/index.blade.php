<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyberpunk Chatbot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to right, #0f0c29, #302b63, #24243e);
            color: white;
            font-family: 'Arial', sans-serif;
        }
        .chat-container {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
        }
        .chat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 10px;
        }
        .chat-header .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .chat-header .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .chat-header img {
            height: 40px;
            border-radius: 50%;
        }
        .logout-btn {
            background: red;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .chat-box {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .message {
            max-width: 70%;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease-in-out;
        }
        .user-msg {
            background: rgba(0, 255, 255, 0.2);
            align-self: flex-end;
            flex-direction: row-reverse;
        }
        .bot-msg {
            background: rgba(255, 0, 255, 0.2);
            align-self: flex-start;
        }
        .typing {
            font-style: italic;
            color: #ccc;
            font-size: 18px;
            font-weight: bold;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .input-container {
            display: flex;
            gap: 10px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.5);
            border-top: 2px solid cyan;
        }
        .input-box {
            flex-grow: 1;
            padding: 10px;
            border-radius: 5px;
            background: #1a1a2e;
            color: white;
            outline: none;
        }
        .send-btn {
            padding: 10px 20px;
            background: cyan;
            color: black;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .send-btn:hover {
            background: magenta;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="chat-container">
        {{-- <div class="chat-header">
            <div class="logo">
                <img src="logo.png" alt="Chatbot Logo">
                <p>Cyberpunk Chatbot</p>
            </div>
            <div class="user-info">
                <img src="user-avatar.png" alt="User Avatar">
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-10 h-10 rounded-full">

                <p>Username</p>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                </form>
                <button class="logout-btn">Logout</button>
            </div>
        </div> --}}

        <nav class="bg-gray-900 text-white p-4 flex justify-between items-center shadow-lg">
            <!-- Left: Logo -->
            <div class="text-cyan-400 font-bold text-lg">
                ChatBot
            </div>

            <!-- Right: Avatar & Logout -->
            <div class="flex items-center space-x-4">
                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://via.placeholder.com/40' }}"
                     alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-cyan-400">
                <span class="hidden sm:inline">{{ auth()->user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-600">Logout</button>
                </form>
            </div>
        </nav>




        <div class="chat-box" id="chatbox">
            <div class="message bot-msg">
                <img src="https://png.pngtree.com/png-clipart/20200224/original/pngtree-cartoon-color-simple-male-avatar-png-image_5230557.jpg" alt="Bot Avatar" class="avatar">
                <span>Hello! How can I assist you today?</span>
            </div>
        </div>
        <div class="input-container">
            <input type="text" id="message" class="input-box" placeholder="Type a message...">
            <button class="send-btn" onclick="sendMessage()">Send</button>
        </div>
    </div>
    <script>
        function sendMessage() {
            let msgInput = document.getElementById('message');
            let chatbox = document.getElementById('chatbox');
            let userMsg = msgInput.value.trim();
            if (userMsg === '') return;

            let userDiv = document.createElement('div');
            userDiv.classList.add('message', 'user-msg');
            userDiv.innerHTML = `<img src='user-avatar.png' alt='User Avatar' class='avatar'><span>${userMsg}</span>`;
            chatbox.appendChild(userDiv);
            msgInput.value = '';
            chatbox.scrollTop = chatbox.scrollHeight;

            let typingDiv = document.createElement('div');
            typingDiv.classList.add('message', 'bot-msg', 'typing');
            typingDiv.innerHTML = `<img src='https://png.pngtree.com/png-clipart/20200224/original/pngtree-cartoon-color-simple-male-avatar-png-image_5230557.jpg' alt='Bot Avatar' class='avatar'><span>...</span>`;
            chatbox.appendChild(typingDiv);
            chatbox.scrollTop = chatbox.scrollHeight;

            setTimeout(() => {
                typingDiv.remove();
                let botDiv = document.createElement('div');
                botDiv.classList.add('message', 'bot-msg');
                botDiv.innerHTML = `<img src='https://png.pngtree.com/png-clipart/20200224/original/pngtree-cartoon-color-simple-male-avatar-png-image_5230557.jpg' alt='Bot Avatar' class='avatar'><span>I'm here to help! What do you need?</span>`;
                chatbox.appendChild(botDiv);
                chatbox.scrollTop = chatbox.scrollHeight;
            }, 1500);
        }
    </script>
</body>
</html>
