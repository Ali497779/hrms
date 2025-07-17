<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ArchiveOldChatMessages extends Command
{
    protected $signature = 'chat:archive';
    protected $description = 'Archive chat messages beyond the latest 1000 globally';

    public function handle()
    {
        $total = DB::table('chat_messages')->count();
        $threshold = 1000;

        if ($total <= $threshold) {
            $this->info('Nothing to archive. Total messages: ' . $total);
            return;
        }

        $excess = $total - $threshold;

        // Get the oldest messages
        $messages = DB::table('chat_messages')
            ->orderBy('created_at', 'asc')
            ->limit($excess)
            ->get();

        // Archive messages
        foreach ($messages as $msg) {
            DB::table('chat_messages_archive')->insert([
                'project_id' => $msg->project_id,
                'sender_id' => $msg->sender_id,
                'message' => $msg->message,
                'created_at' => $msg->created_at,
                'updated_at' => $msg->updated_at,
            ]);
        }

        // Delete from original table
        DB::table('chat_messages')
            ->orderBy('created_at', 'asc')
            ->limit($excess)
            ->delete();

        $this->info("Archived $excess messages.");
    }
}