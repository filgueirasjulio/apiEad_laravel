<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Repositories\ModuleRepository;

class ModuleController extends Controller
{
    protected $repository;

    public function __construct(ModuleRepository $repository)
    {
        $this->repository = $repository;
    }

      /**
     * Lista módulos a partir de um curso
     *
     * @param string $courseId
     * 
     * @return collection
     */
    public function index($courseId)
    {
        return ModuleResource::collection($this->repository->getAllModules($courseId));
    }
}
