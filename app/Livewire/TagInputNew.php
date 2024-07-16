<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Enum\TagColor;
use App\DTO\TagDtoData;
use Livewire\Component;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

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

    public array $colors = TagColor::ALL;

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

    public function createTag($data)
    {
        $validator = Validator::make(
            $data,
            ['name' => 'required', 'color' => 'required']
        );

        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->getMessageBag()->all()], 422);
        }

        try {
            $tag = Tag::create($validator->safe()->only(['name', 'color']));

            return new JsonResponse($tag->toArray());
        } catch (\Exception $e) {

            return new JsonResponse(['errors' => [$e->getMessage()]], 422);
        }
    }
}
