<?php

namespace App\Http\Requests\Timesheet;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimesheetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'task_name' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable', 'date', 'date_format:Y-m-d'],
            'hours' => ['nullable', 'integer'],
            'project_id' => ['nullable', 'integer', 'exists:projects,id'],
        ];
    }
}
