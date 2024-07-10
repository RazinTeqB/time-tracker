{{-- <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot> --}}

<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8">
        {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("You're logged in!") }}
            </div>
        </div> --}}

        <div class="flex justify-end">
            @if ($activeTimeLog)
                <x-secondary-button type="button" wire:click='stopTimer' class="mr-4">Stop Active</x-secondary-button>
            @endif
            <x-primary-button type="button" wire:click='startTimer' title="It will automatically stop current active time log.">Start New</x-primary-button>
        </div>

        <livewire:time-log-list />
    </div>
</div>
