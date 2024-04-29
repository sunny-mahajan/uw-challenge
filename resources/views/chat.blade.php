<x-app-layout>
    <x-slot name="header">
        <h2 class="auto-delete-warning font-semibold text-xl text-gray-800 leading-tight">
            <p>The chat messages will be automatically deleted once the recipient has seen the message or after 24
                hours.</p>
        </h2>
    </x-slot>

    <div class=".bg-gray-100 font-sansbg-gray-100 font-sans">
        <div class="chat-container">
            <!-- User List -->
            <div class="user-list">
                <h2 class="mb-4">Users</h2>
                <ul class="users-to-chat">
                    @foreach ($users as $user)
                        <li class="user-to-chat" data-recipient-id="{{ $user->id }}" data-recipient-name="{{$user->name}}">{{ $user->name }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Chat Window -->
            <div class="chat-window">
                <h2 class="mb-4 chat-with-user">Please select user to start chat</h2>

                <!-- Chat Messages -->
                <div id="chat-messages" class="bg-white rounded-lg shadow-lg overflow-y-auto max-h-96 mb-4">
                    <!-- Chat messages will be loaded here -->
                </div>
                <!-- End Chat Messages -->

                <!-- Message Area -->
                <div class="message-area">
                    <input id="message-input" name="message" type="text" placeholder="Type your message..."
                        class="py-2 px-4 focus:outline-none">
                    <button id="send-message-btn" type="button">Send</button>
                </div>
                <!-- End Message Area -->
            </div>
            <!-- End Chat Window -->
        </div>

        <script src="{{ asset('js/chat.js') }}"></script>
    </div>
</x-app-layout>
