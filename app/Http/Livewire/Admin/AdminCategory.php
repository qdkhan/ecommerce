<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class AdminCategory extends Component
{
    use WithPagination;

    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category', ['categories' => $categories])->layout('layouts.base');
    }
}
