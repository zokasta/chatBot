<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
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
        margin: 0;
        padding: 0;
        font-family: system-ui, -apple-system, sans-serif;
    }

    /* Header */
    .container-fluid.m-0.d-flex.p-2 {
        background: var(--darker-bg);
        border-bottom: 1px solid #1a1a2e;
        align-items: center;
    }

    .pl-2 {
        color: var(--light-blue);
        cursor: pointer;
    }

    .text-white.font-weight-bold.ml-2.mt-2 {
        color: var(--light-blue) !important;
        font-weight: 600 !important;
        margin-left: 10px !important;
    }

    /* Chat Container */
    #content-box {
        background: var(--dark-bg);
        height: calc(100vh - 130px) !important;
        padding: 15px !important;
    }

    /* User Message */
    .float-right.px-3.py-2 {
        background: var(--accent-blue) !important;
        color: white !important;
        border-radius: 18px 18px 0 18px !important;
        max-width: 70%;
        margin-left: auto;
        margin-bottom: 8px;
        font-size: 14px;
        line-height: 1.4;
    }

    /* Bot Message */
    .d-flex.mb-2 {
        margin-bottom: 15px !important;
    }

    .text-white.px-3.py-2 {
        background: #1a1a2e !important;
        color: var(--text-light) !important;
        border-radius: 18px 18px 18px 0 !important;
        max-width: 70%;
        font-size: 14px;
        line-height: 1.4;
    }

    /* Input Area */
    .container-fluid.w-100.px-3.py-2.d-flex {
        background: var(--darker-bg) !important;
        border-top: 1px solid #1a1a2e;
    }

    .mr-2.pl-2 {
        background: #1a1a2e !important;
        border-radius: 24px !important;
        border: 1px solid #2a2a3e;
    }

    #input {
        color: var(--text-light) !important;
        padding: 12px 15px !important;
    }

    #button-submit {
        background: var(--accent-blue) !important;
        border-radius: 50% !important;
        width: 46px !important;
        height: 46px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    #button-submit:hover {
        background: #2563eb !important;
        transform: translateY(-2px);
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #1a1a2e;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--accent-blue);
        border-radius: 3px;
    }

    /* user logout */
   /* User Dropdown Specific CSS */
.chat-header {
    margin-left: auto; /* Pushes to far right */
}

.user-info {
    position: relative;
}

/* Oval Button Styling */
.user-dropdown-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #1a1a2e !important;
    color: #6ec6ff !important;
    padding: 6px 12px 6px 6px !important;
    border-radius: 50px !important; /* Oval shape */
    border: 1px solid #3b82f6 !important;
    transition: all 0.2s;
}

.user-dropdown-btn:hover {
    background: #25253e !important;
}

.user-avatar {
    width: 32px !important;
    height: 32px !important;
    border-radius: 50% !important;
    border: 2px solid #6ec6ff !important;
    object-fit: cover;
}

.user-name {
    font-size: 14px;
    font-weight: 500;
}

/* Dropdown Menu */
.dropdown-menu {
    position: absolute;
    right: 0;
    top: 120%;
    width: 140px;
    background: #1a1a2e;
    border: 1px solid #3b82f6;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    display: none;
    z-index: 10;
}

.dropdown-menu button {
    width: 100%;
    padding: 8px 12px;
    text-align: left;
    color: #f0f0f0;
    background: transparent;
    border: none;
    border-radius: 4px;
}

.dropdown-menu button:hover {
    background: #25253e;
    color: #6ec6ff;
}

/* Thinking dots animation */
.thinking-dots span {
    opacity: 0;
    animation: dot-pulse 1.5s infinite;
    font-size: 24px;
    line-height: 0;
}

.thinking-dots span:nth-child(1) { animation-delay: 0s; }
.thinking-dots span:nth-child(2) { animation-delay: 0.5s; }
.thinking-dots span:nth-child(3) { animation-delay: 1s; }

@keyframes dot-pulse {
    0% { opacity: 0; transform: translateY(0); }
    50% { opacity: 1; transform: translateY(-5px); }
    100% { opacity: 0; transform: translateY(0); }
}


#file-upload-btn:hover {
    opacity: 0.8;
}

.fa-plus {
    font-size: 1.2rem;
    transition: all 0.2s;
}


</style>
<body style="background: #0a0a12;">
    <!-- EXACTLY YOUR ORIGINAL HTML STRUCTURE -->
    <div>
        <div class="container-fluid m-0 d-flex p-2">

            {{-- <div style="width: 50px;height: 50px;">
                <img src="https://png.pngtree.com/png-clipart/20200224/original/pngtree-cartoon-color-simple-male-avatar-png-image_5230557.jpg" width="100%" height="100%" style="border-radius: 50px;">
            </div> --}}
            <div class="text-white font-weight-bold ml-2 mt-2" style="font-size: 1.5rem; display: flex; align-items: center;">
                <img src="https://img.freepik.com/free-vector/chatbot-chat-message-vectorart_78370-4104.jpg"
                     style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                <span>MasterBot</span>
            </div>
            {{-- //userDetails --}}
            <div class="chat-header">
                <div class="user-info">
                    <div class="relative">
                        <button onclick="toggleDropdown()" class="user-dropdown-btn">
                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://via.placeholder.com/40' }}"
                                 alt="User Avatar" class="user-avatar">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                        </button>
                        <div id="dropdown" class="dropdown-menu">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout-btn">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end Here --}}
        </div>
        <div style="background: #1a1a2e;height: 2px;"></div>
        <div id="content-box" class="container-fluid p-2" style="height: calc(100vh - 130px);overflow-y: scroll;">
            <!-- Messages appear here -->
        </div>
        <div class="container-fluid w-100 px-3 py-2 d-flex" style="background: #07070e;height: 62px;">
            <div id="file-upload-btn" style="width:40px; display:flex; align-items:center; justify-content:center; cursor:pointer;">
                <i class="fas fa-plus text-white" style="margin-left: 20px;"></i>
                <input type="file" id="file-input" style="display:none;" accept=".pdf,.jpg,.png">
            </div>
            <div class="mr-2 pl-2" style="background: #1a1a2e;width: calc(100% - 45px);border-radius: 5px;">

                <input id="input" class="text-white" type="text" name="input" style="background: none;width: 100%;height: 100%;border: 0;outline: none;" placeholder="Type Something...">
            </div>
            <div id="button-submit" class="text-center" style="background: #3b82f6;height: 100%;width: 50px;border-radius: 5px;">
                <i class="fa fa-paper-plane text-white" aria-hidden="true" style="line-height: 45px;"></i>
            </div>
        </div>
    </div>

    <!-- YOUR ORIGINAL JAVASCRIPT (NO CHANGES) -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        function scrollToBottom() {
    const chatBox = document.getElementById('content-box');
    chatBox.scrollTop = chatBox.scrollHeight;
}
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $('#button-submit').on('click',function(){
            $value = $('#input').val();
            // Replace your user message code with this:
$('#content-box').append(`
    <div class="d-flex mb-2" style="justify-content: flex-end">
        <div class="float-right px-3 py-2" style="width:270px;background:#4acfee;border-radius:10px;font-size:85%;margin-right:10px">
            ${$value}
        </div>
        <div style="width:45px;height:45px">
            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://via.placeholder.com/45' }}"
                 style="width:100%;height:100%;border-radius:50%">
        </div>
    </div>
`);
                scrollToBottom();


                $.ajax({
                    type: 'post',
                    url: '{{url('send')}}',
                    data: {
                        'message':$value
                    },

                //     success: function(data){
                //         $('#content-box').append(` <div class="d-flex mb-2">
                //     <div class="mr-2" style="width: 45px;height: 45px;">
                //     <img src="https://img.freepik.com/free-vector/chatbot-chat-message-vectorart_78370-4104.jpg" width="100%" height="100%" style="border-radius: 50px;">
                //     </div>
                //     <div class="text-white px-3 py-2" style="width: 270px;background: #13254b;border-radius: 10px;font-size: 85%;">
                //     ${data.reply}
                //     </div>
                // </div>`)
                // $value = $('#input').val('');
                //     }

                // Add this to your AJAX call
success: function(data) {
    $value = $('#input').val('');

    // 1. Show thinking animation
    const thinkingMsg = $(`
        <div class="d-flex mb-2">
            <div class="mr-2" style="width:45px;height:45px">
                <img src="https://img.freepik.com/free-vector/chatbot-chat-message-vectorart_78370-4104.jpg"
                     style="width:100%;height:100%;border-radius: 50px">
            </div>
            <div class="text-white px-3 py-2" style="width:270px;background:#13254b;border-radius:10px;font-size:85%;margin-left:10px;">
                <div class="thinking-dots">
                    <span>.</span><span>.</span><span>.</span>
                </div>
            </div>
        </div>
    `).appendTo('#content-box');
    scrollToBottom();


    // 2. Wait 2 seconds, then show reply
    setTimeout(() => {
        thinkingMsg.remove(); // Remove dots

        // Add bot reply
        $('#content-box').append(`
            <div class="d-flex mb-2">
                <div class="mr-2" style="width:45px;height:45px">
                    <img src="https://img.freepik.com/free-vector/chatbot-chat-message-vectorart_78370-4104.jpg"
                         style="width:100%;height:100%;border-radius:50px">
                </div>
                <div class="text-white px-3 py-2" style="width:270px;background:#13254b;border-radius:10px;font-size:85%;margin-left:10px;">
                    ${data.reply}

                </div>
            </div>
        `);
        scrollToBottom();



        // Scroll to bottom
        $('#content-box').scrollTop($('#content-box')[0].scrollHeight);
    }, 2000);
}

                })
        })
// ------------------------------------------------
        // Add this to your existing script
function toggleDropdown() {
    const dropdown = document.getElementById('dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

// Close when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.user-info')) {
        document.getElementById('dropdown').style.display = 'none';
    }
});



// -----------------------------------------------------------------------------------------
// Add this right after your $(document).ready() or at the start of your script
function typeWelcomeMessage() {
    const welcomeText = "How can I assist you today?";
    const welcomeElement = $('#content-box').append(`
        <div class="d-flex mb-2">
            <div class="mr-2" style="width: 45px;height: 45px;">
                <img src="https://img.freepik.com/free-vector/chatbot-chat-message-vectorart_78370-4104.jpg"
                     width="100%" height="100%" style="border-radius: 50px;">
            </div>
            <div class="text-white px-3 py-2"
                 style="width: 270px;background: #13254b;border-radius: 10px;font-size: 85%;margin-left:10px;"
                 id="welcome-message"></div>
        </div>
    `);

    let i = 0;
    const typingInterval = setInterval(() => {
        if (i < welcomeText.length) {
            $('#welcome-message').text(welcomeText.substring(0, i+1));
            i++;
            $('#content-box').scrollTop($('#content-box')[0].scrollHeight);
        } else {
            clearInterval(typingInterval);
        }
    }, 100); // Adjust speed here (milliseconds per character)
}

// Call this function when the chat loads
$(document).ready(function() {
    typeWelcomeMessage();
    // Rest of your existing code...
});



// ------------------------------------------------------------------------------
// Handle Enter key in input field
$('#input').on('keypress', function(e) {
    if (e.which === 13) { // 13 is Enter key code
        $('#button-submit').click(); // Trigger click on send button
    }
});

// -----------------------------------------------------------
// Trigger file input when plus button is clicked
document.getElementById('file-upload-btn').addEventListener('click', function() {
    document.getElementById('file-input').click();
});

// Handle selected file
document.getElementById('file-input').addEventListener('change', function(e) {
    if (e.target.files.length > 0) {
        alert('File selected: ' + e.target.files[0].name);
        // Add your file upload logic here
    }
});

    </script>
</body>
</html>
