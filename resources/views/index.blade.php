{{-- <!DOCTYPE html>
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


            </div>
        </div>






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
            <div id="button-submit" class="text-center" style="background: #4acfee;height: 100%;width: 50px;border-radius: 5px;">
                <i class="fa fa-paper-plane text white" aria-hidden="true" style="line-height: 45px;"></i>

        </div>
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
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> \
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    ::-webkit-scrollbar{
        width: 5px;
    }
    ::-webkit-scrollbar-track{
        background: #13254c;
    }
    ::-webkit-scrollbar-thumb{
        background: #061128;
    }
</style>
<body style="background: #05113b;">
    <div>
        <div class="container-fluid m-0 d-flex p-2">
            <div class="pl-2" style="width: 40px;height: 50px;font-size: 180%;">
                <i class="fa fa-angle-double-left text-white mt-2"></i>
            </div>
            <div style="width: 50px;height: 50px;">
                <img src="https://png.pngtree.com/png-clipart/20200224/original/pngtree-cartoon-color-simple-male-avatar-png-image_5230557.jpg" width="100%" height="100%" style="border-radius: 50px;">
            </div>
            <div class="text-white font-weight-bold ml-2 mt-2">
                ChatBot
            </div>
        </div>
        <div style="background: #061128;height: 2px;"></div>
        <div id="content-box" class="container-fluid p-2" style="height: calc(100vh - 130px);overflow-y: scroll;">


        </div>
        <div class="container-fluid w-100 px-3 py-2 d-flex" style="background: #131f45;height: 62px;">
            <div class="mr-2 pl-2" style="background: #ffffff1c;width: calc(100% - 45px);border-radius: 5px;">
                <input id="input" class="text-white" type="text" name="input" style="background: none;width: 100%;height: 100%;border: 0;outline: none;">
            </div>
            <div id="button-submit" class="text-center" style="background: #4acfee;height: 100%;width: 50px;border-radius: 5px;">
                <i class="fa fa-paper-plane text-white" aria-hidden="true" style="line-height: 45px;"></i>

            </div>
        </div>
    </div>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('#button-submit').on('click',function(){
        $value = $('#input').val();
        $('#content-box').append(`<div class="mb-2">
                <div class="float-right px-3 py-2" style="width: 270px;background: #4acfee;border-radius: 10px;float: right;font-size: 85%;">
                    `+$value+`
                </div>
                <div style="clear: both;"></div>
            </div>`);


            $.ajax({
                type: 'post',
                url: '{{url('send')}}',
                data: {
                    'input':$value
                },
                success: function(data){
                    $('#content-box').append(` <div class="d-flex mb-2">
                <div class="mr-2" style="width: 45px;height: 45px;">
                <img src="https://png.pngtree.com/png-clipart/20200224/original/pngtree-cartoon-color-simple-male-avatar-png-image_5230557.jpg" width="100%" height="100%" style="border-radius: 50px;">
                </div>
                <div class="text-white px-3 py-2" style="width: 270px;background: #13254b;border-radius: 10px;font-size: 85%;">
                    `+data+`
                </div>
            </div>`)
            $value = $('#input').val('');
                }
            })
    })
</script>
