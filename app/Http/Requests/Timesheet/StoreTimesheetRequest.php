<?php

namespace App\Http\Requests\Timesheet;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimesheetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'task_name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'hours' => ['required', 'integer'],
            'project_id' => ['required', 'integer', 'exists:projects,id'],
        ];
    }
}
