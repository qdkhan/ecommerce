<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Models\Category;
use Cart;

class CategoryComponent extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public $pagesize, $sorting, $category_slug;

    public function mount($category_slug) {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->category_slug = $category_slug;
    }

    public function store($product_id, $product_name, $product_price) {
        Cart::add($product_id, $product_name, 1, $product_price)->associate(\App\Models\Product::class);
        return redirect()->route('product.carts')->with('success_message', 'Item Added In The Cart');
    }

    public function saveData($a) {
        return $a;
    }

    public function render()
    {
        $category = Category::where('slug', $this->category_slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        if($this->sorting == 'date'){
            $products = Product::select('*')->where('category_id', $category_id)->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        } elseif($this->sorting == 'price') {
            $products = Product::select('*')->where('category_id', $category_id)->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        } elseif($this->sorting == 'price-desc') {
            $products = Product::select('*')->where('category_id', $category_id)->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        } else{
            $products = Product::select('*')->where('category_id', $category_id)->orderBy('id', 'DESC')->paginate($this->pagesize);
        }

        $categories = Category::all();

        return view('livewire.category-component', ['products' => $products, 'categories' => $categories, 'category_name' => $category_name])->layout('layouts.base');
    }
}

