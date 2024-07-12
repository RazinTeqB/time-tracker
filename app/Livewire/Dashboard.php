<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
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
        /** @var ?TimeLog */
        $activeTimeLog = $user->activeTimeLog;
        if ($activeTimeLog) {
            session(null)->flash('warning', 'Log [' . $activeTimeLog->title . '] has stopped.');
            $this->stopLogTimer($activeTimeLog);
        }

        $timeLog = $user->timeLogs()->create();
        $timeLog->title = fake()->name();
        $timeLog->started_at = new Carbon();
        $timeLog->save();

        session(null)->flash('success', 'New log created.');

        $this->redirect('/dashboard', true);
    }

    #[On('timer-stopped')]
    public function timerStopped()
    {
        $this->activeTimeLog = null;
    }

    public function stopTimer()
    {
        $this->stopLogTimer($this->activeTimeLog);
        unset($this->activeTimeLog);

        session(null)->flash('success', 'Timer Stopped');

        $this->redirect('/dashboard', true);
    }

    private function stopLogTimer(TimeLog $timeLog)
    {
        $timeLog->ended_at = new Carbon();
        $timeLog->duration = $timeLog->calculateDuration($timeLog->started_at, $timeLog->ended_at);
        $timeLog->save();

        return $timeLog;
    }
}
