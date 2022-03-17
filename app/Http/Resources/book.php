<?php

namespace App\Http\Resources;

use App\Transformers\CategoryTransformer;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\category;

class book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bookname' => $this->bookname,
            'description'=>$this->description,
            'category_id'=> $this->category_id,
            'category'=>category::collection($this->category()->get())

        ];
    }
}
