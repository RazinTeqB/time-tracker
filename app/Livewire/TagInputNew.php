<?php

namespace App\Livewire;

use App\Models\Tag;
use App\DTO\TagDtoData;
use Livewire\Component;
use Illuminate\Support\Collection;

class TagInputNew extends Component
{
    /**
     * For root element only
     */
    public Collection $htmlAttributes;

    /**
     * @var Collection<TagDtoData>
     */
    public $tags;

    public ?array $defaultValue = [];

    public function mount(string $class = '', ?array $defaultValue = [])
    {
        $this->defaultValue = $defaultValue;
        $this->htmlAttributes = new Collection([
            'class' => $class,
        ]);

        $this->tags = collect(TagDtoData::collect(Tag::all()->toArray()));
    }

    public function render()
    {
        return view('livewire.tag-input-new');
    }
}
