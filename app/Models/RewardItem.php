<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class RewardItem extends Model
{

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * Model boot method
     */
     protected static function boot()
    {
        parent::boot();

        static::creating(function (RewardItem $reward) {
            $reward->slug = $reward->title ? Str::slug($reward->title) : null;
        });
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }
}
