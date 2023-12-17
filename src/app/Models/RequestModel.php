<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestModel extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $fillable = [
        'users_id',
        'status',
        'message',
        'comment',
    ];
    protected $casts = [
        'users_id' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
