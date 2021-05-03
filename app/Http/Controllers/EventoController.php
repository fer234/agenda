<?php

namespace App\Http\Controllers;
// llamamos a nuestro modelo eventos
use App\Models\Evento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('evento.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validamos los datos que vienen
        request()->validate(Evento::$rules);
        // lo enviamos a la base y retornamos lo creado
        $evento = Evento::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        // obtenemos todos los registros
        $evento=Evento::all();
        // regresamos todo en un json
        return response()->json($evento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // con esto llamamos a un registro en especifico y adaptamo el formato de la hora como queramos
        $evento=Evento::find($id);
        $evento->start=Carbon::createFromFormat('Y-m-d H:i:s',$evento->start)->format('Y-m-d');
        $evento->end=Carbon::createFromFormat('Y-m-d H:i:s',$evento->end)->format('Y-m-d');
        return response()->json($evento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        // Validamos que lo que recibimos como datos no sea vacio
        request()->validate(Evento::$rules);
        // si todo esta bien actualizamos un registro en especifico
        $evento->update($request->all());
        // retornamos un json con la respuesta del server
        return response()->json($evento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Encontramos un evento con ayuda de su id y lo borramos
        $evento=Evento::find($id)->delete();
        // retornamos un json como respuesta
        return response()->json($evento);
    }
}
