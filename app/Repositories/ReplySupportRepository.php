<?php

namespace App\Repositories;

use App\Models\ReplySupport;
use App\Traits\BasicTrait;
use App\Traits\LoggableTrait;

class ReplySupportRepository
{
    use BasicTrait;
    use LoggableTrait;

    protected $model;

    /**
    * @param ReplySupport $model
    * 
    * @return void
    */
    public function __construct(ReplySupport $model)
    {
        $this->model = $model;
    }

    /**
    * Cria resposta para uma pergunta
    * 
    * @param array $data
    *
    * @return mixed
    */
    public function createReplyToSupport(array $data)
    {
       $user = $this->getUserAuth();
    
       return $this->model
              ->create([
                'support_id' => $data['support_id'],
                'description' => $data['description'],
                'user_id' => $user->id
              ]);
    }

    /**
    * Retorna uma pergunta em especifico
    * 
    * @param string $uuid
    *
    * @return mixed
    */
    private function getSupport(string $uuid)
    {
        return $this->model->findOrFail($uuid);
    }

}