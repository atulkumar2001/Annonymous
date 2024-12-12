document.getElementById('chatForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const message = document.getElementById('messageInput').value;
    const chatBox = document.getElementById('chatBox');

    if (message.trim() !== "") {
        const messageElement = document.createElement('div');
        messageElement.textContent = message;
        chatBox.appendChild(messageElement);
        document.getElementById('messageInput').value = '';
    }
});
