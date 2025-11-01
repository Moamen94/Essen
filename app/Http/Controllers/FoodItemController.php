<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    public function index()
    {
        $foodItems = FoodItem::orderBy('name')->get();

        return view('food.index', compact('foodItems'));
    }

    public function show(FoodItem $foodItem)
    {
        return view('food.show', compact('foodItem'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'rating' => ['required', 'integer', 'between:0,5'],
        ]);

        FoodItem::create($validated);

        return redirect()->route('food.index')->with('status', 'Food item created successfully.');
    }
}
