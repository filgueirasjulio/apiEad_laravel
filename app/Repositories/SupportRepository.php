<?php

namespace App\Repositories;

use App\Http\Requests\StoreSupport;
use App\Models\User;
use App\Models\Support;
use App\Traits\GetUserAuth;

class SupportRepository
{
    use GetUserAuth;

    protected $model;

    public function __construct(Support $model)
    {
        $this->model = $model;
    }

    public function getSupports(array $filters = [])
    {
        //$user = auth()->user();
        $user = User::first();

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
                })->paginate();
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