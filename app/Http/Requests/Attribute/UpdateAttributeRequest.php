<?php

namespace App\Http\Requests\Attribute;

use App\Enums\AttributeTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', AttributeTypeEnum::valid()],
        ];
    }
}
