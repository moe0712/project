<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // 複数代入を許可するフィールドを指定
    protected $fillable = [
        'user_id', 'post_id', 'reason_type',
    ];
}
