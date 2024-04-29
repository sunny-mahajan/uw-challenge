<?php

namespace App\Console\Commands;
use App\Models\Message;

use Illuminate\Console\Command;

class markMessagesExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mark:messagesExpire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "It expires the messages after a day if the recipient did not read the message";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "command started\n";
        Message::where('recipient_read', 0)
            // ->where('created_at', '<', date("Y-m-d H:i:s", strtotime("+1 minute"))) // it checks for 1 minute
            ->where('created_at', '<', date("Y-m-d H:i:s", strtotime("+24 hours"))) // it checks for 24 hours
            ->update([
                'expire_at' => date("Y-m-d H:i:s", time())
            ]);
        echo "command completed";
    }
}
