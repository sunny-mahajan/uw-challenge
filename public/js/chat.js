// public/js/chat.js

document.addEventListener("DOMContentLoaded", function () {
    // select recipient
    const recipientSelect = document.getElementById("recipient-select");
    const chatMessages = document.getElementById("chat-messages");
    let recipientId = "";

    recipientSelect.addEventListener("change", function (event) {
        recipientId = recipientSelect.value;

        // Fetch messages between the logged-in user and the selected user
        fetch(`/get-messages/${recipientId}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json(); // Parse response as JSON
            })
            .then((data) => {
                // Clear existing messages in the chat interface
                chatMessages.innerHTML = "";

                // Loop through fetched messages and display them in the chat interface
                data.messages.forEach((message) => {
                    const messageElement = document.createElement("div");
                    messageElement.classList.add(
                        "message-item",
                        message.sender_id === recipientId ? "other" : "self"
                    );
                    messageElement.innerHTML = `
                    <div class="message-content">${message.message}</div>
                    <div class="message-meta">${message.created_at}</div>
                `;
                    chatMessages.appendChild(messageElement);
                });
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });

    // send message
    const sendMessageForm = document.getElementById("send-message-form");
    sendMessageForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const messageInput = document.getElementById("message-input");
        const chatMessages = document.getElementById("chat-messages");

        const message = messageInput.value.trim();

        if (message !== "" && recipientId !== "") {
            fetch(`/send-message/${recipientId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ message }),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json(); // Parse response as JSON
                })
                .then((data) => {
                    // Add the sent message to the chat interface
                    const messageElement = document.createElement("div");
                    messageElement.classList.add("message-item", "self");
                    messageElement.innerHTML = `
                        <div class="message-content">${message}</div>
                        <div class="message-meta">Just now</div>
                    `;
                    chatMessages.appendChild(messageElement);

                    // Clear the message input field
                    messageInput.value = "";
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    });
});
