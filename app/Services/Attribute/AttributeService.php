<?php

namespace App\Services\Attribute;

use App\Models\Attribute;

class AttributeService
{
    private array $data;
    private ?Attribute $attribute;

    public function __construct(array $data, ?Attribute $attribute = null)
    {
        $this->data = $data;
        $this->attribute = $attribute;
    }

    public static function make(array $data, ?Attribute $attribute = null): static
    {
        return new self($data, $attribute);
    }

    public function createOrUpdate(): Attribute
    {
        $this->attribute ? $this->update() : $this->create();

        return $this->attribute;
    }

    private function update(): void
    {
        $this->attribute->update($this->data);
    }

    private function create(): void
    {
        $this->attribute = Attribute::create($this->data);
    }
}
