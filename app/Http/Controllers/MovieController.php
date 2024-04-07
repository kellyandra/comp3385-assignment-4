<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    //

    public function index (Request $request){
    $movies = Movie::all();
    return response( )->json([
        'message'=>'Movies retrieved Successfully',
        'movies'=>$movies]);
    }
public function store (Request $request) {
    $request->validate([
        'title'=>'required|string|max:255',
        'description'=>'required|string|max:1000',
        'poster'=> 'required|image|mimes:jpeg,png,jpg|max:2048'

    ]);
    $filePath = null;

    if($request ->hasFile('poster')){
        $image = $request ->file('poster');
        $fileName = time() . '.' .$image->getClientOriginalExtension();
        $image->storeAs('public/poster', $fileName);
        $filePath = 'posters/'.$fileName;
    }
    //save movie to database
    $movie=new Movie();
    $movie->title =$request->title; 
    $movie->description=$request->description;


    if($filePath){
        $movie->poster =$filePath;
    }
    $movie -> save();

    //success message
    return response ()->json([
        'mesasage' => 'Movie created successfully',
        'movie'=> $movie
    ],201);


}

}
