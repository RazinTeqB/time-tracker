<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\{TimeLog};
use Livewire\Attributes\{Locked, Validate};

class TimeLogForm extends Form
{
    #[Locked]
    public int $id;

    #[Validate(rule: 'required')]
    public string $title;

    public ?string $description;

    #[Validate(rule: 'required|date')]
    public string $started_at;

    #[Validate(rule: 'sometimes|nullable|date|after:started_at')]
    public ?string $ended_at = null;

    /**
     * @var array<int>
     */
    public array $tags = [];

    public function setTimeLog(TimeLog $timeLog)
    {
        $this->id = $timeLog->id;
        $this->title = $timeLog->title;
        $this->description = $timeLog->description;
        $this->started_at = $timeLog->started_at;
        $this->ended_at = $timeLog->ended_at;
        $this->tags = $timeLog->tags->pluck('id')->toArray();
    }
}
