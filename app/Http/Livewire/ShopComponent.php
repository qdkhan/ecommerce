<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public function store($product_id, $product_name, $product_price) {
        Cart::add($product_id, $product_name, 1, $product_price)->associate(\App\Models\Product::class);
        return redirect()->route('product.carts')->with('success_message', 'Item Added In The Cart');
    }

    public function saveData($a) {
        return $a;
    }

    public function render()
    {
        $products = Product::select('*')->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.shop-component', ['products' => $products])->layout('layouts.base');
    }
}
