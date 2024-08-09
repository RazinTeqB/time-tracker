<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Project;

class ProjectForm extends Form
{
    public ?Project $projectModel;

    public $name = '';

    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function setProjectModel(Project $projectModel): void
    {
        $this->projectModel = $projectModel;

        $this->name = $this->projectModel->name;
    }

    public function store(): void
    {
        $this->projectModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->projectModel->update($this->validate());

        $this->reset();
    }
}
