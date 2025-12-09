<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Marca;
use App\Models\Tipo_Vehiculo;
use App\Http\Requests\VehiculoRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;


class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::paginate(10);
        return view('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::all()->unique('nombre');
        $tipo_vehiculos = Tipo_Vehiculo::all()->unique('nombre');

        return view('vehiculos.create', compact('marcas', 'tipo_vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehiculoRequest $request)
    {
        // Manejar la subida de imagen
        $image = $request->file('imagen');
        $slug = Str::slug($request->placa);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/vehiculos')) {
                mkdir('uploads/vehiculos', 0777, true);
            }
            $image->move('uploads/vehiculos', $imagename);
        } else {
            $imagename = "";
        }

        // Crear el vehículo con la imagen
        $vehiculo = Vehiculo::create(array_merge($request->except('imagen'), [
            'imagen' => $imagename
        ]));

        return redirect()->route('vehiculos.index')
            ->with('successMsg', 'Vehículo creado exitosamente.');
        /*
        try{
            $validated = $request->validate([
                'marca_id' => 'required|exists:marcas,id',
                'tipo_vehiculo_id' => 'required|exists:tipo_vehiculos,id',
                'placa' => 'required|string|max:10|unique:vehiculos,placa',
                'modelo' => 'required|string|max:100',
                'año' => 'required|integer|min:1900|max:' . date('Y'),
                'color' => 'required|string|max:50',
                'kilometraje' => 'required|numeric|min:0',
                'estado' => 'required|boolean',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $validated['registrado_por'] = auth()->user()->name;

            Vehiculo::create($validated);

            return redirect()->route('vehiculos.index')
                ->with('successMsg', 'Vehículo creado exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (QueryException $e) {
            Log::error('Error al crear el vehículo: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear el vehículo en la base de datos.')
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $marcas = Marca::all()->unique('nombre');
        $tipo_vehiculos = Tipo_Vehiculo::all()->unique('nombre');

        return view('vehiculos.edit', compact('vehiculo', 'marcas', 'tipo_vehiculos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehiculoRequest $request, string $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        // Manejar la subida de imagen
        $image = $request->file('imagen');
        $slug = Str::slug($request->placa);

        if (isset($image)) {
            // Eliminar imagen anterior si existe
            if ($vehiculo->imagen && file_exists(public_path('uploads/vehiculos/' . $vehiculo->imagen))) {
                unlink(public_path('uploads/vehiculos/' . $vehiculo->imagen));
            }

            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/vehiculos')) {
                mkdir('uploads/vehiculos', 0777, true);
            }
            $image->move('uploads/vehiculos', $imagename);

            // Actualizar con nueva imagen
            $vehiculo->update(array_merge($request->except('imagen'), [
                'imagen' => $imagename
            ]));
        } else {
            // Actualizar sin cambiar la imagen
            $vehiculo->update($request->except('imagen'));
        }

        return redirect()->route('vehiculos.index')
            ->with('successMsg', 'Vehículo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        try {
            // Eliminar imagen si existe
            if ($vehiculo->imagen && file_exists(public_path('uploads/vehiculos/' . $vehiculo->imagen))) {
                unlink(public_path('uploads/vehiculos/' . $vehiculo->imagen));
            }

            $vehiculo->delete();
            return redirect()->route('vehiculos.index')
                ->with('successMsg', 'Vehículo eliminado exitosamente.');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el vehículo: ' . $e->getMessage());
            return redirect()->route('vehiculos.index')
                ->with('error', 'Error al eliminar el vehículo de la base de datos.');
        } catch (\Exception $e) {
            Log::error('Error inesperado al eliminar el vehículo: ' . $e->getMessage());
            return redirect()->route('vehiculos.index')
                ->with('error', 'Error inesperado al eliminar el vehículo.');
        }
    }

    /**
     * Toggle status via AJAX
     */
    public function toggleStatus(Request $request, $id)
    {
        try {
            $vehiculo = Vehiculo::findOrFail($id);
            $vehiculo->estado = $request->estado;
            $vehiculo->save();

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
