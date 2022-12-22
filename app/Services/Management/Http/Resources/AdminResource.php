<?php

namespace App\Services\Management\Http\Resources;

use App\Models\Admin;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/***@mixin Admin */
class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'created_at'=>$this->created_at->format('d/m/y h:i:s'),
            'updated_at'=>$this->updated_at->format('d/m/y h:i:s'),
            'status'=>$this->status,
            'status_title'=>$this->status_title,
            'route_delete'=>$this->route_delete
        ];
    }
}
