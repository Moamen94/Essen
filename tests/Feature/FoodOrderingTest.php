<?php

namespace Tests\Feature;

use App\Mail\OrderPlaced;
use App\Models\FoodItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FoodOrderingTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_menu(): void
    {
        $items = FoodItem::factory()->count(2)->create();

        $response = $this->get(route('food.index'));

        $response->assertOk()->assertSee($items->first()->name);
    }

    public function test_user_can_register_and_is_redirected_to_dashboard(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated('web');
    }

    public function test_user_can_add_items_to_cart_and_checkout(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $item = FoodItem::factory()->create(['price' => 10.00]);

        $this->actingAs($user)
            ->post(route('cart.store'), [
                'food_item_id' => $item->id,
                'quantity' => 2,
            ])
            ->assertRedirect(route('cart.index'));

        $this->actingAs($user)
            ->post(route('orders.store'))
            ->assertRedirect(route('orders.index'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'total_price' => 20.00,
        ]);

        Mail::assertSent(OrderPlaced::class, function (OrderPlaced $mail) use ($user) {
            return $mail->hasTo($user->email) && $mail->order->items->count() === 1;
        });

        $this->assertDatabaseCount('cart_items', 0);
    }
}
