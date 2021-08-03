<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Task extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'description'  => $this->description,
            'date'  => $this->date,
            'creator'  => $this->creator,
            'user_designated_id'  => $this->user_designated_id,
            'designate'  => $this->designate,
            'logs'  => $this->logs(),
            'time_since'  => Carbon::parse($this->date)->diffForHumans(Carbon::now()),
        ];
    }
}
