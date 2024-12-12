const express = require('express');
const http = require('http');
const { Server } = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = new Server(server);

app.use(express.static(__dirname + '/public')); // Serve static files from "public" folder

io.on('connection', (socket) => {
    console.log('User connected:', socket.id);

    // Handle incoming messages
    socket.on('chatMessage', (data) => {
        const message = {
            senderId: socket.id,
            text: data.message,
        };
        io.emit('chatMessage', message); // Broadcast to all clients
    });

    socket.on('disconnect', () => {
        console.log('User disconnected:', socket.id);
    });
});

server.listen(3000, () => {
    console.log('Server running on http://localhost:3000');
});
