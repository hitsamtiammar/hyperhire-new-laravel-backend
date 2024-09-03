<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */



    public function toArray(Request $request): array
    {
        $depth = $this->depth ?: 1;

        $mapped_children = $this->children->map(function ($child) use ($depth) {
            $child->depth = $depth + 1;
            return $child;
        });
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent' => isset($this->parentData) ? $this->parentData->name : null,
            'children' => self::collection($mapped_children),
            'depth' => $depth
        ];
    }
}
