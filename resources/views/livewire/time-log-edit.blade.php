<x-modal name="EditLogModal" :show="true" slotWrapperClass="!overflow-visible">
    <form wire:submit="handleSubmit">
        <!-- Modal body -->
        <div class="p-4 md:p-5 space-y-4">
            <div class="mb-5">
                <x-input-label for="title" class="mb-2">Title</x-input-label>
                <x-text-input wire:model="form.title" type="text" id="title" class="w-full"
                    name="title"
                    placeholder="Write log title here..." required />
                <div>
                    @error('form.title') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-5">
                <x-input-label for="description" class="mb-2">Description</x-input-label>
                <textarea wire:model="form.description" id="description"
                    name="description"
                    class='w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'
                    placeholder="Write log description here..."></textarea>
                <div>
                    @error('form.description') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-5">
                <x-input-label for="started_at" class="mb-2">Started At</x-input-label>
                <x-text-input wire:model="form.started_at" name="started_at" type="datetime-local" id="started_at" class="w-full" :value="$form->started_at" step="1" />
                <div>
                    @error('form.started_at') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            @isset($form->ended_at)
                <div class="mb-5">
                    <x-input-label for="ended_At" class="mb-2">Ended At</x-input-label>
                    <x-text-input wire:model="form.ended_at" name="ended_at" type="datetime-local" id="ended_at" class="w-full" :value="$form->ended_at" step="1" />
                    <div>
                        @error('form.ended_at') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
            @endisset
            <livewire:tag-input-new
                class="border border-green-600"
                :defaultValue="$form->tags"
                @input.window="form.tags = $event.detail"
            />
        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
            <x-primary-button>Update</x-primary-button>

            <x-secondary-button class="ml-4"
                wire:click="$dispatchTo('time-log-list','close-log-edit')">Cancel</x-secondary-button>
        </div>
    </form>
</x-modal>
