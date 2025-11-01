<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.foodItem')->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function store(): RedirectResponse
    {
        $user = Auth::user();
        $cart = $user->cart()->with('items.foodItem')->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'Your cart is empty.');
        }

        $order = DB::transaction(function () use ($cart, $user) {
            $total = $cart->items->sum(fn (CartItem $item) => $item->subtotal());

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'status' => 'confirmed',
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'food_item_id' => $item->food_item_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->foodItem->price,
                    'subtotal' => $item->subtotal(),
                ]);
            }

            $cart->items()->delete();

            return $order->load('items.foodItem', 'user');
        });

        Mail::to($user->email)->send(new OrderPlaced($order));

        return redirect()->route('orders.index')->with('status', 'Order placed successfully.');
    }
}
