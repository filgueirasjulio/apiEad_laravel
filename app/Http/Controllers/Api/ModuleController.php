<?php

namespace App\Http\Controllers\Api;

use App\Traits\LoggableTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Repositories\ModuleRepository;
use Exception;

class ModuleController extends Controller
{
    use LoggableTrait;
    
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
        try {
            return ModuleResource::collection($this->repository->getAllModules($courseId));
        } catch (Exception $e) {
            $this->log('App\Http\Controllers\Api\ModuleController - (index)', $e, null, 'daily');

            return response()->json(['message' => $e->getMessage()], 400);
        }
    
    }
}
