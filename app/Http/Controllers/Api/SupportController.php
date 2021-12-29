<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Lista dúvidas a partir de uma aula
     *
     * @param Request $request
     * 
     * @return collection
     */
    public function index(Request $request)
    {
        return SupportResource::collection($this->repository->getMySupports($request->all()));
    }
}
