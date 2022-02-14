<?php

namespace App\Models;

use App\Traits\BasicTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory, BasicTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = ['name', 'description', 'video'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    public function views()
    {
        return $this->hasMany(View::class)
                ->where(function ($query) {
                    if (auth()->check()) {
                        return $query->where('user_id', auth()->user()->id);
                }
            });
    }
}
