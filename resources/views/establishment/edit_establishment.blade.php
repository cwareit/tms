@extends('layout.app')

@section('title')
    स्थापना/ईजाजत अपडेट | {{$establishment->user->name}} | {{ config('app.name') }}
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
    <li class="breadcrumb-item"><a href="{{route('schools')}}">विद्यालय</a></li>
    <li class="breadcrumb-item"><a href="{{route('school', ['id' => $establishment->user->id])}}">{{$establishment->user->name}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">स्थापना/ईजाजत अपडेट</li>
  </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>स्थापना/ईजाजत अपडेट | {{$establishment->user->name}} | {{ config('app.name') }}</h4>
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
                <label for="establishment_type" class="form-label">प्रकार  <span class="text-danger fw-bold">*</span></label>
                <select class="form-control" name="establishment_type">
                    <option value="स्थापना" {{ old('establishment_type', $establishment->establishment_type) == 'स्थापना' ? 'selected' : '' }}>स्थापना</option>
                    <option value="ईजाजत" {{ old('establishment_type', $establishment->establishment_type) == 'ईजाजत' ? 'selected' : '' }}>ईजाजत</option>
                </select>
                @error('establishment_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="establishment_level" class="form-label">तह  <span class="text-danger fw-bold">*</span></label>
                <select class="form-control" name="school_level">
                    <option value="वाल कक्षा" {{ old('school_level', $establishment->school_level) == 'वाल कक्षा' ? 'selected' : '' }}>वाल कक्षा</option>
                    <option value="आ. वि. (१-५)" {{ old('school_level', $establishment->school_level) == 'आ. वि. (१-५)' ? 'selected' : '' }}>आ. वि. (१-५)</option>
                    <option value="आ. वि. (६-८)" {{ old('school_level', $establishment->school_level) == 'आ. वि. (६-८)' ? 'selected' : '' }}>आ. वि. (६-८)</option>
                    <option value="मा. वि. (९-१०)" {{ old('school_level', $establishment->school_level) == 'मा. वि. (९-१०)' ? 'selected' : '' }}>मा. वि. (९-१०)</option>
                    <option value="मा. वि. (११-१२)" {{ old('school_level', $establishment->school_level) == 'मा. वि. (११-१२)' ? 'selected' : '' }}>मा. वि. (११-१२)</option>
                </select>
                @error('school_level')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">मिति  <span class="text-danger fw-bold">*</span></label>
                <input type="string" class="form-control" id="date" name="date" value="{{ old('date', $establishment->date) }}">
                @error('date')
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
$("#date").nepaliDatePicker({
    dateFormat: "%y-%m-%d",
    closeOnDateSelect: true
});
</script>
@endsection
