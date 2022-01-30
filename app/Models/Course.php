<?php

namespace App\Models;

use App\Traits\BasicTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, BasicTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
