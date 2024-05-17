<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetaHeader extends Component
{
    /**
     * Create a new component instance.
     */

    public $subtitle;

    public function __construct($subtitle)
    {
      $this->subtitle  = $subtitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meta-header');
    }
}
