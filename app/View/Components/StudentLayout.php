<?php

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class StudentLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $auth = Auth::user();
        return view('layouts.student',compact('auth'));
    }
}
