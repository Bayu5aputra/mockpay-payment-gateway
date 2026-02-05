<?php

namespace App\Providers;

use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(MessageSent::class, function (MessageSent $event): void {
            $message = $event->sent?->getOriginalMessage() ?? $event->message ?? null;

            $messageId = null;
            $subject = null;
            $to = [];

            if ($message) {
                if (method_exists($message, 'getHeaders')) {
                    $headers = $message->getHeaders();
                    $messageId = $headers->get('Message-ID')?->getBodyAsString()
                        ?? $headers->get('Message-Id')?->getBodyAsString();
                }

                if (method_exists($message, 'getSubject')) {
                    $subject = $message->getSubject();
                }

                if (method_exists($message, 'getTo')) {
                    $to = array_map(
                        static fn ($addr) => method_exists($addr, 'getAddress') ? $addr->getAddress() : (string) $addr,
                        $message->getTo() ?? []
                    );
                }
            }

            Log::info('Mail sent', [
                'to' => $to,
                'subject' => $subject,
                'message_id' => $messageId,
            ]);
        });
    }
}
