<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\BroadcastChat;

class Message extends Model
{
    protected $dispatchesEvents = [
      'created' => BroadcastChat::class
    ];

    protected $fillable = ['message','user_id','friend_id'];
}
