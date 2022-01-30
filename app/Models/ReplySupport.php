<?php

namespace App\Models;

use App\Traits\BasicTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplySupport extends Model
{
    use HasFactory, BasicTrait;

    protected $fillable = ['user_id', 'support_id', 'description'];

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $table = "reply_support";

    protected $touches = ['support'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function support()
    {
        return $this->belongsTo(Support::class);
    }
}
