<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventCategory;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::all(); // Récupérer tous les événements
        
        return view('Events.index', compact('events')); // Retourner la vue avec les événements
    }
   public function create(){
    $categories = EventCategory::all();
    $users = User::all();
    return view ('Events.create',compact("categories","users"));
}

    public function store(Request $request)
    {
        // Validation des données d'entrée
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'prix' => 'required',
            'description' => 'required|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:event_categories,id',
            'organisateur_id' => 'required|exists:users,id',
        ]);

        // Création de l'événement
        $event = new Event();
        $event->title = $validatedData['title'];
        $event->prix = $validatedData['prix'];
        $event->description = $validatedData['description'];
        $event->date_start = $validatedData['date_start'];
        $event->date_end = $validatedData['date_end'];
        $event->location = $validatedData['location'];
        $event->organisateur_id = auth()->id(); // Organisateur est l'utilisateur connecté
        $event->category_id = $validatedData['category_id'];
        $event->save();

        return redirect()->route('Events.index')->with(['message' => 'Événement créé avec succès!', 'event' => $event], 201);
    }

// Annuler (supprimer) un événement
public function destroy($id)
{
    // Récupérer l'événement
    $event = Event::findOrFail($id);

    

    // Suppression de l'événement
    $event->delete();

    return redirect()->route('Events.index')->with(['message' => 'Événement annulé avec succès!'], 200);
}

public function edit($id)
{
    $event = Event::findOrFail($id); // Récupérer tous les événements
    $categories= EventCategory::all();
    $users=User::all();
    return view('Events.edit', compact('event','categories','users')); // Retourner la vue avec les événements
}
// Modifier un événement existant
public function update(Request $request, $id)
{
    // Validation des données d'entrée
    $validatedData = $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'prix' => 'sometimes|required',
        'description' => 'sometimes|required|string',
        'date_start' => 'sometimes|required|date',
        'date_end' => 'sometimes|required|date|after_or_equal:date_start',
        'location' => 'sometimes|required|string|max:255',
        'category_id' => 'sometimes|required|exists:event_categories,id',
        'organisateur_id' => 'required|exists:users,id',
    ]);

    // Récupérer l'événement
    $event = Event::findOrFail($id);

    // Vérifier si l'utilisateur connecté est l'organisateur
    

    // Mise à jour de l'événement
    $event->update($validatedData);

    return redirect()->route('Events.index')->with(['message' => 'Événement modifié avec succès!', 'event' => $event], 200);
}


}
