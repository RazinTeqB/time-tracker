<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Index extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $projects = Project::paginate();

        return view('livewire.project.index', compact('projects'))
            ->with('i', $this->getPage() * $projects->perPage());
    }

    public function delete(Project $project)
    {
        $project->delete();

        return $this->redirectRoute('projects.index', navigate: true);
    }
}
