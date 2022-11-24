<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use App\Models\Category;
use Cart;


class SearchComponent extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public $pagesize, $sorting, $search, $product_cat, $product_cat_id;

    public function mount() {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->fill(request()->only('search', 'product_cat', 'product_cat_id'));
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

            $products = Product::select('*')
                                ->where('name', 'like', '%'.$this->search.'%')
                                ->where('category_id', 'like', '%'.$this->product_cat_id.'%')
                                ->orderBy('created_at', 'DESC')
                                ->paginate($this->pagesize);

        } elseif($this->sorting == 'price') {

            $products = Product::select('*')
                                ->where('name', 'like', '%'.$this->search.'%')
                                ->where('category_id', 'like', '%'.$this->product_cat_id.'%')
                                ->orderBy('regular_price', 'ASC')
                                ->paginate($this->pagesize);

        } elseif($this->sorting == 'price-desc') {

            $products = Product::select('*')
                                ->where('name', 'like', '%'.$this->search.'%')
                                ->where('category_id', 'like', '%'.$this->product_cat_id.'%')
                                ->orderBy('regular_price', 'DESC')
                                ->paginate($this->pagesize);
        } else{

            $products = Product::select('*')
                                ->where('name', 'like', '%'.$this->search.'%')
                                ->where('category_id', 'like', '%'.$this->product_cat_id.'%')
                                ->orderBy('id', 'DESC')
                                ->paginate($this->pagesize);
        }

        $categories = Category::all();

        return view('livewire.search-component', ['products' => $products, 'categories' => $categories])->layout('layouts.base');
    }
}
