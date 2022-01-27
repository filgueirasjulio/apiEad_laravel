<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\ReplySupport;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_label' => config('enums.supports.status')[$this->status],
            'description' => $this->description,
            'lesson' =>  new LessonResource($this->lesson),
            'replies' => LessonResource::collection($this->replies),
            'updated_at' => Carbon::make($this->updated_at)->format('d/m/y \à\s H:i:s')
        ];
    }
}
