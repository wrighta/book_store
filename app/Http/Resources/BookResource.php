<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'title' =>$this->title,
            'description' =>$this->description,
            'author' => $this->author,
            'likes' => $this->likes,
            'book_image' => $this->book_image,
            'publisher_id' =>$this->publisher->id,
            'publisher_name' =>$this->publisher->name,
            'publisher_address' => $this->publisher->address
        ];
    }
}
