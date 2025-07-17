<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ChatSeen;
use App\Models\ChatReply;
use App\Models\ChatMessage;
use Illuminate\Support\Str;
use App\Models\ChatReaction;
use Illuminate\Http\Request;
use App\Models\ChatAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer|exists:projects,id',
            'message' => 'nullable|string',
            'gif_url' => 'nullable|string',
            'file' => 'nullable|file|max:5120000', // 5GB
        ]);

        $message = new ChatMessage();
        $message->user_id = auth()->id();
        $message->project_id = $request->project_id;
        $message->message = $request->message;
        $message->gif_url = $request->gif_url;
        $message->save();

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $project = Project::findOrFail($request->project_id);
            $projectFolder = Str::slug($project->title);
            $attachmentPath = "assets/attachments/{$projectFolder}/";
            $fullPath = public_path($attachmentPath);

            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            $originalName = $file->getClientOriginalName();
            $fileName = time() . '_' . Str::random(10) . '_' . $originalName;
            $mimeType = $file->getMimeType();
            $fileSize = $file->getSize();

            $file->move($fullPath, $fileName);

            // Save to chat_attachments table
            ChatAttachment::create([
                'project_id' => $message->project_id,
                'chat_message_id' => $message->id,
                'original_name' => $originalName,
                'file_path' => $attachmentPath . $fileName,
                'mime_type' => $mimeType,
                'file_size' => $fileSize,
            ]);

            // 👉 Update project attachments JSON
            $existingAttachments = json_decode($project->attachments, true) ?? [];

            $existingAttachments[] = [
                'name' => $originalName,
                'path' => $attachmentPath . $fileName,
                'uploaded_at' => now()->toDateTimeString()
            ];

            $project->attachments = json_encode($existingAttachments);
            $project->save();
        }

        return response()->json(['status' => 'sent']);
    }

    public function getMessages($projectid)
    {
        $messages = ChatMessage::with('user')
            ->where('project_id', $projectid)
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();

        // Get all attachments for this project
        $attachments = ChatAttachment::where('project_id', $projectid)->get();

        // 🔗 Attach matching attachments to messages manually (based on closest created_at)
        foreach ($messages as $message) {
            $attachment = $attachments->first(function ($att) use ($message) {
                return $att->created_at->diffInSeconds($message->created_at) <= 2;
            });

            $message->attachment = $attachment;
        }
        

        return response()->json(['messages' => $messages]);
    }


    public function loadMoreMessages(Request $request)
    {
        $offset = $request->offset ?? 0;
        $limit = 50;

        // Step 1: Load from chat_messages
        $messages = DB::table('chat_messages')
            ->orderBy('id', 'desc') // strictly by ID
            ->offset($offset)
            ->limit($limit)
            ->get();

        // Step 2: If no more messages in main, switch to archive
        if ($messages->isEmpty()) {
            $archiveOffset = $offset - DB::table('chat_messages')->count();

            if ($archiveOffset >= 0) {
                $messages = DB::table('chat_messages_archive')
                    ->orderBy('id', 'desc') // strictly by ID
                    ->offset($archiveOffset)
                    ->limit($limit)
                    ->get();
            }
        }

        return response()->json([
            'messages' => $messages->sortBy('id')->values(),
            'nextOffset' => $offset + $messages->count(),
        ]);
    }


    
}
