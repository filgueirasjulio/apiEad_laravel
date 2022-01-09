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

    public function getMySupports(array $filters = [])
    {
        //$user = auth()->user();
        $user = User::first();

        return  $this->getUserAuth()
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

}