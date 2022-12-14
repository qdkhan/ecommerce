<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class HeaderSearch extends Component
{
    public $search, $product_cat, $product_cat_id;

    public function mount() { 
        $this->product_cat = 'All Category';
        $this->fill(request()->only('search', 'product_cat', 'product_cat_id'));
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.header-search', ['categories' => $categories]);
    }
}
