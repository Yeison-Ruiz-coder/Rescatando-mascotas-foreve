@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="{{ $icon }}"></i> {{ $title }}
    </h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ $action }}" method="POST">
            @csrf
            @if(isset($item) && $item->id)
                @method('PUT')
            @endif

            @foreach($fields as $field)
            <div class="mb-3">
                <label for="{{ $field['name'] }}" class="form-label">
                    {{ $field['label'] }} 
                    @if(isset($field['required']) && $field['required'])
                    <span class="text-danger">*</span>
                    @endif
                </label>
                
                @if($field['type'] == 'text')
                <input type="text" class="form-control @error($field['name']) is-invalid @enderror" 
                       id="{{ $field['name'] }}" name="{{ $field['name'] }}" 
                       value="{{ old($field['name'], $item->{$field['name']} ?? '') }}"
                       @if(isset($field['required']) && $field['required']) required @endif>
                
                @elseif($field['type'] == 'email')
                <input type="email" class="form-control @error($field['name']) is-invalid @enderror" 
                       id="{{ $field['name'] }}" name="{{ $field['name'] }}" 
                       value="{{ old($field['name'], $item->{$field['name']} ?? '') }}"
                       @if(isset($field['required']) && $field['required']) required @endif>
                
                @elseif($field['type'] == 'select')
                <select class="form-control @error($field['name']) is-invalid @enderror" 
                        id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                        @if(isset($field['required']) && $field['required']) required @endif>
                    <option value="">Seleccionar...</option>
                    @foreach($field['options'] as $option)
                    <option value="{{ $option['value'] }}" 
                        {{ old($field['name'], $item->{$field['name']} ?? '') == $option['value'] ? 'selected' : '' }}>
                        {{ $option['label'] }}
                    </option>
                    @endforeach
                </select>
                
                @elseif($field['type'] == 'textarea')
                <textarea class="form-control @error($field['name']) is-invalid @enderror" 
                          id="{{ $field['name'] }}" name="{{ $field['name'] }}" 
                          rows="3" @if(isset($field['required']) && $field['required']) required @endif>{{ old($field['name'], $item->{$field['name']} ?? '') }}</textarea>
                
                @elseif($field['type'] == 'date')
                <input type="date" class="form-control @error($field['name']) is-invalid @enderror" 
                       id="{{ $field['name'] }}" name="{{ $field['name'] }}" 
                       value="{{ old($field['name'], $item->{$field['name']} ?? '') }}"
                       @if(isset($field['required']) && $field['required']) required @endif>
                @endif

                @error($field['name'])
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @endforeach

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route($route . '.index') }}" class="btn btn-secondary me-md-2">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> 
                    {{ isset($item) && $item->id ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection