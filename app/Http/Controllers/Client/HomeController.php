<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Logic for homepage
        return view('homepage');
    }

    public function catalog(Request $request)
    {
        $brand = $request->input('brand');
        $price_min = $request->input('price_min');
        $price_max = $request->input('price_max');
        $status = $request->input('status');

        // Logic for filtering cars based on brand, price, and status
        // Example: $cars = Car::where('brand', $brand)
        //             ->where('price', '>=', $price_min)
        //             ->where('price', '<=', $price_max)
        //             ->where('status', $status)
        //             ->get();

        return view('catalog', compact('cars'));
    }

    public function show($id)
    {
        // Logic to display car details
        // Example: $car = Car::findOrFail($id);

        return view('car.show', compact('car'));
    }
}