<!-- resources/views/chat-form.blade.php -->

<!-- Chat Input -->
<div id="chat-input" class="flex items-center bg-white rounded-lg shadow-lg bottom-0 w-full p-4">
    <form id="send-message-form" class="w-full" action="/send-message" method="POST">
        @csrf
        <input id="message-input" name="message" type="text" placeholder="Type your message..."
            class="flex-1 py-2 px-4 focus:outline-none">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg focus:outline-none"
            style="color:black;border: solid 1px black">Send</button>
    </form>
</div>
<!-- End Chat Input -->
