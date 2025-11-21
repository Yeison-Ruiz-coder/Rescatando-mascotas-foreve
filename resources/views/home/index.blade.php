@extends('home.layouts.main') <!-- Usa el nuevo layout del home -->

@section('title', 'Rescatando Mascotas - Inicio')

@section('content')
    <!-- Hero Section -->
    @include('home.partials.hero')
    
    <!-- Stats Section -->
    @include('home.partials.stats')
    
    <!-- Mascotas Section -->
    @include('home.partials.mascotas')
    
    <!-- Proceso Section -->
    @include('home.partials.proceso')
    
    <!-- Testimonios Section -->
    @include('home.partials.testimonios')
    
    <!-- CTA Section -->
    @include('home.partials.cta')
@endsection