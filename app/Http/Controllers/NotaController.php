<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;


class NotaController extends Controller
{

        public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usuarioEmail = auth()->user()->email;
        $notas = Nota::where('usuario', $usuarioEmail)->paginate(5);
        return view('notas.lista',compact('notas'));    }

  
    public function create()
    {
        return view('notas.crear');
    }

    public function store(Request $request)
    {
        $nota = new Nota();
        $nota->nombre = $request->nombre;
        $nota->descripcion = $request->descripcion;
        $nota->usuario = auth()->user()->email;
        $nota->save();
    
        return back()->with('mensaje', 'Nota Agregada!');
    }

    public function show(string $id)
    {
        $nota = Nota::findOrFail($id);
        return view('notas.mostrar',data: compact('nota'));
    }


    public function edit(string $id)
    {
        $nota = Nota::findOrFail($id);
        return view('notas.editar',compact('nota'));  
    }


    public function update(Request $request, string $id)
    {
        $request->validate(
            rules: [
                "nombre" => "required",
                "descripcion" => "required",
            ],
            messages: [
                "nombre.required" => "El nombre es obligatorio",
                "descripcion.required" => "La descripcion es obligatoria",
            ]
        );
    
        $notaActualizar = Nota::findOrFail($id);
    
        $notaActualizar ->nombre = $request->nombre;
        $notaActualizar ->descripcion = $request ->descripcion;
    
        $notaActualizar -> save();
        return back()->with('mensaje','Nota actualizada correctamente');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notaEliminar= Nota::find($id);
        $notaEliminar->delete();
        return back()->with('mensaje','Nota Eliminada!');
    }
}