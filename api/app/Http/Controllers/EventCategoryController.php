<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of event categories.
     */
    public function index()
    {
        $categories = EventCategory::all();
        return view('EventCategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new event category.
     */
    public function create()
    {
        return view('EventCategory.form');
    }

    /**
     * Store a newly created event category in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        EventCategory::create($request->all());

        return redirect()->route('EventCategory.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified event category.
     */
    // public function show(EventCategory $eventCategory)
    // {
    //     return view('EventCategory.show', compact('eventCategory'));
    // }

    /**
     * Show the form for editing an existing event category.
     */
   
    public function edit($id)
{
    $category = EventCategory::findOrFail($id);
    return view('EventCategory.form', compact('category'));
}

    /**
     * Update the specified event category in the database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = EventCategory::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('EventCategory.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified event category from the database.
     */
    public function destroy($id)
    {
        // Récupérer l'événement
        EventCategory::findOrFail($id)->delete();

        return redirect()->route('EventCategory.index')->with('success', 'Category deleted successfully!');
    }
}
