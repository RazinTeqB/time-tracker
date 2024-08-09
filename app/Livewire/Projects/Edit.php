<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\ProjectForm;

class Edit extends Component
{
    public ProjectForm $form;

    public function mount(Project $project)
    {
        $this->form->setProjectModel($project);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('projects.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.project.edit');
    }
}
