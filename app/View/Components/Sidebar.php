<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Sidebar extends Component
{   
    public function __construct(
        public LengthAwarePaginator $articles
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
