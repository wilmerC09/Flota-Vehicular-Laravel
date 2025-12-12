<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\MarcaRequest;

class MarcaController extends Controller
{

    public function index()
    {
        $marcas = Marca::paginate(10);
        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255|unique:marcas,nombre',
                'pais_origen' => 'required|string|max:255',
                'estado' => 'required|boolean',
                'registrado_por' => 'nullable|string|max:255'
            ], [
                'nombre.unique' => 'Esta marca ya existe en el sistema.',
                'nombre.required' => 'El nombre de la marca es obligatorio.',
                'pais_origen.required' => 'El país de origen es obligatorio.'
            ]);

            $marca = Marca::create($validated);

            return redirect()->route('marcas.index')
                ->with('successMsg', 'Marca creada exitosamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (QueryException $e) {
            Log::error('Error al crear la marca: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear la marca en la base de datos.')
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Error inesperado al crear la marca: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error inesperado al crear la marca.')
                ->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $marca = Marca::findOrFail($id);
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $marca = Marca::findOrFail($id);

            $validated = $request->validate([
                'nombre' => 'required|string|max:255|unique:marcas,nombre,' . $id,
                'pais_origen' => 'required|string|max:255',
                'estado' => 'required|boolean',
                'registrado_por' => 'nullable|string|max:255'
            ], [
                'nombre.unique' => 'Esta marca ya existe en el sistema.',
                'nombre.required' => 'El nombre de la marca es obligatorio.',
                'pais_origen.required' => 'El país de origen es obligatorio.'
            ]);

            $marca->update($validated);

            return redirect()->route('marcas.index')
                ->with('successMsg', 'Marca actualizada exitosamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Error al actualizar la marca: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error inesperado al actualizar la marca.')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $marca = Marca::findOrFail($id);
            $marca->delete();

            return redirect()->route('marcas.index')
                ->with('successMsg', 'Marca eliminada exitosamente.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Marca no encontrada: ' . $e->getMessage());
            return redirect()->route('marcas.index')
                ->with('error', 'La marca no fue encontrada.');

        } catch (QueryException $e) {
            Log::error('Error al eliminar la marca: ' . $e->getMessage());
            return redirect()->route('marcas.index')
                ->with('error', 'No se puede eliminar la marca porque tiene registros relacionados.');

        } catch (\Exception $e) {
            Log::error('Error inesperado al eliminar la marca: ' . $e->getMessage());
            return redirect()->route('marcas.index')
                ->with('error', 'Error inesperado al eliminar la marca.');
        }
    }

    public function cambioEstado($id)
    {
        try {
            $marca = Marca::findOrFail($id);
            $marca->estado = !$marca->estado;
            $marca->save();

            return response()->json([
                'success' => true,
                'message' => 'Estado de la marca actualizado exitosamente.',
                'nuevo_estado' => $marca->estado
            ]);
        } catch (\Exception $e) {
            Log::error('Error al cambiar estado de marca: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el estado de la marca.'
            ], 500);
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $marca = Marca::findOrFail($id);
            $marca->estado = $request->estado;
            $marca->save();

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
