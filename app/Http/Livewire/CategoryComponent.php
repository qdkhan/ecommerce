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

    public $pagesize, $sorting, $category_id, $category_name;

    public function mount($category_id, $category_name) {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->category_id = $category_id;
        $this->category_name = $category_name;
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
        if($this->sorting == 'date'){
            $products = Product::select('*')->where('category_id', $this->category_id)->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        } elseif($this->sorting == 'price') {
            $products = Product::select('*')->where('category_id', $this->category_id)->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        } elseif($this->sorting == 'price-desc') {
            $products = Product::select('*')->where('category_id', $this->category_id)->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        } else{
            $products = Product::select('*')->where('category_id', $this->category_id)->orderBy('id', 'DESC')->paginate($this->pagesize);
        }
        $categories = Category::all();

        return view('livewire.category-component', ['products' => $products, 'categories' => $categories, 'category_name' => $this->category_name])->layout('layouts.base');
    }
}

