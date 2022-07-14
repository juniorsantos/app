<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Support\Facades\Artisan;

class CreateOrder
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
   * @param OrderPlaced $event
   * @return void
   */
  public function handle(OrderPlaced $event)
  {
    Artisan::call('order:get', [
      '--channel-id' => $event->orderHook->channel_id,
      '--order' => $event->orderHook->order_number
    ]);
  }
}
