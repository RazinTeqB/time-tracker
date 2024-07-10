<x-modal name="EditLogModal" :show="true">
    <form wire:submit="handleSubmit">
        <!-- Modal body -->
        <div class="p-4 md:p-5 space-y-4">
            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Log
                    Title</label>
                <x-text-input wire:model="form.title" type="text" id="title" class="w-full"
                    placeholder="Write log title here..." required />
                <div>
                    @error('form.title') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-5">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea wire:model="form.description" id="description"
                    class='w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'
                    placeholder="Write log description here..."></textarea>
                <div>
                    @error('form.description') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Log
                    Started At</label>
                <x-text-input disabled type="text" id="started_at" class="w-full opacity-75 cursor-not-allowed" required :value="$form->started_at"/>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
            <x-primary-button>Update</x-primary-button>

            <x-secondary-button class="ml-4"
                wire:click="$dispatchTo('time-log-list','close-log-edit')">Cancel</x-secondary-button>
        </div>
    </form>
</x-modal>
