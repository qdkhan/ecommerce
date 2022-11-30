<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;

class AdminAddCategory extends Component
{
    public $name, $slug;

    public function generateSlug () { 
        $this->slug = Str::slug($this->name);
    }

    public function storeCategory() { 
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        // return redirect()->back()->with('success_message', 'Category Added Successfully');
        return redirect()->route('admin.category')->with('success_message', 'Category Added Successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-category')->layout('layouts.base');
    }
}
