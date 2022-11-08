<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Cart;

class ProductDetail extends Component
{
    public $slug;

    public function mount($slug) {
        $this->slug = $slug;
    }

    public function store($product_id, $product_name, $product_price) {
        Cart::add($product_id, $product_name, 1, $product_price)->associate(\App\Models\Product::class);
        return redirect()->route('product.carts')->with('success_message', 'Item Added In The Cart');
    }

    public function render()
    {   
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->take(4)->get();
        $related_products = Product::inRandomOrder()->where('category_id', $product->category_id)->get();
        return view('livewire.product-detail', ['product' => $product, 'popular_products' => $popular_products, 'related_products' => $related_products])->layout('layouts.base');
    }
}
