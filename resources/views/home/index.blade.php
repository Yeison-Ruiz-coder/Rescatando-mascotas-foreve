@extends('public.layouts.app') <!-- Usa el nuevo layout del home -->

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

    @push('styles')
    {{-- TODOS los estilos del home aquí --}}
    <link rel="stylesheet" href="{{ asset('css/home/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/mascotas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/cta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/testimonios.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home/responsive.css') }}">
@endpush
@endsection
