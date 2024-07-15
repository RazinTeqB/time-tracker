<?php

namespace App\DTO;

use Livewire\Wireable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Concerns\WireableData;

class TagDtoData extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public int $id,
        public string $name,
        public ?string $color,
        public string $created_at,
        public ?string $updated_at,
    ) {}
}
