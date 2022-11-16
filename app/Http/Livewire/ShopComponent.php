<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Models\Category;
use Cart;


class ShopComponent extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public $pagesize, $sorting;

    public function mount() {
        $this->sorting = "default";
        $this->pagesize = 12;
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
            $products = Product::select('*')->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        } elseif($this->sorting == 'price') {
            $products = Product::select('*')->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        } elseif($this->sorting == 'price-desc') {
            $products = Product::select('*')->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        } else{
            $products = Product::select('*')->orderBy('id', 'DESC')->paginate($this->pagesize);
        }

        $categories = Category::all();

        return view('livewire.shop-component', ['products' => $products, 'categories' => $categories])->layout('layouts.base');
    }
}
