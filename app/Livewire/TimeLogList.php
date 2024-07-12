<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use App\Models\{TimeLog, User};
use Livewire\{Component, WithPagination};

class TimeLogList extends Component
{
    use WithPagination;

    public ?TimeLog $editTimeLog = null;

    public function render()
    {
        /** @var User $user */
        $user = auth()->user();

        $userTimeLogs = $user->timeLogs()->latest()->with('tags')->paginate(10);

        return view('livewire.time-log-list', [
            'timeLogs' => $userTimeLogs,
        ]);
    }

    public function stopTimer(TimeLog $timeLog)
    {
        $this->dispatch('timer-stopped')->to(Dashboard::class);
        if ($timeLog->ended_at) {
            return;
        }
        $timeLog->ended_at = new Carbon();
        $duration = $timeLog->started_at->diffInSeconds($timeLog->ended_at);
        $timeLog->duration = $duration;
        $timeLog->save();

        $this->dispatch('session-flash', type: 'success', message: 'Timer Stopped.');
    }

    #[On('close-log-edit')]
    public function cancelEditLog()
    {
        $this->editTimeLog = null;
    }

    public function editLog(?TimeLog $timeLog)
    {
        $this->editTimeLog = $timeLog;
    }
}
