<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardEntity extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }
}
