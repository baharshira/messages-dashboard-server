<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_title',
        'message_body',
        'user_id'
    ];

    // Defining a user that is the author of the message
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
