<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Projects') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-700 dark:text-gray-400">
            <div class="w-full">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">{{ __('Projects') }}</h1>
                        <p class="mt-2 text-sm text-gray-700 dark:text-white">A list of all the {{ __('Projects') }}.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a type="button" wire:navigate href="{{ route('projects.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add new</a>
                    </div>
                </div>

                <div class="flow-root">
                    <div class="mt-8 overflow-x-auto">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <table class="w-full divide-y divide-gray-300 text-gray-500 dark:text-gray-400">
                                <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                    
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Name</th>

                                    <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Action</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($projects as $i => $project)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 dark:text-white" wire:key="{{ $project->id }}">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold">
                                            {{ ($projects->currentPage() - 1) * $projects->perPage() + $i + 1 }}
                                        </td>
                                        
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-white">{{ $project->name }}</td>

                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium">
                                            <a wire:navigate href="{{ route('projects.show', $project->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2 dark:text-white">{{ __('Show') }}</a>
                                            <a wire:navigate href="{{ route('projects.edit', $project->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>
                                            <button
                                                class="text-red-600 font-bold hover:text-red-900"
                                                type="button"
                                                wire:click="delete({{ $project->id }})"
                                                wire:confirm="Are you sure you want to delete?"
                                            >
                                                {{ __('Delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="mt-4 px-4">
                                {{ $projects->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>