@extends('layout.app')

@section('title')
    {{ $school->name }} | {{ config('app.name') }}
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
@endsection

@section('beardcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
            <li class="breadcrumb-item"><a href="{{ route('schools') }}">विद्यालय</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $school->name }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
        <button onclick="return window.print()" class="btn btn-primary d-print-none float-end">प्रिन्ट गर्नुहोस</button>
            <h4>{{ $school->name }} | {{ config('app.name') }}</h4>
        </div>
        <div class="card-body">
            <!-- Compact School Information Layout -->
            <div class="d-flex justify-content-between align-items-center bg-info text-white p-2 mb-2">
                <div class="fw-bold">परिचय</div>
                <a href="{{ route('edit_school', ['id' => $school->id]) }}" class="btn btn-sm btn-light rounded-0 d-print-none">
                    <i class="fas fa-edit"></i>
                </a>
            </div>

            <div class="row g-2 mb-2">
                <!-- Column 1: Basic Info -->
                <div class="col-md-4">
                    <div class="border p-2 h-100">
                        <div class="d-flex mb-1">
                            <span class="text-muted flex-shrink-0" style="width: 100px;">नाम:</span>
                            <span class="fw-bold">{{ $school->name }}</span>
                        </div>
                        <div class="d-flex mb-1">
                            <span class="text-muted flex-shrink-0" style="width: 100px;">IEMIS कोड:</span>
                            <span class="fw-bold">{{ $school->iemis_code }}</span>
                        </div>
                        <div class="d-flex mb-1">
                            <span class="text-muted flex-shrink-0" style="width: 100px;">प्रकार:</span>
                            <span class="fw-bold">{{ $school->school_type }}</span>
                        </div>
                        <div class="d-flex">
                            <span class="text-muted flex-shrink-0" style="width: 100px;">ठेगाना:</span>
                            <span class="fw-bold">{{ $school->municipality }} - {{ $school->ward }}, {{ $school->district }}</span>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Grade Structure -->
                <div class="col-md-4">
                    <div class="border p-2 h-100">
                        <div class="text-center fw-bold small mb-1">दरवन्दी संरचना</div>
                        <div class="row g-1 text-center">
                            <div class="col-3">
                                <div class="border p-1">
                                    <div class="text-muted x-small">१-५</div>
                                    <div class="fw-bold">{{ $school->d1 }}</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border p-1">
                                    <div class="text-muted x-small">६-८</div>
                                    <div class="fw-bold">{{ $school->d2 }}</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border p-1">
                                    <div class="text-muted x-small">९-१०</div>
                                    <div class="fw-bold">{{ $school->d3 }}</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border p-1">
                                    <div class="text-muted x-small">११-१२</div>
                                    <div class="fw-bold">{{ $school->d4 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Relief Structure -->
                <div class="col-md-4">
                    <div class="border p-2 h-100">
                        <div class="text-center fw-bold small mb-1">राहत दरवन्दी</div>
                        <div class="row g-1 text-center">
                            <div class="col-3">
                                <div class="border p-1">
                                    <div class="text-muted x-small">१-५</div>
                                    <div class="fw-bold">{{ $school->rd1 }}</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border p-1">
                                    <div class="text-muted x-small">६-८</div>
                                    <div class="fw-bold">{{ $school->rd2 }}</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border p-1">
                                    <div class="text-muted x-small">९-१०</div>
                                    <div class="fw-bold">{{ $school->rd3 }}</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border p-1">
                                    <div class="text-muted x-small">११-१२</div>
                                    <div class="fw-bold">{{ $school->rd4 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('school.include.statistics')
            @include('school.include.teacher')
            @include('school.include.establishment')
            @include('school.include.bank')
        </div>
    </div>
@endsection
