<?php

namespace App\Http\Requests\Attribute;

use App\Enums\AttributeTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', AttributeTypeEnum::valid()],
        ];
    }
}
