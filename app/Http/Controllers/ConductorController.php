<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conductor;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conductores = Conductor::paginate(10);
        return view('conductores.index', compact('conductores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('conductores.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $conductor = Conductor::create($request->All());
        return redirect()->route('conductores.index')
            ->with('successMsg', 'Conductor creado exitosamente.');
        /*
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'documento' => 'required|string|max:255|unique:conductores,documento',
                'fecha_nacimiento' => 'required|date',
                'estado' => 'required|boolean'
            ]);

            $validated['registrado_por'] = auth()->user()->name;

            // Crear el conductor con los datos validados
            $conductor = Conductor::create($validated);

            return redirect()->route('conductores.index')
                ->with('successMsg', 'Conductor creado exitosamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (QueryException $e) {
            Log::error('Error al crear el conductor: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear el conductor en la base de datos.')
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Error inesperado al crear el conductor: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error inesperado al crear el conductor.')
                ->withInput();
        }
                */
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
        $conductor = Conductor::findOrFail($id);
        return view('conductores.edit', compact('conductor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $conductor = Conductor::findOrFail($id);
        $conductor->update($request->all());

        return redirect()->route('conductores.index')
            ->with('successMsg', 'Conductor actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $conductor = conductor::findOrFail($id);
            $conductor->delete();

            return redirect()->route('conductores.index')
                ->with('successMsg', 'conductor eliminado exitosamente.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('conductor no encontrado: ' . $e->getMessage());
            return redirect()->route('conductores.index')
                ->with('error', 'La conductor no fue encontrado.');

        } catch (QueryException $e) {
            Log::error('Error al eliminar la conductor: ' . $e->getMessage());
            return redirect()->route('conductores.index')
                ->with('error', 'No se puede eliminar la conductor porque tiene registros relacionados.');

        } catch (\Exception $e) {
            Log::error('Error inesperado al eliminar la conductor: ' . $e->getMessage());
            return redirect()->route('conductores.index')
                ->with('error', 'Error inesperado al eliminar la conductor.');
        }
    }

    public function cambioEstado(Conductor $conductor)
    {
        try {
            $conductor->estado = !$conductor->estado;
            $conductor->save();

            return response()->json([
                'success' => true,
                'message' => 'Estado del conductor actualizado exitosamente.',
                'nuevo_estado' => $conductor->estado
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $conductor = Conductor::findOrFail($id);
            $conductor->estado = $request->estado;
            $conductor->save();

            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado'
            ], 500);
        }
    }
}
