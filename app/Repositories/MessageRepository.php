<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MessageRepository
{
    public function createMessage($senderId, $recipientId, $message)
    {
        try {
            $randomKey = Str::random(32); // Generate a random key for encryption
            $encryptedMessage = encrypt($message, $randomKey); // Encrypt the message

            // Store the encrypted message and encryption key in the database
            return Message::create([
                'sender_id' => $senderId,
                'recipient_id' => $recipientId,
                'message' => $encryptedMessage,
                'encryption_key' => $randomKey,
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getMessages($loggedInUserId, $recipientId)
    {
        $messagesData = Message::where(function ($query) use ($loggedInUserId, $recipientId) {
            $query->where('sender_id', $loggedInUserId)->where('recipient_id', $recipientId)
                ->orWhere('sender_id', $recipientId)->where('recipient_id', $loggedInUserId);
        })->orderBy('created_at', 'asc')
            ->get();
        $ids = [];
        foreach ($messagesData as $messageData) {
            $messageData->message = decrypt($messageData->message, $messageData->encryption_key);
            if ($loggedInUserId != $messageData->sender_id) {
                $ids[] = $messageData->id;
            }

            // Given time string
            $timeString = $messageData->created_at;

            // Parse the time string into a Carbon instance
            $carbonDate = Carbon::parse($timeString);

            // Format the Carbon instance into the desired format
            $formattedTime = $carbonDate->format("M d, Y - h:i a");

            $messageData->createdAtFormatted = $formattedTime;

            // show message as deleted if it's read by recipient or expired
            if ($messageData->recipient_read == 1 || $messageData->expire_at != null) {
                $messageData->message = "This message has been deleted.";
            }
        }

        Message::whereIn('id', $ids)->update([
            'recipient_read' => 1,
            'expire_at' => date("Y-m-d H:i:s", time())
        ]);

        return $messagesData;
    }
    public function getUserMessages($userId)
    {
        return Message::where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->orWhere('recipient_id', $userId);
        })
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
