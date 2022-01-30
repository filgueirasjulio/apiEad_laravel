<?php

namespace App\Repositories;

use App\Models\Support;
use App\Traits\BasicTrait;

class SupportRepository
{
    use BasicTrait;

    protected $model;

    public function __construct(Support $model)
    {
        $this->model = $model;
    }

    public function getMySupports(array $filters = [])
    {
        $filters['user_id'] = true;

        return $this->getSupports($filters);
    }

    public function getSupports(array $filters = [])
    {
        return  $this->model
                ->where(function ($query) use ($filters) {
                    if(isset($filters['lesson_id'])) {
                        $query->where('lesson_id', $filters['lesson_id']);
                    }

                    if(isset($filters['status'])) {
                        $query->where('status', $filters['status']);
                    }

                    if(isset($filters['description'])) {
                        $description = $filters['description'];
                        $query->where('description', 'LIKE', "%{$description}%");
                    }

                    if(isset($filters['user_id'])) {
                        $user = $this->getUserAuth();

                        $query->where('user_id', $user->id);
                    }
                })->orderBy('updated_at', 'DESC')
                ->paginate();
    }

    public function createNewSupport(array $data) : Support
    {
        return $this->getUserAuth()
             ->supports()
             ->create([
                 'lesson_id' => $data['lesson'],
                 'status' => $data['status'],
                 'description' => $data['description']
             ]);
    }

    public function createReplyToSupportId(array $data, string $id)
    {
        $user = $this->getUserAuth();
    
       return $this->getSupport($id)
              ->replies()
              ->create([
                'description' => $data['description'],
                'user_id' => $user->id
              ]);
    }

    private function getSupport(string $id)
    {
        return $this->model->findOrFail($id);
    }

}