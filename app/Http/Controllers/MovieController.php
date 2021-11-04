<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie as Movie;

class MovieController extends Controller
{
	public function destroy($id){
		$movie = Movie::find($id);
		$movie->delete();
		return redirect()->back();
	}

	public function show(Request $recuest){
		$movies = Movie::where('name','like','%'.$request->name.'%')->get();
		//busca el nombre exactamente igual a la variable
		$movies = Movie::where('name','=',$request->name)->get();
		//creados despues de una fecha
		$movies = Movie::where('created_at','>',$date)->get();
		//creados antes de una fecha
		$movies = Movie::where('created_at','<',$date)->get();
		//creados despues de una fecha y nombre similar
		$movies = Movie::where('created_at','>',$date)->where('name','=',$name)->get();
		//similares a varios nombres
		$movies = Movie::wherewhere('name','=',$name_1)->orWhere('name','=',$name_2)->get();
		return \view::make('movies/list',compact('movies'));
	}

	public function update($id, Request $request){
		$movie = Movie::find($id);
		$movie->name = $request->name;
		$movie->description = $request->description;
	    $movie->save();
	    return redirect('movie');
	}

	public function edit($id){
		$movie = Movie::find($id);
		return \View::make('movies/update', compact('movie'));
	}

	public function index(){
		$movies = Movie::all();
		return \View::make('movies/list',compact('movies'));
	}

	public function create(){
		return \View::make('movies/new');
	}

	public function store(Request $request){
	    $movie = new Movie;
	    $movie->name = $request->name;
	    $movie->description = $request->description;
	    $movie->save();
	    return redirect('movie');		
	}

	/*public function store2(Request $recuest){
		$movie = new Movie;
		$movie->create($request->all());
		return redirect('movie');
	}*/
}
