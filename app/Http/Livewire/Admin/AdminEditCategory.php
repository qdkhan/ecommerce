<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;

class AdminEditCategory extends Component
{
    public $category_slug, $category_id, $name, $slug;
    public function mount($category_slug) {
        $this->category_slug = $category_slug;
        $category = Category::where('slug', $category_slug)->first();
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }
    public function generateSlug () { 
        $this->slug = Str::slug($this->name);
    }
    public function updateCategory() {
        $category = Category::find($this->category_id);
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        return redirect()->route('admin.category')->with('success_message', 'Category Updated Successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-category')->layout('layouts.base');
    }
}
