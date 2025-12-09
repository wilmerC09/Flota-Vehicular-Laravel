<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recarga_Combustible;
use App\Models\Vehiculo;

class Recarga_CombustibleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recarga_combustibles = Recarga_Combustible::paginate(10);
        return view('recarga_combustibles.index', compact('recarga_combustibles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehiculos = Vehiculo::all();
        return view('recarga_combustibles.create', compact('vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $recarga_combustible = Recarga_Combustible::create($request->All());
        return redirect()->route('recarga_combustibles.index')
            ->with('successMsg', 'Recarga de combustible creada exitosamente.');
        /*
        try{
            $validated = $request->validate([
                'cantidad_litros' => 'required|numeric|min:0',
                'precio_por_litro' => 'required|numeric|min:0',
                'costo_total' => 'required|numeric|min:0',
                'estacion_servicio' => 'required|string|max:255'
            ]);

            $validated['registrado_por'] = auth()->user()->name;

            // Crear la recarga de combustible con los datos validados
            $recarga_combustible = Recarga_Combustible::create($validated);

            return redirect()->route('recarga_combustibles.index')
                ->with('successMsg', 'Recarga de combustible creada exitosamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Error al crear la recarga de combustible: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear la recarga de combustible en la base de datos.')
                ->withInput();
        }*/
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $recarga_combustible = Recarga_Combustible::findOrFail($id);
        $vehiculos = Vehiculo::all();
        return view('recarga_combustibles.edit', compact('recarga_combustible', 'vehiculos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $recarga_combustible = Recarga_Combustible::findOrFail($id);
        $recarga_combustible->update($request->all());

        return redirect()->route('recarga_combustibles.index')
            ->with('successMsg', 'Recarga de combustible actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $recarga_combustible = Recarga_Combustible::findOrFail($id);
            $recarga_combustible->delete();

            return redirect()->route('recarga_combustibles.index')
                ->with('successMsg', 'Combustible eliminado exitosamente.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Combustible no encontrada: ' . $e->getMessage());
            return redirect()->route('recarga_combustibles.index')
                ->with('error', 'El combustible no fue encontrado.');

        } catch (QueryException $e) {
            Log::error('Error al eliminar el Combustible: ' . $e->getMessage());
            return redirect()->route('recarga_combustibles.index')
                ->with('error', 'No se puede eliminar el combustible porque tiene registros relacionados.');

        } catch (\Exception $e) {
            Log::error('Error inesperado al eliminar el combustible: ' . $e->getMessage());
            return redirect()->route('recarga_combustibles.index')
                ->with('error', 'Error inesperado al eliminar el combustible.');
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $recarga = Recarga_Combustible::findOrFail($id);
            $recarga->estado = $request->estado;
            $recarga->save();

            return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar el estado'], 500);
        }
    }
}
