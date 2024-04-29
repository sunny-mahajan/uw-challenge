<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncryptionKeysToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encryption_keys_to_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id');
            $table->foreignId('recipient_id');
            $table->text('encryption_key');
            $table->text('decryption_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encryption_keys_to_messages');
    }
}
