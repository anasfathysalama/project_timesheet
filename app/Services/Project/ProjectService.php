<?php

namespace App\Services\Project;

use App\Models\Project;

class ProjectService
{
    private array $data;
    private ?Project $project;

    public function __construct(array $data, ?Project $project = null)
    {
        $this->data = $data;
        $this->project = $project;
    }

    public static function make(array $data, ?Project $project = null): static
    {
        return new self($data, $project);
    }

    public function createOrUpdate(): Project
    {
        $this->project ? $this->update() : $this->create();

        $this->setProjectDynamicAttributes()->assignUser();

        return $this->project->load(['attributeValues.attribute', 'users']);
    }

    private function update(): void
    {
        if (!empty($this->data['attributes'])) {
            $this->project->attributeValues()->delete();
        }

        $this->project->update($this->data);

        $this->project->refresh();
    }

    private function create(): void
    {
        $this->project = Project::create($this->data);
    }

    private function setProjectDynamicAttributes(): static
    {
        if (!empty($this->data['attributes'])) {
            $this->project->attributeValues()->createMany($this->data['attributes']);
        }

        return $this;
    }

    private function assignUser(): static
    {
        $this->project->users()->syncWithoutDetaching(auth()->user()->id);

        return $this;
    }
}
