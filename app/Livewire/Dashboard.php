<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\{TimeLog, User};

class Dashboard extends Component
{
    public ?TimeLog $activeTimeLog;

    public function mount()
    {
        /** @var User $user */
        $user = auth()->user();
        $this->activeTimeLog = $user->activeTimeLog;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function startTimer()
    {
        /** @var User $user */
        $user = auth()->user();

        $timeLog = $user->timeLogs()->create();
        $timeLog->started_at = new Carbon();
        $timeLog->save();

        session(null)->flash('success', 'Timer Started');

        $this->redirect('/dashboard', true);
    }

    public function stopTimer()
    {
        $this->activeTimeLog->ended_at = new Carbon();
        $duration = $this->activeTimeLog->started_at->diffInSeconds($this->activeTimeLog->ended_at);
        $this->activeTimeLog->duration = $duration;
        $this->activeTimeLog->save();
        unset($this->activeTimeLog);

        session(null)->flash('success', 'Timer Stopped');

        $this->redirect('/dashboard', true);
    }
}
