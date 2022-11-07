<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductDetail extends Component
{
    public $slug;

    public function mount($slug) {
        $this->slug = $slug;
    }

    public function render()
    {   
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->take(4)->get();
        $related_products = Product::inRandomOrder()->where('category_id', $product->category_id)->get();
        return view('livewire.product-detail', ['product' => $product, 'popular_products' => $popular_products, 'related_products' => $related_products])->layout('layouts.base');
    }
}
