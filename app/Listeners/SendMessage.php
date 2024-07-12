<?php

namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSent  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        // Xử lý logic nhận tin nhắn từ sự kiện ở đây
        $message = $event->message;

        // // Ví dụ đơn giản, chỉ log ra console
        // \Log::info("New message sent: {$message}");
    }
}
