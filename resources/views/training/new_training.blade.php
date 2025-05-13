@extends('layout.app')

@section('title')
    नयाँ तालिम | {{$teacher->name}} | {{ config('app.name') }}
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
        <li class="breadcrumb-item"><a href="{{ route('schools') }}">विद्यालय</a></li>
        <li class="breadcrumb-item"><a href="{{ route('school', ['id' => $teacher->user->id]) }}">{{$teacher->user->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teacher', ['id' => $teacher->id]) }}">{{$teacher->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">नयाँ तालिम</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>नयाँ तालिम | {{$teacher->name}} | {{ config('app.name') }}</h4>
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
                <label for="training_type" class="form-label">तालिमको प्रकार <span class="text-danger fw-bold">*</span></label>
                <select class="form-select @error('training_type') is-invalid @enderror" id="training_type" name="training_type">
                    <option value="{{ old('training_type') ?? '' }}">{{ old('training_type') ?? 'छान्नुहोस' }}</option>
                    <option value="दश महिने">दश महिने</option>
                    <option value="आई. एड.">आई. एड.</option>
                    <option value="वि. एड.">वि. एड.</option>
                    <option value="एम. एड.">एम. एड.</option>
                    <option value="अन्य">अन्य</option>
                </select>
                @error('training_type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="completed_date" class="form-label">सम्पन्न मिति <span class="text-danger fw-bold">*</span></label>
                <input type="string" class="form-control" id="completed_date" name="completed_date" value="{{ old('completed_date') }}">
                @error('completed_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="remarks" class="form-label">कैफियत</label>
                <input type="string" class="form-control" id="remarks" name="remarks" value="{{ old('remarks') }}">
                @error('remarks')
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
$("#completed_date").nepaliDatePicker({
    dateFormat: "%y-%m-%d",
    closeOnDateSelect: true
});
</script>


@endsection
