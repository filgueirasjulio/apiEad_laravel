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

    public function __construct(ReplySupport $model)
    {
        $this->model = $model;
    }


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

    private function getSupport(string $id)
    {
        return $this->model->findOrFail($id);
    }

}