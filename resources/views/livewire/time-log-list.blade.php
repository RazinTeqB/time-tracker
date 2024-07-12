<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Started At
                </th>
                <th scope="col" class="px-6 py-3">
                    Ended At
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Duration
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($timeLogs as $timeLog)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 @if (!$timeLog->duration) border-black border-bottom dark:border-white @endif"
                >
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $timeLog->title ?? '-' }}
                        @if ($timeLog->description)
                            <div class="block mt-2 max-w-lg text-wrap">{{ $timeLog->description }}</div>
                        @endif
                        @if ($timeLog->tags && count($timeLog->tags) > 0)
                            <div class="mt-2">
                                @foreach ($timeLog->tags as $tag)
                                    <span
                                        class="inline-block mt-2 bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                                        style="@if($tag->color) background-color: {{$tag->color}} !important; @endif"
                                    >{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </th>
                    <td class="px-6 py-4 text-nowrap">
                        {{ $timeLog->started_at ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-nowrap">
                        {{ $timeLog->ended_at ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <livewire:countdown-timer key="{{ $timeLog->id }}_duration_{{$timeLog->duration ?? 0}}" id="$timeLog->id" :timeLog="$timeLog">
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex gap-3 justify-end items-center">
                            @if (!$timeLog->duration)
                                <x-danger-button type="button" wire:click.prevent='stopTimer({{$timeLog}})'>Stop</x-danger-button>
                            @endif
                            <x-secondary-button type="button" wire:click.prevent="editLog({{$timeLog}})">Edit</x-secondary-button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">{{ $timeLogs->links() }}</td>
            </tr>
        </tfoot>
    </table>

    @if ($editTimeLog)
        <livewire:time-log-edit :timeLog="$editTimeLog"/>
    @endif
</div>

<script>
    function formatTime(time) {
        const days = Math.floor(time / (1000 * 60 * 60 * 24));
        const hours = Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((time % (1000 * 60)) / 1000);
        return {
            days,
            hours,
            minutes,
            seconds
        };
    }

    function getRemainingDuration(started_at, ended_at) {
        const start = new Date(started_at).getTime();
        const end = new Date(ended_at).getTime();

        return end - start;
    }
</script>
