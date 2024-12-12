<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonymous-chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }

        .chat-container {
            height: 400px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #ffffff;
        }

        .message {
            margin-bottom: 10px;
        }

        .message.sender {
            text-align: right;
            color: #007bff;
        }

        .message.receiver {
            text-align: left;
            color: #333;
        }

        .message .text {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 10px;
            max-width: 70%;
        }

        .message.sender .text {
            background-color: #e7f3ff;
        }

        .message.receiver .text {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h1 class="text-center mb-4">Start a conversation, leave an impression</h1>
        <div class="chat-container" id="chatBox">
            <!-- Messages will appear here -->
        </div>
        <form id="chatForm" class="mt-3">
            <div class="input-group">
                <input type="text" id="messageInput" class="form-control" placeholder="Type your message..." required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.socket.io/4.6.1/socket.io.min.js"></script>
    <script>
        const socket = io('http://localhost:3000');
        const chatBox = document.getElementById('chatBox');
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');

        // Render messages
        const renderMessage = (message) => {
            const messageDiv = document.createElement('div');
            const isSender = message.senderId === socket.id; // Check if the current user is the sender
            messageDiv.classList.add('message', isSender ? 'sender' : 'receiver');
            messageDiv.innerHTML = `
                <span class="text">${message.text}</span>
            `;
            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the bottom
        };

        // Receive messages from the server
        socket.on('chatMessage', (message) => {
            renderMessage(message);
        });

        // Send messages to the server
        chatForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const message = messageInput.value;
            socket.emit('chatMessage', { message });
            messageInput.value = ''; // Clear input
        });
    </script>
    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</body>
</html>
