<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\TimeLog;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class TimeLogList extends Component
{
    use WithPagination;

    public function render()
    {
        /** @var User $user */
        $user = auth()->user();

        $userTimeLogs = $user->timeLogs()->latest()->paginate(10);

        return view('livewire.time-log-list', [
            'timeLogs' => $userTimeLogs,
        ]);
    }

    public function stopTimer(TimeLog $timeLog)
    {
        if ($timeLog->ended_at) {
            return;
        }
        $timeLog->ended_at = new Carbon();
        $duration = $timeLog->started_at->diffInSeconds($timeLog->ended_at);
        $timeLog->duration = $duration;
        $timeLog->save();

        session(null)->flash('success', 'Timer Stopped.');

        return $this->redirectIntended('/dashboard', true);
    }
}
