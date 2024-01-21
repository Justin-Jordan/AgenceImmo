<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    public function index()
    {
        return view('admin.properties.index', [
            'properties' => Property::orderBy('created_at', 'desc')->paginate(25),
        ]);
    }


    public function create()
    {
        $property = new Property();

        $property->fill([
            'surface' => 40,
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' => 0,
            'city' => 'Monpellier',
            'postal_code' => 34000,
            'is_sold' => false
        ]);

        return view('admin.properties.form', [
            'property' => $property,
        ]);
    }

    public function store(PropertyFormRequest $request)
    {
        $property = Property::create($request->validated());

        return to_route('admin.property.index')->with('success', 'Le bien à bien été enregistrer!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('admin.properties.form', [
            'property' => $property,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->update($request->validated());

        return to_route('admin.property.index')->with('success', 'Le bien à bien été modifié!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return to_route('admin.property.index')->with('success', 'Le bien à bien été supprimé!');
    }
}
