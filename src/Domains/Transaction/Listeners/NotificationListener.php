<?php

namespace Domains\Transaction\Listeners;

use App\Events\OrderPlaced;
use Domains\Transaction\Events\SendNotification;
use Domains\Transaction\Services\NotificationService;
use Illuminate\Support\Facades\Artisan;

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
