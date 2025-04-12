<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MasterBot</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --dark-bg: #0a0a12;
            --darker-bg: #07070e;
            --accent-blue: #3b82f6;
            --light-blue: #6ec6ff;
            --text-light: #f0f0f0;
            --text-muted: #a0a0b0;
        }

        body {
            background: var(--dark-bg);
            color: var(--text-light);
            font-family: 'Segoe UI', system-ui, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: var(--darker-bg);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #1a1a2e;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--light-blue);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            color: var(--accent-blue);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--light-blue);
            object-fit: cover;
        }

        .welcome-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .welcome-heading {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--light-blue);
        }

        .welcome-heading span {
            color: var(--accent-blue);
            font-weight: 600;
        }

        .welcome-text {
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--text-muted);
            margin-bottom: 30px;
            max-width: 600px;
        }

        .features {
            display: flex;
            gap: 30px;
            margin: 40px 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .feature-card {
            background: #1a1a2e;
            padding: 25px;
            border-radius: 12px;
            width: 250px;
            border: 1px solid #2a2a3e;
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-blue);
        }

        .feature-icon {
            font-size: 2rem;
            color: var(--accent-blue);
            margin-bottom: 15px;
        }

        .feature-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--text-light);
        }

        .feature-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .cta-button {
            background: var(--accent-blue);
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            margin-top: 20px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .cta-button:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
        }

        .cta-button i {
            transition: transform 0.3s;
        }

        .cta-button:hover i {
            transform: translateX(3px);
        }

        footer {
            text-align: center;
            padding: 20px;
            color: var(--text-muted);
            font-size: 0.9rem;
            border-top: 1px solid #1a1a2e;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">
            <img src="https://img.freepik.com/free-vector/chatbot-chat-message-vectorart_78370-4104.jpg"
            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 1px;">
            <span>MasterBot</span>
        </div>
        <div class="user-menu">
            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://via.placeholder.com/40' }}"
                 alt="User Avatar" class="user-avatar">
        </div>
    </nav>

    <!-- Main Content -->
    <div class="welcome-container">
        <h1 class="welcome-heading">Welcome, <span>{{ auth()->user()->name }}</span>!</h1>

        <p class="welcome-text">
            Discover the power of intelligent conversations with MasterBot - your AI-powered assistant
            that provides instant answers, creative ideas, and helpful solutions anytime you need.
        </p>

        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="feature-title">Instant Responses</h3>
                <p class="feature-desc">
                    Get accurate answers to your questions in real-time, 24/7.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 class="feature-title">Creative Ideas</h3>
                <p class="feature-desc">
                    Brainstorm and explore new concepts with AI-powered suggestions.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Secure & Private</h3>
                <p class="feature-desc">
                    Your conversations are encrypted and never shared with third parties.
                </p>
            </div>
        </div>

        <a href="{{route('chats')}}" class="cta-button">
            Start Chatting <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <footer>
        © 2023 MasterBot AI Assistant. All rights reserved.
    </footer>
</body>
</html>
