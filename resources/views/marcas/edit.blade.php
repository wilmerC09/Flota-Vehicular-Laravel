@extends('layouts.app')

@section('title', 'Editar Marca')

@section('content')
    <div class="content-wrapper pb-4" style="background: #f8f9fa;">
        <section class="content-header" style="padding: 1.5rem 1rem; background: white; border-bottom: 1px solid #e5e7eb;">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 style="font-size: 24px; font-weight: 700; color: #1f2937; margin: 0;">Editar Marca</h1>
                        <nav style="font-size: 14px; color: #6b7280; margin-top: 4px;">
                            <a href="{{ route('home') }}" style="color: #6b7280; text-decoration: none;">Home</a>
                            <span style="margin: 0 8px;">/</span>
                            <a href="{{ route('marcas.index') }}" style="color: #6b7280; text-decoration: none;">Marcas</a>
                            <span style="margin: 0 8px;">/</span>
                            <span>Editar</span>
                        </nav>
                    </div>
                    <a href="{{ route('marcas.index') }}"
                        style="background: #6b7280; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </section>

        <section class="content" style="padding: 1.5rem 1rem;">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                            <div class="card-header"
                                style="background: white; border-bottom: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 16px 16px 0 0;">
                                <h3 class="mb-0" style="color: #2d3748; font-weight: 600; font-size: 18px;">
                                    <i class="fas fa-copyright mr-2" style="color: #10b981;"></i>{{ $marca->nombre }}
                                </h3>
                            </div>

                            <form method="POST" action="{{ route('marcas.update', $marca->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    {{-- Mensajes de error --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <h5><i class="icon fas fa-ban"></i> Por favor corrige los siguientes errores:
                                            </h5>
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="row">
                                        {{-- Nombre --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombre">
                                                    <i class="fas fa-tag text-primary mr-1"></i>
                                                    Nombre <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                                    id="nombre" value="{{ old('nombre', $marca->nombre) }}"
                                                    placeholder="Ej: Toyota" required>
                                                @error('nombre')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- País de Origen --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="pais_origen">
                                                    <i class="fas fa-globe text-success mr-1"></i>
                                                    País de Origen <strong style="color:red;">(*)</strong>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('pais_origen') is-invalid @enderror"
                                                    name="pais_origen" id="pais_origen"
                                                    value="{{ old('pais_origen', $marca->pais_origen) }}"
                                                    placeholder="Ej: JapÃ³n" required>
                                                @error('pais_origen')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Campos ocultos --}}
                                    <input type="hidden" name="estado" value="{{ old('estado', $marca->estado ? 1 : 0) }}">
                                    <input type="hidden" name="registrado_por" value="{{ $marca->registrado_por }}">

                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Nota:</strong> Los campos marcados con <strong
                                            style="color:red;">(*)</strong> son obligatorios.
                                    </div>
                                </div>

                                <div class="card-footer"
                                    style="background: #f9fafb; border-top: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 0 0 16px 16px;">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('marcas.index') }}"
                                            style="background: #6b7280; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none;">
                                            <i class="fas fa-times"></i> Cancelar
                                        </a>
                                        <button type="submit"
                                            style="background: #10b981; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 500; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer;">
                                            <i class="fas fa-save"></i> Actualizar Marca
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection@ p u s h ( ' s t y l e s ' ) 
         < l i n k   h r e f = \  
 h t t p s : / / c d n . j s d e l i v r . n e t / n p m / s e l e c t 2 @ 4 . 1 . 0 - r c . 0 / d i s t / c s s / s e l e c t 2 . m i n . c s s \   r e l = \ s t y l e s h e e t \   / > 
         < s t y l e > 
                 . s e l e c t 2 - c o n t a i n e r - - d e f a u l t   . s e l e c t 2 - s e l e c t i o n - - s i n g l e   { 
                         b o r d e r :   1 p x   s o l i d   # c e d 4 d a ;   h e i g h t :   3 8 p x ;   b o r d e r - r a d i u s :   0 . 2 5 r e m ; 
                 } 
                 . s e l e c t 2 - c o n t a i n e r - - d e f a u l t   . s e l e c t 2 - s e l e c t i o n - - s i n g l e   . s e l e c t 2 - s e l e c t i o n _ _ r e n d e r e d   {   l i n e - h e i g h t :   3 6 p x ;   } 
                 . s e l e c t 2 - c o n t a i n e r - - d e f a u l t   . s e l e c t 2 - s e l e c t i o n - - s i n g l e   . s e l e c t 2 - s e l e c t i o n _ _ a r r o w   {   h e i g h t :   3 6 p x ;   } 
         < / s t y l e > 
 @ e n d p u s h 
 
 @ p u s h ( ' s c r i p t s ' ) 
         < s c r i p t   s r c = \ h t t p s : / / c d n . j s d e l i v r . n e t / n p m / s e l e c t 2 @ 4 . 1 . 0 - r c . 0 / d i s t / j s / s e l e c t 2 . m i n . j s \ > < / s c r i p t > 
         < s c r i p t > 
                 . r e a d y ( f u n c t i o n ( )   { 
                         # p a i s _ o r i g e n . s e l e c t 2 ( { 
                                 p l a c e h o l d e r :   ' S e l e c c i o n e   u n   p a � s ' , 
                                 a l l o w C l e a r :   t r u e , 
                                 l a n g u a g e :   {   n o R e s u l t s :   f u n c t i o n ( )   {   r e t u r n   ' N o   s e   e n c o n t r a r o n   r e s u l t a d o s ' ;   } } 
                         } ) ; 
                 } ) ; 
         < / s c r i p t > 
 @ e n d p u s h  
 