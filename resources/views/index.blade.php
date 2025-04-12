<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --bg-primary: #f5f7fa;
            --bg-secondary: #ffffff;
            --accent-color: #5e72e4;
            --user-message: #5e72e4;
            --bot-message: #edf2f7;
            --sidebar-bg: #2d3748;
            --text-primary: #2d3748;
            --text-secondary: #718096;
            --border-color: #e2e8f0;
            --profile-bg: #ffffff;
        }

        body {
            background: var(--bg-primary);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--text-primary);
            margin: 0;
            padding: 0;
            overflow: hidden !important;
        }

        /* Header */
        .header-container {
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            margin-left: 60px;
            /* Space for toggle button */
        }

        .logo-text {
            font-weight: 600;
            font-size: 1.5rem;
            color: var(--text-primary);
        }

        /* Profile Section */
        .profile-section {
            margin-left: auto;
        }

        /* Chat Container */
        #content-box {
            background: var(--bg-primary);
            height: calc(100vh - 130px);
            padding: 20px;
            overflow-y: scroll;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE/Edge */
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        #content-box::-webkit-scrollbar {
            width: 0 !important;
            height: 0 !important;
            background: transparent !important;
            display: none !important;
        }

        /* Messages */
        .user-message {
            background: var(--user-message);
            color: white;
            border-radius: 18px 4px 18px 18px;
            max-width: 70%;
            margin-left: auto;
            margin-bottom: 12px;
            padding: 12px 16px;
            font-size: 14px;
            line-height: 1.5;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .bot-message {
            background: var(--bot-message);
            color: var(--text-primary);
            border-radius: 4px 18px 18px 18px;
            max-width: 70%;
            margin-bottom: 15px;
            padding: 12px 16px;
            font-size: 14px;
            line-height: 1.5;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Input Area */
        .input-container {
            background: var(--bg-secondary);
            border-top: 1px solid var(--border-color);
            padding: 12px 20px;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
        }

        .message-input {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 12px 20px;
            flex-grow: 1;
            margin: 0 12px;
            color: var(--text-primary);
            outline: none;
        }

        .send-button {
            background: var(--accent-color);
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
            color: white;
        }

        .send-button:hover {
            background: #4a63d2;
            transform: translateY(-2px);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: -280px;
            padding: 1.5rem;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow-y: auto;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE/Edge */
        }

        .sidebar::-webkit-scrollbar {
            display: none;
            /* Chrome/Safari/Opera */
        }

        .sidebar.active {
            left: 0;
        }

        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            background: var(--accent-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .toggle-btn.shifted {
            left: 300px;
        }

        .main-content {
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-left: 0;
        }

        .main-content.shifted {
            margin-left: 280px;
        }

        /* Profile Dropdown */
        .profile-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--profile-bg);
            color: var(--text-primary);
            padding: 6px 12px;
            border-radius: 50px;
            border: 1px solid var(--border-color);
            transition: all 0.2s;
            cursor: pointer;
        }

        .profile-btn:hover {
            background: var(--bg-primary);
        }

        .profile-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid var(--accent-color);
            object-fit: cover;
        }

        .dropdown-menu {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: none;
            position: absolute;
            right: 0;
            min-width: 140px;
            z-index: 100;
        }

        .dropdown-item {
            padding: 8px 16px;
            color: var(--text-primary);
            text-decoration: none;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: var(--bg-primary);
        }

        /* Animations */
        @keyframes dot-pulse {

            0%,
            100% {
                opacity: 0.2;
                transform: translateY(0);
            }

            50% {
                opacity: 1;
                transform: translateY(-3px);
            }
        }

        .thinking-dots span {
            animation: dot-pulse 1.5s infinite;
        }

        .thinking-dots span:nth-child(2) {
            animation-delay: 0.5s;
        }

        .thinking-dots span:nth-child(3) {
            animation-delay: 1s;
        }

        .main-content {
            overflow: hidden !important;
        }


        /* dropdown logo */
        .logo-container .dropdown {
        position: relative;
        display: flex;
        align-items: center;
    }

    .logo-container .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 8px 0;
        min-width: 150px;
        z-index: 1000;
        display: none;
    }

    .logo-container .dropdown-menu.show {
        display: block;
    }

    .logo-container .dropdown-item {
        padding: 8px 16px;
        color: var(--text-primary);
        text-decoration: none;
        display: block;
    }

    .logo-container .dropdown-item:hover {
        background: var(--bg-primary);
    }
    </style>
</head>

<body>
    <!-- Toggle Button -->
    <button id="toggleBtn" class="toggle-btn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header mb-4">
            <h4 class="mb-0">MasterBot</h4>
        </div>

        <button class="btn w-100 my-3" id="newChatBtn" style="background: var(--accent-color); color: white; border: none;">+ New
            Chat</button>
            <div id="chat-list">
                <!-- Dynamic chat buttons yahan aayenge -->
            </div>
    </div>

    <!-- Main Content -->
    <div id="mainContent" class="main-content">
        <div class="header-container">
            <!-- Update your logo container with this code -->
<div class="logo-container">
    <div class="dropdown">
        <!-- Wrapped both logo and text in dropdown trigger -->
        <div class="d-flex align-items-center dropdown-toggle" id="logoDropdown" style="cursor: pointer;">
            <img src="https://img.freepik.com/free-vector/chatbot-chat-message-vectorart_78370-4104.jpg"
                style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
            <span class="logo-text">MasterBot</span>
        </div>
        <ul class="dropdown-menu" aria-labelledby="logoDropdown">
            <li><a class="dropdown-item" href="#">OpenAI</a></li>
            <li><a class="dropdown-item" href="#">Llama</a></li>
            <li><a class="dropdown-item" href="#">Microsoft</a></li>
        </ul>
    </div>
</div>


            <div class="profile-section">
                <div class="user-info">
                    <button onclick="toggleDropdown()" class="profile-btn">
                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://via.placeholder.com/40' }}"
                            alt="User Avatar" class="profile-avatar">
                        <span>{{ auth()->user()->name }}</span>
                    </button>
                    <div id="dropdown" class="dropdown-menu">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="content-box">
            <!-- Messages will appear here -->
        </div>

        <div class="input-container">
            <div id="file-upload-btn" style="cursor: pointer;">
                <i class="fas fa-plus" style="color: var(--text-secondary);"></i>
                <input type="file" id="file-input" style="display: none;" accept=".pdf,.jpg,.png">
            </div>
            <input id="input" class="message-input" type="text" placeholder="Type Something...">
            <button id="button-submit" class="send-button">
                <i class="fa fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
         //new chat
    let currentChatId = 1; // Track active chat
const chatHistory = {}; // Store all chats

// Initialize first chat
chatHistory[1] = {
    name: "Chat 1",
    messages: []
};
        function scrollToBottom() {
            const chatBox = document.getElementById('content-box');
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#button-submit').on('click', function() {
            const message = $('#input').val().trim();
            if (message === '') return;

            // Add user message
            $('#content-box').append(`
                <div class="d-flex justify-content-end mb-3">
                    <div class="user-message">${message}</div>
                    <div style="width:40px; height:40px; margin-left:10px;">
                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://via.placeholder.com/40' }}"
                            style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                    </div>
                </div>
            `);
            scrollToBottom();
            $('#input').val('');

            // Show typing indicator
            const thinkingMsg = $(`
                <div class="d-flex mb-3">
                    <div style="width:40px; height:40px; margin-right:10px;">
                        <img src="https://img.freepik.com/free-vector/chatbot-chat-message-vectorart_78370-4104.jpg"
                            style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                    </div>
                    <div class="bot-message">
                        <div class="thinking-dots">
                            <span>.</span><span>.</span><span>.</span>
                        </div>
                    </div>
                </div>
            `).appendTo('#content-box');
            scrollToBottom();

            // Send message to server
            $.ajax({
                type: 'POST',
                url: '{{ url('send') }}',
                data: {

                    message: message
                },
                success: function(response) {
                    thinkingMsg.remove();

                    // Add bot response
                    $('#content-box').append(`
                        <div class="d-flex mb-3">
                            <div style="width:40px; height:40px; margin-right:10px;">
                                <img src="https://img.freepik.com/free-vector/chatbot-chat-message-vectorart_78370-4104.jpg"
                                    style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                            </div>
                            <div class="bot-message">
                                ${response.reply}
                            </div>
                        </div>
                    `);
                    scrollToBottom();
                }
            });
        });

        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.user-info')) {
                document.getElementById('dropdown').style.display = 'none';
            }
        });

        function typeWelcomeMessage() {
            const welcomeText = "How can I assist you today?";
            $('#content-box').append(`
                <div class="d-flex mb-3">
                    <div style="width:40px; height:40px; margin-right:10px;">
                        <img src="https://img.freepik.com/free-vector/chatbot-chat-message-vectorart_78370-4104.jpg"
                            style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                    </div>
                    <div class="bot-message" id="welcome-message"></div>
                </div>
            `);

            let i = 0;
            const typingInterval = setInterval(() => {
                if (i < welcomeText.length) {
                    $('#welcome-message').text(welcomeText.substring(0, i + 1));
                    i++;
                    scrollToBottom();
                } else {
                    clearInterval(typingInterval);
                }
            }, 100);
        }

        $(document).ready(function() {
            typeWelcomeMessage();

            $('#input').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#button-submit').click();
                }
            });

            $('#file-upload-btn').click(function() {
                $('#file-input').click();
            });

            $('#file-input').change(function(e) {
                if (e.target.files.length > 0) {
                    alert('File selected: ' + e.target.files[0].name);
                }
            });
//sidebar start
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleBtn = document.getElementById('toggleBtn');

            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                mainContent.classList.toggle('shifted');
                toggleBtn.classList.toggle('shifted');
            });
        });


        // DOM load hone ke baad force apply karo
        document.addEventListener('DOMContentLoaded', function() {
            const contentBox = document.getElementById('content-box');
            contentBox.style.overflow = 'auto';
            contentBox.style.scrollbarWidth = 'none';
            contentBox.style.msOverflowStyle = 'none';
        });
        //end


//dropdown logo
document.getElementById('logoDropdown').addEventListener('click', function(e) {
        e.stopPropagation();
        const menu = this.nextElementSibling;
        menu.classList.toggle('show');
    });

    // Close when clicking outside
    document.addEventListener('click', function() {
        const menus = document.querySelectorAll('.logo-container .dropdown-menu');
        menus.forEach(menu => menu.classList.remove('show'));
    });

    //end

//new chat


    </script>
</body>

</html>
