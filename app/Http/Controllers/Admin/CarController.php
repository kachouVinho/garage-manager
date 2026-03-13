<?php

namespace App\\Http\\Controllers\\Admin;

use Illuminate\\Http\\Request;
use App\\Models\\Car;
use Illuminate\\Support\\Facades\\Storage;

class CarController extends Controller
{
    public function dashboard() {
        // List cars for the dashboard
        $cars = Car::all();
        return view('admin.cars.dashboard', compact('cars'));
    }

    public function create() {
        // Show form to create a new car
        return view('admin.cars.create');
    }

    public function store(Request $request) {
        // Validate and store the new car
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|nullable|max:1999'
        ]);

        $car = new Car;
        $car->name = $request->name;

        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/cars', $fileNameToStore);
            $car->image = $fileNameToStore;
        }

        $car->save();

        return redirect()->route('admin.cars.dashboard')->with('success', 'Car created successfully.');
    }

    public function edit($id) {
        // Show form to edit the car
        $car = Car::findOrFail($id);
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, $id) {
        // Validate and update the car
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|nullable|max:1999'
        ]);

        $car = Car::findOrFail($id);
        $car->name = $request->name;

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($car->image !== 'default.jpg') {
                Storage::delete('public/cars/' . $car->image);
            }

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/cars', $fileNameToStore);
            $car->image = $fileNameToStore;
        }

        $car->save();

        return redirect()->route('admin.cars.dashboard')->with('success', 'Car updated successfully.');
    }

    public function destroy($id) {
        // Delete the car
        $car = Car::findOrFail($id);
        if ($car->image !== 'default.jpg') {
            Storage::delete('public/cars/' . $car->image);
        }
        $car->delete();
        return redirect()->route('admin.cars.dashboard')->with('success', 'Car deleted successfully.');
    }
}
