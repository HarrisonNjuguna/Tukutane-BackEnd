<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // The method to store an event
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'price' => 'required|numeric',
            'rating' => 'required|numeric',
            'image' => 'required|string',
        ]);

        // Create a new event
        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'date' => $request->date,
            'location' => $request->location,
            'price' => $request->price,
            'rating' => $request->rating,
            'image' => $request->image,
            'user_id' => Auth::id(), // Link event to the authenticated user
        ]);

        // Return a success message with the event data
        return response()->json([
            'message' => 'Event created successfully',
            'event' => $event,
        ]);
    }
}
