<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionFormRequest;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{

    public function index()
    {
        return view('admin.options.index', [
            'options' => Option::paginate(25),
        ]);
    }


    public function create()
    {
        $option = new Option();

        return view('admin.options.form', [
            'option' => $option,
        ]);
    }

    public function store(OptionFormRequest $request)
    {
        $Option = Option::create($request->validated());

        return to_route('admin.option.index')->with('success', 'L\'option à bien été enregistrer!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        return view('admin.options.form', [
            'option' => $option,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionFormRequest $request, Option $option)
    {
        $option->update($request->validated());

        return to_route('admin.option.index')->with('success', 'L\'option à bien été modifié!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return to_route('admin.option.index')->with('success', 'L\'option à bien été supprimé!');
    }
}
