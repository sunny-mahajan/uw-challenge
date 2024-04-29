<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <p>The chat messages will be automatically deleted once the recipient has seen the message or after 24 hours.</p>
        </h2>
    </x-slot>

    <div id="chat-container" class=".bg-gray-100 font-sansbg-gray-100 font-sans">
        <div class="max-w-3xl mx-auto p-4">
            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Dropdown to select users -->
            <form id="select-user-form">
                <select id="recipient-select" name="recipient_id" class="py-2 px-4 focus:outline-none">
                    <option value="">Select User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </form>

            <!-- Chat Messages -->
            <div id="chat-messages" class="bg-white rounded-lg shadow-lg overflow-y-auto max-h-96 mb-4">
            </div>
            <!-- End Chat Messages -->


            @include('chat-form')

            <script src="{{ asset('js/chat.js') }}"></script>
        </div>
</x-app-layout>

{{-- <!-- resources/views/chat.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                You're logged in!
            </div>
        </div>
    </div>
</div>

<body class="bg-gray-100 font-sans">
    <div class="max-w-3xl mx-auto p-4">
        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Dropdown to select users -->
        <form id="select-user-form">
            <select id="recipient-select" name="recipient_id" class="py-2 px-4 focus:outline-none">
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </form>

        <!-- Chat Messages -->
        <div id="chat-messages" class="bg-white rounded-lg shadow-lg overflow-y-auto max-h-96 mb-4">
        </div>
        <!-- End Chat Messages -->


        @include('chat-form')

        <script src="{{ asset('js/chat.js') }}"></script>
</body>

</html> --}}
