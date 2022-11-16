<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowId) {
        $product = Cart::get($rowId);
        $product->qty +=1;
        Cart::update($rowId, $product->qty);
    }

    public function decreaseQuantity($rowId) {
        $product = Cart::get($rowId);
        $product->qty -=1;
        Cart::update($rowId, $product->qty);
    }

    public function destroy($rowId) {
        cart::remove($rowId);
        return redirect()->back()->with('success_message', 'Item Deleted From Cart');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
