@extends('layout.app')


@section('title')
ड्यासबोर्ड | {{ config('app.name') }}
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>ड्यासबोर्ड | {{ config('app.name') }}</h4>
    </div>
    <div class="card-body">









 


    <!-- Summary Cards -->
    <div class="row mb-2">
        <div class="col-md-4 mb-2 mb-md-0">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-primary fw-bold">जम्मा विद्यालय संख्या</h5>
                            <h2 class="mb-0">{{ $total_schools }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-school fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-2 mb-md-0">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-success fw-bold">जम्मा शिक्षक संख्या</h5>
                            <h2 class="mb-0">{{ $total_teachers }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-chalkboard-teacher fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-info fw-bold">‍औशत शिक्षक संख्या प्रति विद्यालय</h5>
                            <h2 class="mb-0">{{ $total_schools > 0 ? round($total_teachers / $total_schools, 1) : 0 }}</h2>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row - 3 Columns -->
    <div class="row  d-print-none">
        <!-- School by Type Chart -->
        <div class="col-md-4 mb-2">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">विद्यालयको प्रकारका आधारमा</h5>
                </div>
                <div class="card-body">
                    <canvas id="schoolsByTypeChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Teachers by Type Chart -->
        <div class="col-md-4 mb-2">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">शिक्षकको प्रकारका आधारमा</h5>
                </div>
                <div class="card-body">
                    <canvas id="teachersByTypeChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Teachers by Level Chart -->
        <div class="col-md-4 mb-2">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">शिक्षकको तहका आधारमा</h5>
                </div>
                <div class="card-body">
                    <canvas id="teachersByLevelChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables -->
    <div class="row">
        <!-- Schools by Type Table -->
        <div class="col-md-6 mb-2">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">विद्यलयको तहमा आधारित</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>विद्यालयको प्रकार</th>
                                    <th>संख्या</th>
                                    <th>प्रतिशत</th>
                                    <th class="d-print-none">रेखाचित्र</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schools_by_type as $school_type)
                                <tr>
                                    <td>{{ $school_type->school_type ?? 'Unknown' }}</td>
                                    <td>{{ $school_type->count }}</td>
                                    <td>{{ round(($school_type->count / $total_schools) * 100, 1) }}%</td>
                                    <td class="d-print-none">
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-primary" role="progressbar" 
                                                 style="width: {{ ($school_type->count / $total_schools) * 100 }}%" 
                                                 aria-valuenow="{{ $school_type->count }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="{{ $total_schools }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers by Type Table -->
        <div class="col-md-6 mb-2">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">शिक्षकको प्रकारमा आधारित</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>प्रकार</th>
                                    <th>संख्या</th>
                                    <th>प्रतिशत</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers_by_type as $type)
                                <tr>
                                    <td>{{ $type->type ?? 'Unknown' }}</td>
                                    <td>{{ $type->count }}</td>
                                    <td>{{ round(($type->count / $total_teachers) * 100, 1) }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers by Level Table -->
        <div class="col-md-6 mb-2">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">शिक्षकको तहमा आधारित</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>तह</th>
                                    <th>संख्या</th>
                                    <th>प्रतिशत</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers_by_level as $level)
                                <tr>
                                    <td>{{ $level->level ?? 'Unknown' }}</td>
                                    <td>{{ $level->count }}</td>
                                    <td>{{ round(($level->count / $total_teachers) * 100, 1) }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers by Type and Level Table -->
        <div class="col-md-6 mb-2">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">शिक्षकको तह र प्रकारमा आधारित</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>प्रकार</th>
                                    <th>तह</th>
                                    <th>संख्या</th>
                                    <th>प्रतिशत</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers_by_type_and_level as $teacher)
                                <tr>
                                    <td>{{ $teacher->type ?? 'Unknown' }}</td>
                                    <td>{{ $teacher->level ?? 'Unknown' }}</td>
                                    <td>{{ $teacher->count }}</td>
                                    <td>{{ round(($teacher->count / $total_teachers) * 100, 1) }}%</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Schools by Type Chart
    const schoolTypeCtx = document.getElementById('schoolsByTypeChart').getContext('2d');
    const schoolTypeChart = new Chart(schoolTypeCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($schools_by_type->pluck('school_type')) !!},
            datasets: [{
                data: {!! json_encode($schools_by_type->pluck('count')) !!},
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(201, 203, 207, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });

    // Teachers by Type Chart
    const typeCtx = document.getElementById('teachersByTypeChart').getContext('2d');
    const typeChart = new Chart(typeCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($teachers_by_type->pluck('type')) !!},
            datasets: [{
                data: {!! json_encode($teachers_by_type->pluck('count')) !!},
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                }
            }
        }
    });

    // Teachers by Level Chart
    const levelCtx = document.getElementById('teachersByLevelChart').getContext('2d');
    const levelChart = new Chart(levelCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($teachers_by_level->pluck('level')) !!},
            datasets: [{
                label: 'Teachers',
                data: {!! json_encode($teachers_by_level->pluck('count')) !!},
                backgroundColor: 'rgba(40, 167, 69, 0.7)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    </div>
































@endsection