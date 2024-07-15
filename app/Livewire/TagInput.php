<?php

namespace App\Livewire;

use App\Models\Tag;
use App\DTO\TagDtoData;
use Livewire\Component;
use Illuminate\Support\Collection;

class TagInput extends Component
{
    /**
     * For root element only
     */
    public Collection $htmlAttributes;

    /**
     * @var Collection<TagDtoData>
     */
    public $tags;

    public $filteredTags;

    /**
     * @var Collection<TagDtoData>
     */
    public $selectedTags;

    public string $search = '';

    public function mount(string $class = '', ?array $defaultValue = [])
    {
        $this->htmlAttributes = new Collection([
            'class' => $class,
        ]);

        $this->tags = collect(TagDtoData::collect(Tag::all()->toArray()));
        $this->filteredTags = $this->tags;
        $this->resetAllSelected();

        if ($defaultValue && ! empty($defaultValue)) {
            $this->selectedTags = $this->tags->filter(fn (TagDtoData $tagDtoData) => in_array($tagDtoData->id, $defaultValue));
        }
    }

    public function render()
    {
        return view('livewire.tag-input');
    }

    public function updatedSearch()
    {
        $searchTerm = $this->search;

        if (empty($searchTerm)) {
            $this->filteredTags = $this->tags;
        }

        $selectedTagIds = [];
        if (is_countable($this->selectedTags) && count($this->selectedTags) > 0) {
            $selectedTagIds = $this->selectedTags->pluck('id')->toArray();
        }
        $this->filteredTags = $this->tags->filter(function ($tag) use ($searchTerm, $selectedTagIds) {
            $filterOutAlreadySelected = true;

            if (count($selectedTagIds) > 0) {
                $filterOutAlreadySelected = ! in_array($tag->id, $selectedTagIds);
            }

            return stripos($tag->name, $searchTerm) !== false && $filterOutAlreadySelected;
        });
    }

    public function toggleTag(int $tagId)
    {
        $existingTag = $this->selectedTags->search(fn (TagDtoData $tag) => $tag->id === $tagId);
        if ($existingTag !== false) {
            $this->selectedTags->forget($existingTag);
        } else {
            $tag = $this->tags->first(fn (TagDtoData $tag) => $tag->id === $tagId);
            $this->selectedTags->push($tag);
            $this->search = '';
        }
        $this->updatedSearch();
        $this->dispatch('selected-tag-update', $this->selectedTags->pluck('id'));
    }

    public function resetAllSelected()
    {
        $this->selectedTags = Collection::make();
        $this->dispatch('selected-tag-update', []);
    }
}
