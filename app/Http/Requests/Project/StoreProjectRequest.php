<?php

namespace App\Http\Requests\Project;

use App\Enums\AttributeTypeEnum;
use App\Enums\ProjectStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', ProjectStatusEnum::valid()],
            'attributes' => ['nullable', 'array'],
            'attributes.*.attribute_id' => ['required', 'integer', 'exists:attributes,id'],
            'attributes.*.value' => ['required', 'string'],
        ];
    }
}
