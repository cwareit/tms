@extends('layout.app')

@section('title')
    असाधारण विदा अपडेट | {{$uleave->teacher->name}} | {{ config('app.name') }}
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
        <li class="breadcrumb-item"><a href="{{ route('schools') }}">विद्यालय</a></li>
        <li class="breadcrumb-item"><a href="{{ route('school', ['id' => $uleave->teacher->user->id]) }}">{{$uleave->teacher->user->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teacher', ['id' => $uleave->teacher->id]) }}">{{$uleave->teacher->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">असाधारण विदा अपडेट</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>असाधारण विदा अपडेट | {{$uleave->teacher->name}} | {{ config('app.name') }}</h4>
    </div>
    <div class="card-body">
        <p class="text-muted">
            <small>
                <span class="text-danger fw-bold">*</span> चिन्ह लागेका महलहरु अनिवार्य छन् ।
            </small>
        </p>

        <form method="post" action="#">
            @csrf
  

            <div class="mb-3">
                <label for="leave_from" class="form-label">मिति देखि<span class="text-danger fw-bold">*</span></label>
                <input type="string" class="form-control" id="leave_from" name="leave_from" value="{{ old('leave_from', $uleave->leave_from) }}">
                @error('leave_from')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="leave_to" class="form-label">मिति सम्म<span class="text-danger fw-bold">*</span></label>
                <input type="string" class="form-control" id="leave_to" name="leave_to" value="{{ old('leave_to', $uleave->leave_to) }}">
                @error('leave_to')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="remarks" class="form-label">कैफियत</label>
                <input type="string" class="form-control" id="remarks" name="remarks" value="{{ old('remarks', $uleave->remarks) }}">
                @error('remarks')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary rounded-0 w-100">अपडेट गर्नुहोस्</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    // Common configuration for both date pickers
    const nepaliDatePickerConfig = {
        dateFormat: "%y-%m-%d",
        closeOnDateSelect: true
    };

    // Initialize both date pickers in one line each
    $("#leave_from, #leave_to").nepaliDatePicker(nepaliDatePickerConfig);
</script>
@endsection
