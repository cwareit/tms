@extends('layout.app')

@section('title')
    तालिम अपडेट | {{$training->teacher->name}} | {{ config('app.name') }}
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
        <li class="breadcrumb-item"><a href="{{ route('schools') }}">विद्यालय</a></li>
        <li class="breadcrumb-item"><a href="{{ route('school', ['id' => $training->teacher->user->id]) }}">{{$training->teacher->user->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teacher', ['id' => $training->teacher->id]) }}">{{$training->teacher->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">तालिम अपडेट</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>तालिम अपडेट | {{$training->teacher->name}} | {{ config('app.name') }}</h4>
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
                    <option value="">छान्नुहोस</option>
                    <option value="दश महिने" {{ old('training_type', $training->training_type) == 'दश महिने' ? 'selected' : '' }}>दश महिने</option>
                    <option value="आई. एड." {{ old('training_type', $training->training_type) == 'आई. एड.' ? 'selected' : '' }}>आई. एड.</option>
                    <option value="वि. एड." {{ old('training_type', $training->training_type) == 'वि. एड.' ? 'selected' : '' }}>वि. एड.</option>
                    <option value="एम. एड." {{ old('training_type', $training->training_type) == 'एम. एड.' ? 'selected' : '' }}>एम. एड.</option>
                    <option value="अन्य" {{ old('training_type', $training->training_type) == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                </select>
                @error('training_type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="completed_date" class="form-label">सम्पन्न मिति <span class="text-danger fw-bold">*</span></label>
                <input type="string" class="form-control" id="completed_date" name="completed_date" value="{{ old('completed_date', $training->completed_date) }}">
                @error('completed_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="remarks" class="form-label">कैफियत</label>
                <input type="string" class="form-control" id="remarks" name="remarks" value="{{ old('remarks', $training->remarks) }}">
                @error('remarks')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary rounded-0 w-100">अपडेट गर्नुहोस</button>
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
