<?php

namespace Hadefication\Emailia\Listeners;

use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Hadefication\Emailia\Models\EmailLog;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSentMessage
{
    public function handle(MessageSent $event)
    {
        EmailLog::create([
            'details' => [
                'headers' => $event->message->getHeaders()->toString(),
                'id' => $event->message->getId(),
                'from' => $event->message->getFrom(),
                'to' => $event->message->getTo(),
                'reply_to' => $event->message->getReplyTo(),
                'bcc' => $event->message->getBcc(),
                'cc' => $event->message->getCc(),
                'read_receipt_to' => $event->message->getReadReceiptTo(),
                'subject' => $event->message->getSubject(),
                'sender' => $event->message->getSender(),
                'description' => $event->message->getDescription(),
                'max_line_length' => $event->message->getMaxLineLength(),
                'priority' => $event->message->getPriority(),
                'sender' => $event->message->getSender(),
                'genrated_id' => $event->message->generateId(),
                'content_html' => $event->message->getBody(),
                'content_text' => $event->message->toString(),
                'content_type' => $event->message->getBodyContentType(),
                'encoder' => $event->message->getEncoder(),
                '_message' => $event->message,
            ]
        ]);
    }
}
