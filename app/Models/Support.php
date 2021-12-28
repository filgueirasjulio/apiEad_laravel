<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Support extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = ['description', 'status'];

    protected $statusOptions = [
        'pending' => 'Pendente, aguardando professor',
        'open' => 'Aguardando aluno',
        'finished' => 'Finalizado'
    ];
}
