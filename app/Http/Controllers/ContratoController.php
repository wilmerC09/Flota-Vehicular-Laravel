<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Conductor;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contratos = Contrato::paginate(10); // 10 registros por página
        return view('contratos.index', compact('contratos'));
    }

    public function create()
    {
        $conductores = Conductor::all();
        return view('contratos.create', compact('conductores'));
    }

    public function store(Request $request)
    {
        $contrato = Contrato::create($request->All());
        return redirect()->route('contratos.index')
            ->with('successMsg', 'Contrato creado exitosamente.');
        /*
        try {
            $validated = $request->validate([
                'fecha_inicio' => 'required|date',
                'fecha_final' => 'required|date|after:fecha_inicio',
                'salario' => 'required|numeric|min:0',
                'estado' => 'required|boolean'
            ]);

            $validated['registrado_por'] = auth()->user()->name;

            // Crear el contrato con los datos validados
            $contrato = Contrato::create($validated);

            return redirect()->route('contratos.index')
                ->with('successMsg', 'Contrato creado exitosamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (QueryException $e) {
            Log::error('Error al crear el contrato: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear el contrato en la base de datos.')
                ->withInput();
        }*/
    }

    public function edit(string $id)
    {
        $contrato = Contrato::findOrFail($id);
        $conductores = Conductor::all();
        return view('contratos.edit', compact('contrato', 'conductores'));
    }

    public function update(Request $request, string $id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->update($request->all());

        return redirect()->route('contratos.index')
            ->with('successMsg', 'Contrato actualizado exitosamente.');
    }

    /**
     * Cambiar el estado del contrato (activo/inactivo)
     */
    public function cambioEstado(Contrato $contrato)
    {
        try {
            $contrato->estado = !$contrato->estado;
            $contrato->save();

            return response()->json([
                'success' => true,
                'message' => 'Estado del contrato actualizado exitosamente.',
                'nuevo_estado' => $contrato->estado
            ]);
        } catch (\Exception $e) {
            Log::error('Error al cambiar estado de contrato: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el estado del contrato.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        try {
            $contrato->delete();
            return redirect()->route('contratos.index')->with('successMsg', 'Contrato eliminado exitosamente.');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el contrato: ' . $e->getMessage());
            return redirect()->route('contratos.index')->with('error', 'Error al eliminar el contrato: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Error inesperado al eliminar el contrato: ' . $e->getMessage());
            return redirect()->route('contratos.index')->with('error', 'Error inesperado al eliminar el contrato: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $contrato = Contrato::findOrFail($id);
            $contrato->estado = $request->estado;
            $contrato->save();

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
