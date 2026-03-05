{{-- VACUNAS --}}
<div class="card shadow mb-4">
    <div class="card-header fw-bold bg-turquesa text-white">
        <i class="fas fa-syringe me-2"></i>Historial de Vacunación
    </div>
    <div class="card-body">
        @if($mascota->vacunas && $mascota->vacunas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Vacuna</th>
                            <th>Frecuencia</th>
                            <th>Fecha Aplicación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mascota->vacunas as $vacuna)
                        <tr>
                            <td>
                                <i class="fas fa-syringe text-info me-2"></i>
                                {{ $vacuna->nombre_vacuna }}
                            </td>
                            <td>
                                @if($vacuna->frecuencia_dias)
                                    Cada {{ $vacuna->frecuencia_dias }} días
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($vacuna->pivot && $vacuna->pivot->fecha_aplicacion)
                                    {{ \Carbon\Carbon::parse($vacuna->pivot->fecha_aplicacion)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">No registrada</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted mb-0">
                <i class="fas fa-info-circle me-2"></i>
                Aún no se ha registrado el historial de vacunas.
            </p>
        @endif
    </div>
</div>
