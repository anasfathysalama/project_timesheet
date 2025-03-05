<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'status' => $this->status?->resource(),
            'attributes' => $this->whenLoaded(
                'attributeValues',
                fn() => $this->manipulateAttributes($this->attributeValues)
            ),
            'users' => $this->whenLoaded('users', fn() => UserResource::collection($this->users)),
        ];
    }

    private function manipulateAttributes($attributes)
    {
        return $attributes->map(fn($attribute) => [
            'id' => $attribute->attribute->id,
            'name' => $attribute->attribute->name,
            'type' => $attribute->attribute->type,
            'value' => $attribute->value,
        ]);
    }
}
