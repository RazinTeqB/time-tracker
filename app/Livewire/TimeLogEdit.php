<?php

namespace App\Livewire;

use App\Models\TimeLog;
use Livewire\Component;
use Illuminate\Support\Arr;
use App\Livewire\Forms\TimeLogForm;

class TimeLogEdit extends Component
{
    public TimeLogForm $form;

    public function mount(?TimeLog $timeLog)
    {
        $this->form->setTimeLog($timeLog);
    }

    public function render()
    {
        return view('livewire.time-log-edit');
    }

    public function handleSubmit()
    {
        $this->validate();

        $data = $this->form->all();
        if ($this->form->started_at && $this->form->ended_at) {
            $data['duration'] = TimeLog::calculateDuration($this->form->started_at, $this->form->ended_at);
        }
        $timeLog = TimeLog::find($data['id']);
        $timeLog->update(Arr::except($data, 'id'));

        $this->dispatch('close-log-edit')->to(TimeLogList::class);
    }
}
