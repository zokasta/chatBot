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

        /* file upload css */
        .file-upload-container {
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}

/* ✅ Message Input - Attach File Inside */
.message-input-wrapper {
    display: flex;
    align-items: center;
    flex: 1;
    background: rgba(255, 255, 255, 0.08);
    color: #e0e0e0;
    padding: 8px 14px;
    border-radius: 8px;
    outline: none;
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
}

/* ✅ Plus Button Inside Input */
.file-upload-label {
    position: absolute;
    left: 10px;
    cursor: pointer;
    font-size: 18px;
    color: #bbb;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transition: all 0.2s ease-in-out;
}

.file-upload-label:hover {
    background: rgba(255, 255, 255, 0.2);
}

.file-upload-input {
    display: none;
}

.message-input {
    flex: 1;
    background: transparent;
    border: none;
    color: #e0e0e0;
    padding-left: 40px; /* Space for plus button */
    outline: none;
}

/* ✅ Send Button - Clean & Modern */
.send-button {
    background: #333;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 15px;
    color: #ddd;
    transition: all 0.2s ease-in-out;
    border: 1px solid rgba(255, 255, 255, 0.15);
    margin-left: 8px;
}

.send-button:hover {
    background: #444;
}



    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <div class="logo">
                <img src="https://cdn.dribbble.com/userupload/38950926/file/original-8d460ccfb0a8d2372b2227677a79cb33.jpg?format=webp&resize=400x300&vertical=center" alt="Chatbot Logo">
                <p>Cyberpunk Chatbot</p>
            </div>
            <div class="user-info">
                {{-- <img src="user-avatar.png" alt="User Avatar">
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-10 h-10 rounded-full">

                <p>Username</p> --}}
                <div class="relative">
                <button onclick="toggleDropdown()" class="flex items-center space-x-2 bg-gray-800 text-white px-3 py-2 rounded-full">

                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://via.placeholder.com/40' }}"
                         alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-cyan-400">

                         <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                </button>
                 <!-- Dropdown Menu -->
                 <div id="dropdown" class="absolute right-0 mt-2 w-40 bg-gray-900 text-white rounded-lg shadow-lg hidden">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block px-4 py-2 w-full text-left hover:bg-gray-700">Logout</button>
                    </form>
                </div>
                </div>

                {{-- <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                </form> --}}
                {{-- <button class="logout-btn">Logout</button> --}}
            </div>
        </div>

        {{-- <nav class="bg-gray-900 text-white p-4 flex justify-between items-center shadow-lg">
            <!-- Left: Logo -->
            <div class="text-cyan-400 font-bold text-lg">
                ChatBot
            </div> --}}

            <!-- Right: Avatar & Logout -->
            {{-- <div class="flex items-center space-x-4">
                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://via.placeholder.com/40' }}"
                     alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-cyan-400">
                <span class="hidden sm:inline">{{ auth()->user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-600">Logout</button>
                </form>
            </div>
        </nav> --}}




        <div class="chat-box" id="chatbox">
            <div class="message bot-msg">
                <img src="https://png.pngtree.com/png-clipart/20200224/original/pngtree-cartoon-color-simple-male-avatar-png-image_5230557.jpg" alt="Bot Avatar" class="avatar">
                <span>Hello! How can I assist you today?</span>
            </div>
        </div>





        <div class="input-container">
            <div class="message-input-wrapper">
            <label for="fileInput" class="file-upload-label">
                <i class="fas fa-plus">+</i> <!-- ✅ Plus Button -->
            </label>
            <input type="file" id="fileInput" class="file-upload-input">
            <input type="text" id="message" class="message-input" placeholder="Type a message...">
            <button class="send-btn" onclick="sendMessage()">Send</button>
        </div>
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
            userDiv.innerHTML = `<img src='{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://via.placeholder.com/40' }}' alt='User Avatar' class='avatar'><span>${userMsg}</span>`;
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

        //dropdown JS
        function toggleDropdown() {
             document.getElementById("dropdown").classList.toggle("hidden");
        }

      


    // upload file logic-------------------
    document.getElementById("fileInput").addEventListener("change", function(event) {
    let file = event.target.files[0];

    if (!file) return; // No file selected

    let formData = new FormData();
    formData.append("file", file);

    fetch("{{ route('upload.file') }}", {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // ✅ Success message
        console.log("Uploaded File:", data.filename);
    })
    .catch(error => {
        console.error("Error:", error);
    });
});
// upload file end-------------------------------------------------
    </script>
</body>
</html>
