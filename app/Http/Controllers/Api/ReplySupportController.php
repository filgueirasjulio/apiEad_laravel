<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupport;
use App\Http\Resources\ReplySupportResource;
use App\Repositories\ReplySupportRepository;
use App\Traits\LoggableTrait;

class ReplySupportController extends Controller
{
    use LoggableTrait;

    protected $repository;

    /**
     * @param ReplySupportRepository $repository
     * 
     * @return void
     */
    public function __construct(ReplySupportRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Registra uma resposta
     *
     * @param Support $support
     * 
     * @return mixed
     */
    public function createReply(StoreReplySupport $request)
    {
        try {
            $reply = $this->repository->createReplyToSupport($request->validated());
        } catch (\Exception $e) {
            $this->log('App\Http\Controllers\Api\ReplySupportController - (createReply)', $e, null, 'daily');

            return response()->json(['message' => $e->getMessage()], 400);
        }
         
        return new ReplySupportResource($reply);
    }
}
