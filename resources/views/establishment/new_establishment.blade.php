@extends('layout.app')

@section('title')
    नयाँ स्थापना/ईजाजत | {{$school->name}} | {{ config('app.name') }}
@endsection


@section('beardcrumb')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
    <li class="breadcrumb-item"><a href="{{route('schools')}}">विद्यालय</a></li>
    <li class="breadcrumb-item"><a href="{{route('school', ['id' => $school->id])}}">{{$school->name}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">नयाँ स्थापना/ईजाजत</li>
  </ol>
</nav>

@endsection






@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>नयाँ स्थापना/ईजाजत | {{$school->name}} | {{ config('app.name') }}</h4>
    </div>
    <div class="card-body">

    <p class="text-muted">
    <small>
        <span class="text-danger fw-bold">*</span> चिन्ह लागेका महलहरु अनिवार्य छन् ।
    </small>
</p>
        <form method="post" action="{{route('new_establishment', ['school_id' => $school->id])}}">
            @csrf
            <div class="mb-3">
                <label for="establishment_type" class="form-label">प्रकार  <span class="text-danger fw-bold">*</span></label>
                <select class="form-control" name="establishment_type">
                    <option value="{{old('establishment_type' ?? '')}}">{{old('establishment_type') ?? 'छान्नुहोस'}}</option>
                    <option value="स्थापना">स्थापना</option>
                    <option value="ईजाजत">ईजाजत</option>
                </select>
                @error('establishment_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="establishment_level" class="form-label">तह  <span class="text-danger fw-bold">*</span></label>
                <select class="form-control" name="school_level">
                    <option value="{{old('school_level') ?? ''}}">{{old('school_level') ?? 'छान्नुहोस' }}</option>
                    <option value="वाल कक्षा">वाल कक्षा</option>
                    <option value="आ. वि. (१-५)">आ. वि. (१-५)</option>
                    <option value="आ. वि. (६-८)">आ. वि. (६-८)</option>
                    <option value="मा. वि. (९-१०)">मा. वि. (९-१०)</option>
                    <option value="मा. वि. (११-१२)">मा. वि. (११-१२)</option>
                </select>
                @error('school_level')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">मिति  <span class="text-danger fw-bold">*</span></label>
                <input type="string" class="form-control" id="date" name="date" value="{{old('date')}}">
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary rounded-0 w-100">थप्नुहोस</button>
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
