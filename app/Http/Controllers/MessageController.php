<?php
namespace App\Http\Controllers;
use App\Events\MessageDeleted;
use App\Events\MessageUpdated;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Event;
class MessageController extends Controller
{
    /**
     * Get a list of messages for a specific user.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $userId)
    {
        $perPage = $request->input('per_page', 15); // Default to 15 items per page
        $messages = Message::where('recipient_id', $userId)
            ->orWhere('sender_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        return response()->json($messages);
    }
    /**
     * Store a new message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = Message::create([
            'sender_id' => $request->sender_id,
            'recipient_id' => $request->recipient_id,
            'content' => $request->content,
            'read' => false,
        ]);
        broadcast(new MessageSent($message))->toOthers();
        return response()->json($message, 201);
    }

    /**
     * Display the specified message.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSenderMessage($sender_id, $recipient_id)
    {
        $messages = Message::where(function ($query) use ($sender_id, $recipient_id) {
            $query->where('sender_id', $sender_id)
                ->where('recipient_id', $recipient_id);
        })->orWhere(function ($query) use ($sender_id, $recipient_id) {
            $query->where('sender_id', $recipient_id)
                ->where('recipient_id', $sender_id);
        })->paginate(100); // Change 10 to the number of messages per page you want

        return response()->json($messages);
    }

    /**
     * Mark the specified message as read.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markAsRead($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['read' => true]);
        return response()->json($message);
    }
    /**
     * Update the specified message.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->update([
            'content' => $request->input('content'),
        ]);
        broadcast(new MessageUpdated($message))->toOthers();
        return response()->json($message);
    }
    /**
     * Remove the specified message from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        broadcast(new MessageDeleted($id))->toOthers();
        $message = Message::findOrFail($id);
        $message->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    }
}
