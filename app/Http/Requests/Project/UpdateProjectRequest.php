<?php

namespace App\Http\Requests\Project;

use App\Enums\AttributeTypeEnum;
use App\Enums\ProjectStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', ProjectStatusEnum::valid()],
            'attributes' => ['nullable', 'array'],
            'attributes.*.attribute_id' => ['required', 'integer', 'exists:attributes,id'],
            'attributes.*.value' => ['required', 'string'],
        ];
    }
}
