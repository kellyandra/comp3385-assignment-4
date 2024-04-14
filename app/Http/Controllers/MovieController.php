<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Movie; 

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::all()->map(function ($movie) {
            $movie->poster_url = asset('storage/' . $movie->poster);
            return $movie;
        });

        return response()->json([
            'message' => 'Movies retrieved successfully',
            'movies' => $movies
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048' // Image must be less than 2MB
        ]);

        $filePath = null;

        if ($request->hasFile('poster')) {
            $image = $request->file('poster');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/posters', $fileName);
            $filePath = 'posters/' . $fileName; 

        $movie = new Movie(); // Create a new instance of Movie
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
       // $movie->poster = asset('storage/'.$filePath);
        if ($filePath) {
            $movie->poster = $filePath; // Save the file name to the 'poster' field
        }

        $movie->save(); // Save the movie to the database

        return response()->json([
            'message' => 'Movie created successfully',
            'movie' => $movie
        ], 201);
    }

}
}