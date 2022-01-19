<?php

namespace App\Http\Controllers\Api;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupport;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReplyResource;
use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use App\Http\Requests\StoreReplySupport;
use App\Http\Resources\ReplySupportResource;

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
        return SupportResource::collection($this->repository->getSupports($request->all()));
    }

    /**
     * Cadastra dúvida de uma aula
     *
     * @param StoreSupport $request
     * 
     * @return Support
     */
    public function store(StoreSupport $request)
    {
        $support = $this->repository->createNewSupport($request->validated());
        return new SupportResource($support);
    }

    
    /**
     * Registra uma resposta
     *
     * @param Support $support
     * 
     * @return Support
     */
    public function createReply(StoreReplySupport $request, Support $support)
    {
        $reply = $this->repository->createReplyToSupportId($request->validated(), $support->id);

        return new ReplySupportResource($reply);
    }
}
