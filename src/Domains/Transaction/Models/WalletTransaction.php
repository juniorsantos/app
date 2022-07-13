<?php

declare(strict_types=1);

namespace Domains\Transaction\Models;

use Domains\Shared\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletTransaction extends Model
{
    use HasUuid;
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'payee_wallet_uuid',
        'payer_wallet_uuid',
        'value',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'updated_at',
        'created_at',
    ];

    /**
     * @return BelongsTo
     */
    public function walletPayee(): BelongsTo
    {
          return $this->belongsTo(Wallet::class, 'payee_wallet_uuid', 'uuid');
    }

    /**
     * @return BelongsTo
     */
    public function walletPayer(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'payer_wallet_uuid', 'uuid');
    }
}
