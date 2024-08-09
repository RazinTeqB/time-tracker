<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\ProjectForm;

class Show extends Component
{
    public ProjectForm $form;

    public function mount(Project $project)
    {
        $this->form->setProjectModel($project);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.project.show', ['project' => $this->form->projectModel]);
    }
}
