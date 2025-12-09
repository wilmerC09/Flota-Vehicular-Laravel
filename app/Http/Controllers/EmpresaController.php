<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::paginate(10);
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $empresa = Empresa::create($request->All());
        return redirect()->route('empresas.index')
            ->with('successMsg', 'Empresa creada exitosamente.');
        /*
        try{
            $validated = $request->validate([
                'nombre_empresa' => 'required|string|max:255',
                'direccion' => 'required|string|max:500',
                'telefono' => 'required|string|max:20',
                'email' => 'required|email|max:255|unique:empresas,email',
                'estado' => 'required|boolean',
            ]);

            $validated['registrado_por'] = auth()->user()->name;

            Empresa::create($validated);

            return redirect()->route('empresas.index')
                ->with('successMsg', 'Empresa creada exitosamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (QueryException $e) {
            Log::error('Error al crear la empresa: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear la empresa en la base de datos.')
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
        $empresa = Empresa::findOrFail($id);
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->update($request->all());

        return redirect()->route('empresas.index')
            ->with('successMsg', 'Empresa actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        try {
            $empresa->delete();
            return redirect()->route('empresas.index')
                ->with('successMsg', 'Empresa eliminada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar la empresa: ' . $e->getMessage());
            return redirect()->route('empresas.index')
                ->with('error', 'Error al eliminar la empresa.');
        }
    }

    public function cambioEstado(Empresa $empresa)
    {
        try {
            $empresa->estado = !$empresa->estado;
            $empresa->save();

            return response()->json([
                'success' => true,
                'message' => 'Estado de la empresa actualizado exitosamente.',
                'nuevo_estado' => $empresa->estado
            ]);
        } catch (\Exception $e) {
            Log::error('Error al cambiar estado de la empresa: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el estado de la empresa.'
            ], 500);
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $empresa = Empresa::findOrFail($id);
            $empresa->estado = $request->estado;
            $empresa->save();

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
