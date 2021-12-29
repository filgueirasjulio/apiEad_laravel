<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Support;

class SupportRepository
{
    protected $model;

    public function __construct(Support $model)
    {
        $this->model = $model;
    }

    public function getMySupports(array $filters = [])
    {
        //$user = auth()->user();
        $user = User::first();

        return  $user->supports()
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
}