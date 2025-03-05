<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;

class ProjectQuery extends Builder
{
    public function byName(?string $name): Builder
    {
        if (!$name) {
            return $this;
        }

        return $this->where('name', 'like', "%{$name}%");
    }

    public function byStatus(?string $status): Builder
    {
        if (!$status) {
            return $this;
        }

        return $this->where('status', $status);
    }

    public function byDynamicFilters(array $dynamicFilters = []): Builder
    {
        unset($dynamicFilters['status'], $dynamicFilters['name']);

        if (empty($dynamicFilters)) {
            return $this;
        }

        foreach ($dynamicFilters as $attribute => $value) {
            $this->whereHas(
                'attributeValues',
                fn($q) => $q->whereHas(
                    'attribute',
                    fn($attr) => $attr->where('name', $attribute)
                )->where('value', $value)
            );
        }

        return $this;
    }
}
