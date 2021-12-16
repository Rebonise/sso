<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AlertSuccess extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
            <div class="alert alert-success mt-4">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-2 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <label>{{ $slot }}</label>
                </div>
            </div>
        blade;
    }
}
