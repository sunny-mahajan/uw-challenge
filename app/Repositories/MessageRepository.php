<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Support\Str;

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
        })->where('recipient_read', 0)->whereNull('expire_at')
            ->orderBy('created_at', 'asc')
            ->get();
        $ids = [];
        foreach ($messagesData as $messageData) {
            $messageData->message = decrypt($messageData->message, $messageData->encryption_key);
            if ($loggedInUserId != $messageData->sender_id) {
                $ids[] = $messageData->id;
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
