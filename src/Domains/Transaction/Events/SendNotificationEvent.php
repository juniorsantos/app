<?php

namespace Domains\Transaction\Events;

use Domains\Transaction\Models\WalletTransaction;
use Illuminate\Queue\SerializesModels;

class SendNotificationEvent
{
    use SerializesModels;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public WalletTransaction $walletTransaction
    ) {
    }
}
