<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->when($request->routeIs('products.show'),function(){
                    return $this->description;
            }),
            'image' => $this->image,
            'price' => $this->price,
            'view_count' => $this->view_count,
            'created_at' => $this->created_at->format('d/m/Y'),
            'category' =>  CategoryResource::make($this->whenLoaded('category')),
        ];
    }
}
