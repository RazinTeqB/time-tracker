<div class="{{ collect([$htmlAttributes->get('class'), 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full py-2 px-3 relative'])->filter()->implode(' ') }}"
    x-on:selected-tag-update="$dispatch('input', $event.detail)" x-data="initData">
    <template x-if="!selectedTags || selectedTags.length == 0">
        <div class="flex items-center gap-2" x-on:click="showDialog = !showDialog">
            <x-phosphor-plus class="w-5 cursor-pointer" />
            <span>{{ $htmlAttributes->get('label') ?? 'Add Tag' }}</span>
        </div>
    </template>
    <template x-if="selectedTags.length > 0">
        <div class="flex items-center gap-2">
            <x-phosphor-plus-circle
                class="dark:text-white dark:hover:bg-slate-300 dark:hover:text-black min-w-5 w-5 cursor-pointer rounded-full text-black hover:bg-gray-900 hover:text-white"
                x-on:click="showDialog = !showDialog" />
            <div class="mt-1 flex max-h-16 flex-wrap gap-x-1 gap-y-3 overflow-y-auto">
                <template x-for="(sTag, index) in selectedTags" :key="sTag.id">
                    <span
                        class="dark:bg-blue-900 dark:text-blue-300 me-2 inline-block cursor-pointer rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                        role="button" :style="sTag.color ? `background-color: ${sTag.color} !important;` : ''"
                        x-on:click="toggleTag(sTag.id)" x-text="sTag.name"></span>
                </template>
            </div>
        </div>
    </template>

    <div class="dark:bg-dark-600 dark:border-0 absolute left-0 top-full max-w-[60%] rounded border border-gray-200 bg-white px-3 py-4 shadow"
        x-cloak x-show="showDialog === true" x-transition x-on:click.outside="showDialog = false">
        <div class="relative">
            <x-text-input class="w-full !rounded-full px-2 py-1 pl-8 text-sm" id="search" name="title"
                type="text" x-model="search" placeholder="Search" x-on:keyup.debounce.200ms="updateSearch" />
            <x-phosphor-magnifying-glass class="absolute inset-y-0 left-0 my-auto ml-2 inline-block w-5" />
        </div>
        <template x-if="selectedTags.length > 0">
            <div>
                <div class="mt-3 flex gap-2 font-bold">
                    <span x-text="selectedTags.length"></span>
                    <span>Selected Tag </span>
                    <span class="ml-1 cursor-pointer text-blue-500 underline underline-offset-2" role="button"
                        x-on:click="resetAllSelected">Clear</span>
                </div>
                <div class="mt-1 flex max-h-40 flex-wrap gap-x-1 gap-y-3 overflow-y-auto">
                    <template x-for="(sTag, index) in selectedTags" :key="sTag.id">
                        <span
                            class="dark:bg-blue-900 dark:text-blue-300 me-2 inline-block cursor-pointer rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                            role="button" :style="sTag.color ? `background-color: ${sTag.color} !important;` : ''"
                            x-on:click="toggleTag(sTag.id)" x-text="sTag.name"></span>
                    </template>
                </div>
            </div>
        </template>

        <div class="mt-3 font-bold">Global</div>
        <div class="mt-1 flex max-h-40 flex-wrap gap-x-1 gap-y-3 overflow-y-auto">
            <template x-for="(fTag, index) in filteredTags" :key="fTag.id">
                <span
                    class="dark:bg-blue-900 dark:text-blue-300 me-2 inline-block cursor-pointer rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                    role="button" :style="fTag.color ? `background-color: ${fTag.color} !important;` : ''"
                    x-on:click="toggleTag(fTag.id)" x-text="fTag.name"></span>
            </template>
        </div>
    </div>
</div>


@script
    <script type="text/javascript">
        Alpine.data('initData', () => {
            return {
                showDialog: true,
                search: '',
                tags: $wire.tags,
                filteredTags: $wire.tags,
                defaultValue: $wire.defaultValue,
                selectedTags: [],
                init() {
                    const defaultVal = Object.values(this.defaultValue)
                    if (defaultVal && defaultVal?.length > 0) {
                        this.selectedTags = this.tags.filter((ogTag) => defaultVal.includes(ogTag.id));
                    }
                    this.updateSearch()
                },
                toggleTag: function(tagId) {
                    const existingTagObject = this.selectedTags.findIndex((fTag) => {
                        return fTag.id === tagId
                    })
                    if (existingTagObject > -1) {
                        this.selectedTags.splice(existingTagObject, 1)
                    } else {
                        const tagObject = this.filteredTags.find((fTag) => {
                            return fTag.id === tagId
                        })
                        this.selectedTags.push(tagObject)
                        this.search = ''
                    }
                    this.updateSearch()
                    $wire.$dispatch('selected-tag-update', this.selectedTags.map((sTag) => sTag.id));
                },
                resetAllSelected: function() {
                    this.selectedTags = []
                    this.updateSearch()
                    $wire.$dispatch('selected-tag-update', []);
                },
                updateSearch: function() {
                    const searchTerm = String(this.search).toLowerCase();
                    if (!searchTerm) {
                        this.filteredTags = this.tags;
                    }
                    let selectedTagIds = [];
                    if (this.selectedTags && this.selectedTags?.length > 0) {
                        selectedTagIds = this.selectedTags.map((tag) => tag.id)
                    }

                    this.filteredTags = this.tags.filter((ogTag) => {
                        let filterOutAlreadySelected = true;

                        if (selectedTagIds.length > 0) {
                            filterOutAlreadySelected = !selectedTagIds.includes(ogTag.id);
                        }

                        if (searchTerm) {
                            return String(ogTag.name).toLowerCase().includes(searchTerm) !== false &&
                                filterOutAlreadySelected;
                        }

                        return filterOutAlreadySelected;
                    })
                }
            }
        })
    </script>
@endscript
