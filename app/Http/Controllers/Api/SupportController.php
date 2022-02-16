<?php

namespace App\Http\Controllers\Api;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupport;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use App\Traits\LoggableTrait;

class SupportController extends Controller
{
    use LoggableTrait;

    protected $repository;

    /**
     * @param SupportRepository $repository
     * 
     * @return void
     */
    public function __construct(SupportRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Lista dúvidas a partir de uma aula
     *
     * @param Request $request
     * 
     * @return mixed
     */
    public function index(Request $request)
    {
        try {
            return SupportResource::collection($this->repository->getSupports($request->all()));
        } catch (\Exception $e) {
            $this->log('App\Http\Controllers\Api\SupportController - (index)', $e, null, 'daily');

            return response()->json(['message' => $e->getMessage()], 400);
        } 
    }

    /**
     * Cadastra dúvida de uma aula
     *
     * @param StoreSupport $request
     * 
     * @return mixed
     */
    public function store(StoreSupport $request)
    {
        try {
            $support = $this->repository->createNewSupport($request->validated());
        } catch (\Exception $e) {
            $this->log('App\Http\Controllers\Api\SupportController - (store)', $e, null, 'daily');

            return response()->json(['message' => $e->getMessage()], 400);
        }

        return new SupportResource($support);
    }

    /**
     * Lista dúvidas de um usuário em específico 
     *
     * @param Request $request
     * 
     * @return mixed
     */
    public function mySupports(Request $request)
    {
        try {
            return SupportResource::collection($this->repository->getMySupports($request->all()));
        } catch (\Exception $e) {
            $this->log('App\Http\Controllers\Api\SupportController - (mySupports)', $e, null, 'daily');

            return response()->json(['message' => $e->getMessage()], 400);
        } 
    }
}
