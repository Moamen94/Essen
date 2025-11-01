<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart()->firstOrCreate();
        $cart->loadMissing('items.foodItem');

        $items = $cart->items;

        return view('cart.index', [
            'cart' => $cart,
            'items' => $items,
            'total' => $items->sum(fn (CartItem $item) => $item->subtotal()),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'food_item_id' => ['required', 'exists:food_items,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = Auth::user()->cart()->firstOrCreate();

        $item = $cart->items()->firstOrCreate(
            ['food_item_id' => $data['food_item_id']],
            ['quantity' => 0]
        );

        $item->quantity += $data['quantity'];
        $item->save();

        return redirect()->route('cart.index')->with('status', 'Item added to cart.');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $this->authorizeItem($cartItem);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cartItem->update($data);

        return redirect()->route('cart.index')->with('status', 'Cart updated.');
    }

    public function destroy(CartItem $cartItem): RedirectResponse
    {
        $this->authorizeItem($cartItem);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('status', 'Item removed.');
    }

    protected function authorizeItem(CartItem $cartItem): void
    {
        abort_unless($cartItem->cart->user_id === Auth::id(), 403);
    }
}
