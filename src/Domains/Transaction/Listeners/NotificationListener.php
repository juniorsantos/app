<?php

namespace Domains\Transaction\Listeners;

use Domains\Transaction\Events\SendNotification;
use Domains\Transaction\Services\NotificationService;

class NotificationListener
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
     * @param SendNotification $event
     *
     * @return void
     */
    public function handle(SendNotification $event)
    {
        app(NotificationService::class)->notifyUser($event->walletTransaction->wallet->user->uuid);
    }
}
