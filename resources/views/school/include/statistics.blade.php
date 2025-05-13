<!-- First Row: Total Teachers + Charts -->
<div class="row g-3">
    <!-- Total Teachers Card -->
    <div class="col-md-3 mb-2">
        <div class="card bg-primary text-white h-100">
            <div class="card-body text-center d-flex flex-column justify-content-center">
                <h5 class="card-title mb-2">जम्मा शिक्षक संख्या</h5>
                <div class="display-4 fw-bold">{{ $totalTeachers }}</div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="col-md-9 d-print-none">
        <div class="row g-3">
            <div class="col-md-6 mb-2">
                <div class="card h-100">
                    <div class="card-header bg-light fw-bold">शिक्षकको प्रकारमा आधारित डोनट चार्ट</div>
                    <div class="card-body p-2 position-relative" style="min-height: 220px;">
                        <div class="chart-container" style="height: 200px;">
                            <canvas id="typeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="card h-100">
                    <div class="card-header bg-light fw-bold">शिक्षकको तहमा आधारित डोनट चार्ट</div>
                    <div class="card-body p-2 position-relative" style="min-height: 220px;">
                        <div class="chart-container" style="height: 200px;">
                            <canvas id="levelChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Second Row: All Other Data -->
<div class="row g-3">
    <!-- Type Breakdown -->
    <div class="col-lg-4 mb-2">
        <div class="card h-100">
            <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
                <span>शिक्षक संख्या (प्रकारमा आधारित)</span>
                <span class="badge bg-primary rounded-pill">{{ $teacherCountsByType->sum('total') }}</span>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach($teacherCountsByType as $type)
                    <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                        <span>{{ $type->type ?? 'Unknown' }}</span>
                        <span class="fw-bold">
                            {{ $type->total }} <small class="text-muted">({{ round(($type->total / $totalTeachers) * 100, 1) }}%)</small>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Level Breakdown -->
    <div class="col-lg-4 mb-2">
        <div class="card h-100">
            <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
                <span>शिक्षक संख्या (तहमा आधारित)</span>
                <span class="badge bg-primary rounded-pill">{{ $teacherCountsByLevel->sum('total') }}</span>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach($teacherCountsByLevel as $level)
                    <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                        <span>{{ $level->level ?? 'Unknown' }}</span>
                        <span class="fw-bold">
                            {{ $level->total }} <small class="text-muted">({{ round(($level->total / $totalTeachers) * 100, 1) }}%)</small>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Breakdown -->
    <div class="col-lg-4 mb-2">
        <div class="card h-100">
            <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
                <span>विस्तृतमा</span>
                <span class="badge bg-primary rounded-pill">{{ $teacherCounts->sum('total') }}</span>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush small">
                    @foreach($teacherCounts as $count)
                    <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                        <span class="d-flex align-items-center">
                            <span class="text-truncate d-inline-block" style="max-width: 80px">{{ $count->type ?? 'Unknown' }}</span>
                            |
                            <span>{{ $count->level ?? 'Unknown' }}</span>
                        </span>
                        <span class="fw-bold">{{ $count->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Responsive chart function
    function createChart(id, labels, data, colors) {
        const ctx = document.getElementById(id).getContext('2d');
        const total = {{ $totalTeachers }};
        
        return new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    borderWidth: 0
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: window.innerWidth < 768 ? 'bottom' : 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 12,
                            font: {
                                size: window.innerWidth < 768 ? 10 : 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: (ctx) => {
                                return `${ctx.label}: ${ctx.raw} (${Math.round((ctx.raw/total)*100)}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Create charts
    const typeChart = createChart(
        'typeChart',
        {!! json_encode($teacherCountsByType->pluck('type')) !!},
        {!! json_encode($teacherCountsByType->pluck('total')) !!},
        ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796']
    );

    const levelChart = createChart(
        'levelChart',
        {!! json_encode($teacherCountsByLevel->pluck('level')) !!},
        {!! json_encode($teacherCountsByLevel->pluck('total')) !!},
        ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796']
    );

    // Handle window resize
    window.addEventListener('resize', function() {
        typeChart.options.plugins.legend.position = window.innerWidth < 768 ? 'bottom' : 'right';
        levelChart.options.plugins.legend.position = window.innerWidth < 768 ? 'bottom' : 'right';
        typeChart.update();
        levelChart.update();
    });
});
</script>

<style>
    /* Ensure charts don't overflow on small screens */
    .chart-container {
        position: relative;
        width: 100%;
        min-width: 100px;
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 0.5rem !important;
        }
        .list-group-item {
            padding: 0.5rem 0.75rem !important;
        }
    }
</style>