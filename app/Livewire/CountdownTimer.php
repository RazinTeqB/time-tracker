<?php

namespace App\Livewire;

use App\Models\TimeLog;
use Livewire\Component;

class CountdownTimer extends Component
{
    public $id;

    /** @var TimeLog */
    public $timeLog;

    public function mount($id, $timeLog)
    {
        $this->id = $id;
        $this->timeLog = $timeLog;
    }

    public function render()
    {
        return <<<'HTML'
            <div
                x-data="{
                    started_at: '{{ $timeLog->started_at }}',
                    ended_at: '{{ $timeLog->ended_at }}',
                    duration: '{{ $timeLog->duration }}',
                    startTime: new Date('{{ $timeLog->started_at }}').getTime(),
                    endTime: new Date('{{ $timeLog->ended_at }}').getTime(),
                    remainingTime: 0
                }"
                x-init="
                    if (duration && ended_at) {
                        $data.remainingTime = endTime - startTime;
                    } else {
                        setInterval(() => {
                            const now = new Date().getTime();
                            const remainingTime = now - startTime;
                            $data.remainingTime = remainingTime > 0 ? remainingTime : 0;
                        }, 1000);
                    }
                ">
                <div wire:ignore class="flex gap-3" key="{{ $id }}_TimeLogCountdown">
                    <div
                        key="{{ $id }}_days"
                        x-show="formatTime(remainingTime).days > 0"
                        class="flex flex-col gap-2 bg-white dark:bg-gray-800 p-2 rounded items-center justify-center text-black dark:text-white"
                    >
                        <span class="text-xs font-semibold">Days</span>
                        <span x-text="formatTime(remainingTime).days" class="text-lg font-bold"></span>
                    </div>
                    <div
                        key="{{ $id }}_hours"
                        class="flex flex-col gap-2 bg-white dark:bg-gray-800 p-2 rounded items-center justify-center text-black dark:text-white"
                    >
                        <span class="text-xs font-semibold">Hours</span>
                        <span x-text="formatTime(remainingTime).hours" class="text-lg font-bold"></span>
                    </div>
                    <div
                        key="{{ $id }}_minutes"
                        class="flex flex-col gap-2 bg-white dark:bg-gray-800 p-2 rounded items-center justify-center text-black dark:text-white"
                    >
                        <span class="text-xs font-semibold">Minutes</span>
                        <span x-text="formatTime(remainingTime).minutes"
                            class="text-lg font-bold"></span>
                    </div>
                    <div
                        key="{{ $id }}_seconds"
                        class="flex flex-col gap-2 bg-white dark:bg-gray-800 p-2 rounded items-center justify-center text-black dark:text-white"
                    >
                        <span class="text-xs font-semibold">Seconds</span>
                        <span x-text="formatTime(remainingTime).seconds"
                            class="text-lg font-bold"></span>
                    </div>
                </div>
            </div>
        HTML;
    }
}
