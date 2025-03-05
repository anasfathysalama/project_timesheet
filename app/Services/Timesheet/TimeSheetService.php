<?php

namespace App\Services\Timesheet;

use App\Models\Timesheet;

class TimeSheetService
{
    private array $data;
    private ?Timesheet $timesheet;

    public function __construct(array $data, ?Timesheet $timesheet = null)
    {
        $this->data = $data;
        $this->timesheet = $timesheet;
    }

    public static function make(array $data, ?Timesheet $timesheet = null): static
    {
        return new self($data, $timesheet);
    }

    public function createOrUpdate(): Timesheet
    {
        $this->timesheet ? $this->update() : $this->create();

        return $this->timesheet->load(['user', 'project']);
    }

    private function update(): void
    {
        $this->timesheet->update($this->data);
    }

    private function create(): void
    {
        $this->data = array_merge($this->data, ['user_id' => auth()->id()]);

        $this->timesheet = Timesheet::create($this->data);
    }
}
