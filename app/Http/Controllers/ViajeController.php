<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Models\Ruta;
use App\Models\Vehiculo;
use App\Models\Conductor;

class ViajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $viajes = Viaje::paginate(10);
        return view('viajes.index', compact('viajes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rutas = Ruta::all();
        $vehiculos = Vehiculo::all();
        $conductores = Conductor::all();
        return view('viajes.create', compact('rutas', 'vehiculos', 'conductores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'vehiculo_id' => 'required|exists:vehiculos,id',
                'conductor_id' => 'required|exists:conductores,id',
                'ruta_id' => 'required|exists:rutas,id',
                'descripcion' => 'nullable|string',
                'recorrido' => 'required|numeric|min:0',
                'tiempo_estimado' => 'required|integer|min:0',
                'costo_total' => 'required|numeric|min:0',
                'estado' => 'required|boolean',
            ]);

            $validated['registrado_por'] = auth()->user()->name;

            Viaje::create($validated);

            return redirect()->route('viajes.index')
                ->with('successMsg', 'Viaje creado exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (QueryException $e) {
            Log::error('Error al crear el viaje: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear el viaje en la base de datos.')
                ->withInput();
        }
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
        $viaje = Viaje::findOrFail($id);
        $rutas = Ruta::all();
        $vehiculos = Vehiculo::all();
        $conductores = Conductor::all();
        return view('viajes.edit', compact('viaje', 'rutas', 'vehiculos', 'conductores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $viaje = Viaje::findOrFail($id);
        $viaje->update($request->all());

        return redirect()->route('viajes.index')
            ->with('successMsg', 'Viaje actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Viaje $viaje)
    {
        try {
            $viaje->delete();
            return redirect()->route('viajes.index')
                ->with('successMsg', 'Viaje eliminado exitosamente.');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el viaje: ' . $e->getMessage());
            return redirect()->route('viajes.index')
                ->with('error', 'Error al eliminar el viaje de la base de datos.');
        } catch (\Exception $e) {
            Log::error('Error inesperado al eliminar el viaje: ' . $e->getMessage());
            return redirect()->route('viajes.index')
                ->with('error', 'Error inesperado al eliminar el viaje.');
        }
    }

    public function cambioEstado(Viaje $viaje)
    {
        try {
            $viaje->estado = !$viaje->estado;
            $viaje->save();

            return response()->json([
                'success' => true,
                'message' => 'Estado del viaje actualizado exitosamente.',
                'nuevo_estado' => $viaje->estado
            ]);
        } catch (\Exception $e) {
            Log::error('Error al cambiar estado del viaje: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el estado del viaje.'
            ], 500);
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $viaje = Viaje::findOrFail($id);
            $viaje->estado = $request->estado;
            $viaje->save();

            return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar el estado'], 500);
        }
    }
}
