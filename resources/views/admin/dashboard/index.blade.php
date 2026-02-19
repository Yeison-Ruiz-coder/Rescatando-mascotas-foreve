@extends('admin.layouts.app')

@section('title', 'Dashboard - Panel Admin')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">Dashboard Administrativo</h1>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card glass-card">
                    <div class="card-body">
                        <h5 class="card-title">Mascotas</h5>
                        <h2 class="text-primary">150</h2>
                        <a href="{{ route('admin.mascotas.index') }}" class="btn btn-sm btn-outline-primary">Ver todas</a>
                    </div>
                </div>
            </div>
            <!-- Más tarjetas del dashboard -->


        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card glass-card">
                    <div class="card-body">
                        <h5 class="card-title">Mascotas</h5>
                        <h2 class="text-primary">150</h2>
                        <a href="{{ route('admin.mascotas.index') }}" class="btn btn-sm btn-outline-primary">Ver todas</a>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card glass-card">
                    <div class="card-body">
                        <h5 class="card-title">Mascotas</h5>
                        <h2 class="text-primary">150</h2>
                        <a href="{{ route('admin.mascotas.index') }}" class="btn btn-sm btn-outline-primary">Ver todas</a>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card glass-card">
                    <div class="card-body">
                        <h5 class="card-title">Mascotas</h5>
                        <h2 class="text-primary">150</h2>
                        <a href="{{ route('admin.mascotas.index') }}" class="btn btn-sm btn-outline-primary">Ver todas</a>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card glass-card">
                    <div class="card-body">
                        <h5 class="card-title">Mascotas</h5>
                        <h2 class="text-primary">150</h2>
                        <a href="{{ route('admin.mascotas.index') }}" class="btn btn-sm btn-outline-primary">Ver todas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

