<div
    class="{{ collect([$htmlAttributes->get('class'), 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full py-2 px-3 relative'])->filter()->implode(' ') }}"
    x-on:selected-tag-update="$dispatch('tag-update', $event.detail)"
    x-data="{
        showDialog: false,
    }" x-init="{}">
    @if (!($selectedTags) || count(($selectedTags)) === 0)
        <div class="flex items-center gap-2" x-on:click="showDialog = !showDialog">
            <x-phosphor-plus class="w-5 cursor-pointer" />
            <span>{{ $htmlAttributes->get('label') ?? 'Add Tag' }}</span>
        </div>
    @else
        <div class="flex items-center gap-2">
            <x-phosphor-plus-circle
                class="dark:text-white dark:hover:bg-slate-300 dark:hover:text-black min-w-5 w-5 cursor-pointer rounded-full text-black hover:bg-gray-900 hover:text-white"
                x-on:click="showDialog = !showDialog" />
            <div class="mt-1 flex max-h-16 flex-wrap gap-x-1 gap-y-3 overflow-y-auto">
                @foreach ($selectedTags as $sTag)
                    <span
                        class="dark:bg-blue-900 dark:text-blue-300 me-2 flex items-center gap-1.5 rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                        role="button" style="background-color: {{ $sTag->color }} !important;">{{ $sTag->name }}
                        <x-phosphor-x class="dark:text-white w-3 cursor-pointer rounded-full text-black" role="button"
                            wire:click="toggleTag({{ $sTag->id }})" /></span>
                @endforeach
            </div>
        </div>
    @endif

    <div class="dark:bg-dark-600 dark:border-0 absolute left-0 top-full max-w-[60%] rounded border border-gray-200 bg-white px-3 py-4 shadow z-50"
        x-cloak x-show="showDialog === true" x-transition
        x-on:click.outside="showDialog = false"
    >
        <div class="relative">
            <x-text-input class="w-full !rounded-full px-2 py-1 pl-8 text-sm" id="search" name="title"
                type="text" wire:model.live.debouce.150ms="search" placeholder="Search" />
            <x-phosphor-magnifying-glass class="absolute inset-y-0 left-0 my-auto ml-2 inline-block w-5" />
        </div>
        @if (count($selectedTags) > 0)
            <div class="mt-3 flex gap-2 font-bold">
                <span>{{ count($selectedTags) }}</span>
                <span>Selected Tag </span>
                <span class="ml-1 cursor-pointer text-blue-500 underline underline-offset-2" role="button"
                    wire:click="resetAllSelected">Clear</span>
            </div>
            <div class="mt-1 flex max-h-40 flex-wrap gap-x-1 gap-y-3 overflow-y-auto">
                @foreach ($selectedTags as $sTag)
                    <span
                        class="dark:bg-blue-900 dark:text-blue-300 me-2 flex items-center gap-1.5 rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                        role="button" style="background-color: {{ $sTag->color }} !important;">{{ $sTag->name }}
                        <x-phosphor-x class="dark:text-white w-3 cursor-pointer rounded-full text-black" role="button"
                            wire:click="toggleTag({{ $sTag->id }})" /></span>
                @endforeach
            </div>
        @endif

        <div class="mt-3 font-bold">Global</div>
        <div class="mt-1 flex max-h-40 flex-wrap gap-x-1 gap-y-3 overflow-y-auto">
            @foreach ($filteredTags as $fTag)
                <span
                    class="dark:bg-blue-900 dark:text-blue-300 me-2 inline-block cursor-pointer rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                    role="button" style="background-color: {{ $fTag->color }} !important;"
                    wire:click='toggleTag({{ $fTag->id }})'>{{ $fTag->name }}</span>
            @endforeach
        </div>
    </div>
</div>
