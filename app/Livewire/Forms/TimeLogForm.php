<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\TimeLog;
use Livewire\Attributes\{Locked, Validate};

class TimeLogForm extends Form
{
    #[Locked]
    public int $id;

    #[Validate(rule: 'required')]
    public string $title;

    public ?string $description;

    public string $started_at;

    public function setTimeLog(TimeLog $timeLog)
    {
        $this->id = $timeLog->id;
        $this->title = $timeLog->title;
        $this->description = $timeLog->description;
        $this->started_at = $timeLog->started_at;
    }
}
