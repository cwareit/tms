@extends('layout.app')

@section('title')
    शिक्षक सरुवा गर्नुहोस् | {{$teacher->name}} | {{ config('app.name') }}
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
        <li class="breadcrumb-item"><a href="{{ route('schools') }}">विद्यालय</a></li>
        <li class="breadcrumb-item"><a href="{{ route('school', ['id' => $teacher->user->id]) }}">{{$teacher->user->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teacher', ['id' => $teacher->id]) }}">{{$teacher->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">शिक्षक सरुवा गर्नुहोस्</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>शिक्षक सरुवा गर्नुहोस् | {{$teacher->name}} | {{ config('app.name') }}</h4>
    </div>
   











    <div class="card-body">
    <!-- Transfer Warning Card -->
    <div class="alert alert-warning border-start border-5 border-warning bg-light-warning">
        <div class="d-flex align-items-center">
            <i class="fas fa-info-circle me-2 fs-4"></i>
            <div>
                <h6 class="alert-heading mb-1">स्थानिय तह भित्र मात्र सरुवा सम्भव</h6>
                <p class="mb-2">यस प्रणाली वाट शिक्षक सरुवा गर्दा यस स्थानिय तह भित्रका विद्यालयमा मात्र सरुवा गर्न सकिन्छ।</p>
                <a onclick="return confirm('के तपाईँ साँच्चै शिक्षक सम्बन्धि विवरण डिलिट गर्न चाहनुहुन्छ?')" 
                   href="{{ route('delete_teacher', ['id' => $teacher->id]) }}" 
                   class="btn btn-sm btn-outline-danger">
                   <i class="fas fa-trash-alt me-1"></i> डिलिट गर्नुहोस्
                </a>
            </div>
        </div>
    </div>

    <!-- Transfer Form -->
    <div class="transfer-form">
        <div class="row g-3">
            <!-- Current School -->
            <div class="col-md-4">
                <div class="card h-100 border-primary">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <i class="fas fa-school me-2"></i>
                        <span>हाल कार्यरत विद्यालय</span>
                    </div>
                    <div class="card-body">
                        <div class="school-info">
                            <h5 class="mb-1">{{$teacher->user->name}}</h5>
                            <div class="text-muted small">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{$teacher->user->municipality}} - {{$teacher->user->ward}}, {{$teacher->user->district}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transfer To -->
            <div class="col-md-4">
                <div class="card h-100 border-success">
                    <div class="card-header bg-success text-white d-flex align-items-center">
                        <i class="fas fa-exchange-alt me-2"></i>
                        <span>सरुवा जाने विद्यालय</span>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="school" class="form-label small text-muted">विद्यालय छान्नुहोस्</label>
                                <select name="school" id="school" class="form-select select2">
                                    <option value="">-- छान्नुहोस् --</option>
                                    @foreach ($schools as $school)
                                        <option value="{{$school->id}}">
                                            {{$school->name}} | {{$school->municipality}} - {{$school->ward}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('school')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>
                </div>
            </div>

            <!-- Transfer Action -->
            <div class="col-md-4">
                <div class="card h-100 border-warning">
                    <div class="card-header bg-warning text-dark d-flex align-items-center">
                        <i class="fas fa-paper-plane me-2"></i>
                        <span>सरुवा गर्नुहोस्</span>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <button class="btn btn-warning btn-transfer" 
                                onclick="return confirm('के तपाईँ साँच्चै शिक्षक सरुवा गर्न चाहनुहुन्छ?')">
                            <i class="fas fa-check-circle me-2"></i> सरुवा पुष्टि गर्नुहोस्
                        </button>
                    </div>
                </div>
                    </form>
            </div>
        </div>
    </div>
</div>

<!-- CSS Enhancements -->
<style>
    .transfer-form .card {
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .transfer-form .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .btn-transfer {
        font-weight: 500;
        padding: 0.5rem 1rem;
    }
    .school-info h5 {
        color: #2c3e50;
        font-weight: 600;
    }
    .select2 {
        width: 100%!important;
    }
</style>

<!-- JavaScript Enhancements -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize select2 for better dropdown
    $('.select2').select2({
        placeholder: "विद्यालय छान्नुहोस्",
        allowClear: true
    });
    
    // Add animation to transfer button
    $('.btn-transfer').hover(
        function() {
            $(this).find('i').addClass('fa-beat');
        },
        function() {
            $(this).find('i').removeClass('fa-beat');
        }
    );
});
</script>











</div>
@endsection
