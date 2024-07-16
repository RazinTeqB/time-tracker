<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Arr;
use App\Models\{Tag, TimeLog};
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
        /** @var TimeLog */
        $timeLog = TimeLog::find($data['id']);
        $timeLog->update(Arr::except($data, ['id', 'tags']));
        $tagIds = Arr::only($data, 'tags');
        $tags = [];
        if ($tagIds && count($tagIds) > 0) {
            $tags = Tag::query()->find($tagIds);
        }
        $timeLog->tags()->sync($tags);

        $this->dispatch('close-log-edit')->to(TimeLogList::class);
    }
}
