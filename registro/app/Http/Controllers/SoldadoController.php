<?php

namespace App\Http\Controllers;

use App\Models\Soldado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SoldadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['soldados'] = Soldado::paginate(5);
        return view('soldado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('soldado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosSoldado = request()->all();
        $campos=[
            'nombre'=>'required|string|max:100',
            'apellido'=>'required|string|max:100',
            'correo'=>'required|email',
            'escuadron'=>'required|numeric',
            'foto'=>'required|mimes:jpeg,jpg,png'
        ];
        $mensajes=[
            'required'=>'El :attribute es requerido',
            'foto.required'=> 'La foto es requerida'
        ];
        $this->validate($request, $campos, $mensajes);

        $datosSoldado = request()->except('_token');

        if($request->hasFile('foto')){
            $datosSoldado['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Soldado::insert($datosSoldado);
        //return response()->json($datosSoldado);
        return redirect('soldado')->with('mensaje', 'Soldado agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Soldado  $soldado
     * @return \Illuminate\Http\Response
     */
    public function show(Soldado $soldado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Soldado  $soldado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $soldado = Soldado::findOrFail($id);
        return view('soldado.edit', compact('soldado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Soldado  $soldado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'nombre'=>'required|string|max:100',
            'apellido'=>'required|string|max:100',
            'correo'=>'required|email',
            'escuadron'=>'required|numeric',
            
        ];
        $mensajes=[
            'required'=>'El :attribute es requerido',
        ];

        if($request->hasFile('foto')){
            $campos = ['foto'=>'required|mimes:jpeg,jpg,png',];
            $mensajes = ['foto.required'=> 'La foto es requerida'];
        }

        $this->validate($request, $campos, $mensajes);

        $datosSoldado = request()->except(['_token','_method']);
        if($request->hasFile('foto')){
            $soldado = Soldado::findOrFail($id);

            Storage::delete('public/'.$soldado->foto);
            
            $datosSoldado['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Soldado::where('id', '=', $id)->update($datosSoldado); 
        $soldado = Soldado::findOrFail($id);
        //return view('soldado.edit', compact('soldado'));
        return redirect('soldado')->with('mensaje', 'Soldado modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soldado  $soldado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $soldado = Soldado::findOrFail($id);
        if(Storage::delete('public/'.$soldado->foto)){
            Soldado::destroy($id);
        }
        return redirect('soldado')->with('mensaje', 'Soldado borrado con exito');

    }
}
