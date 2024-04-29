<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\MessageRepository;

class ChatController extends Controller
{
    protected $messageRepo;
    protected $userRepo;

    public function __construct(MessageRepository $messageRepo, UserRepository $userRepo)
    {
        $this->messageRepo = $messageRepo;
        $this->userRepo = $userRepo;
    }

    public function showChat()
    {
        $user = auth()->user(); // Assuming authenticated user is retrieved
        $users = $this->userRepo->getAllExceptLoggedInUser();

        return view('chat', compact('users'));
    }


    public function sendMessage(Request $request, $recipient)
    {
        try {
            // Logic to send the message to the recipient user
            $this->messageRepo->createMessage(
                auth()->id(), // Assuming authenticated user ID
                $recipient,
                $request->input('message')
            );

            // Return success response with the message
            return response()->json(['message' => 'Message sent successfully'], 200);
        } catch (\Exception $e) {
            // Return error response if there's an exception
            return response()->json(['error' => 'Failed to send message'], 500);
        }
    }
    public function getMessages($recipientId)
    {
        $loggedInUserId = auth()->id();

        // Fetch messages using MessageRepository
        $messages = $this->messageRepo->getMessages($loggedInUserId, $recipientId);

        // Return messages as JSON
        return response()->json(['messages' => $messages]);
    }

    public function fetchMessages(Request $request)
    {
        $messages = $this->messageRepo->getMessages(
            auth()->id(),
            $request->input('recipient_id')
        );

        return response()->json(['messages' => $messages]);
    }
}
