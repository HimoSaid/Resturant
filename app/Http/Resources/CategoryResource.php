<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'summary' => $this->summary,
            'bounce' => $this->bounce,
            'parent_id' => $this->parent_id,
            'parent' => $this->when($this->parent_id, new CategoryResource($this->parent), null),

        ];
    }
}
