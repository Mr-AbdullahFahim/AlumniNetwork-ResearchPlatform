<?php

namespace App\View\Components;
use App\Models\Job;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JobCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $job;
    
    public function __construct(Job $job)
    {
        $this->job=$job;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job-card');
    }
}
