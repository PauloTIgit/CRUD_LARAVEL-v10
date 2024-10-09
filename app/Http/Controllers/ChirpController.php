<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class ChirpController extends Controller
{

   
    
    public function index()
    {
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get() // aqui estamos ordenando desendente mente y adicionalmente añadimos el with('user') para que sea mas optimo y evitemos el problema N+1
        ]);
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        // validacion
        
        // aqui guardamos la validacion en la variable $validate
        $validate = $request->validate([
            'message' => 'required|min:3|max:250'
        ]);
        // insertar en la base datos

        /*aqui estamos accediendo al usuario actual autenticado y
        accediendo a la relacion de chirps y se crea el registro.
        De igual forma se simplifico la forma de crear de la de abajo y
        asi no insertar el user_id, todo con la relacion que hicimos en el
        modelo de user*/
        $request->user()->chirps()->create($validate);

        // Chirp::create([
        //     'message' => $request->get('message'),
        //     'user_id' => auth()->id(),
        // ]);

        // session()->flash('status', 'Chirps creado satisfactoriamente'); mensaje flash

        return to_route('chirps.index')->with('status', 'Chirps creado satisfactoriamente');//con el metodo with tambien podemos mandar mensajes de sesion flash
    }

   
    public function show(Request $request)
    {
        // $chirps = 

        // $chirps = Chirp::find(1)->user()->where('user_id', '=', $request->id)->first;

        return view('chirps.show', [
            'chirps' => Chirp::with('user')->latest()->where('user_id', '=', $request->id)->get()
        ]);
    }

   
    public function edit(Chirp $chirp)
    {

        if (auth()->user()->id != $chirp->user_id) {
            abort(403);
        }

        return view('chirps.edit', [
            'chirp' => $chirp
        ]);
    }

   
    public function update(Request $request, Chirp $chirp)
    {

        if (auth()->user()->id != $chirp->user_id) {
            abort(403);
        }

        $validate = $request->validate([
            'message' => 'required|min:3|max:250'
        ]);

        $chirp->update($validate);

        return to_route('chirps.index')->with('status', 'Chirps actualizado satisfactoriamente');
        
    }

   
    public function destroy(Chirp $chirp)
    {
        $chirp->delete();

        return to_route('chirps.index')->with('status', 'Chirps Eliminado satisfactoriamente');
    }
}
