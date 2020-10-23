<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Reward extends Model
{
    const PENDING_STATUS = 'pending';
    const DECLINED_STATUS = 'declined';
    const WAITING_TO_TRANSFER_STATUS = 'waiting_to_transfer';
    const TRANSFERRING_STATUS = 'transferring';
    const TRANSFERRED_STATUS = 'transferred';

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $appends = ['type'];

    /**
     * Model boot
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
            }
        });
    }

    /**
     * @param int $val
     */
    public function setAmount(int $val): void
    {
        $this->amount = $val;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getTypeAttribute()
    {
        return $this->rewardEntity->entity;
    }

    /**
     * Check reward limit
     */
    public function checkLimit()
    {
        // TODO: implement
    }

    /**
     * @return BelongsTo
     */
    public function rewardItem()
    {
        return $this->belongsTo(RewardItem::class);
    }

    /**
     * @return BelongsTo
     */
    public function rewardEntity()
    {
        return $this->belongsTo(RewardEntity::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
