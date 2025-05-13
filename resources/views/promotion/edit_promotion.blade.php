@extends('layout.app')

@section('title')
    बढुवा अपडेट | {{$promotion->teacher->name}} | {{ config('app.name') }}
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
        <li class="breadcrumb-item"><a href="{{ route('schools') }}">विद्यालय</a></li>
        <li class="breadcrumb-item"><a href="{{ route('school', ['id' => $promotion->teacher->user->id]) }}">{{$promotion->teacher->user->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teacher', ['id' => $promotion->teacher->id]) }}">{{$promotion->teacher->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">बढुवा अपडेट</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>बढुवा अपडेट | {{$promotion->teacher->name}} | {{ config('app.name') }}</h4>
    </div>
    <div class="card-body">
        <p class="text-muted">
            <small>
                <span class="text-danger fw-bold">*</span> चिन्ह लागेका महलहरु अनिवार्य छन् ।
            </small>
        </p>

        <form method="post" action="#">
            @csrf
     

            <!-- Type -->
            <div class="mb-3">
                <label for="type" class="form-label">प्रकार <span class="text-danger fw-bold">*</span></label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                    <option value="">छान्नुहोस</option>
                    <option value="७५% फायल बढुवा" {{ $promotion->type == '७५% फायल बढुवा' ? 'selected' : '' }}>७५% फायल बढुवा</option>
                    <option value="२५% आन्तरिक बढुवा" {{ $promotion->type == '२५% आन्तरिक बढुवा' ? 'selected' : '' }}>२५% आन्तरिक बढुवा</option>
                    <option value="बिशेष बढुवा" {{ $promotion->type == 'बिशेष बढुवा' ? 'selected' : '' }}>बिशेष बढुवा</option>
                    <option value="अन्य" {{ $promotion->type == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                </select>
                @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Level -->
            <div class="mb-3">
                <label for="level" class="form-label">तह <span class="text-danger fw-bold">*</span></label>
                <select class="form-select @error('level') is-invalid @enderror" id="level" name="level">
                    <option value="">छान्नुहोस</option>
                    <option value="वाल कक्षा" {{ $promotion->level == 'वाल कक्षा' ? 'selected' : '' }}>वाल कक्षा</option>
                    <option value="आ. वि. (१-५)" {{ $promotion->level == 'आ. वि. (१-५)' ? 'selected' : '' }}>आ. वि. (१-५)</option>
                    <option value="आ. वि. (६-८)" {{ $promotion->level == 'आ. वि. (६-८)' ? 'selected' : '' }}>आ. वि. (६-८)</option>
                    <option value="मा. वि. (९-१०)" {{ $promotion->level == 'मा. वि. (९-१०)' ? 'selected' : '' }}>मा. वि. (९-१०)</option>
                    <option value="मा. वि. (११-१२)" {{ $promotion->level == 'मा. वि. (११-१२)' ? 'selected' : '' }}>मा. वि. (११-१२)</option>
                    <option value="अन्य" {{ $promotion->level == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                </select>
                @error('level')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Class -->
            <div class="mb-3">
                <label for="class" class="form-label">श्रेणी <span class="text-danger fw-bold">*</span></label>
                <select class="form-select @error('class') is-invalid @enderror" id="class" name="class">
                    <option value="">छान्नुहोस</option>
                    <option value="प्रथम" {{ $promotion->class == 'प्रथम' ? 'selected' : '' }}>प्रथम</option>
                    <option value="द्वितिय" {{ $promotion->class == 'द्वितिय' ? 'selected' : '' }}>द्वितिय</option>
                    <option value="तृतिय" {{ $promotion->class == 'तृतिय' ? 'selected' : '' }}>तृतिय</option>
                    <option value="अन्य" {{ $promotion->class == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                </select>
                @error('class')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date -->
            <div class="mb-3">
                <label for="date" class="form-label">मिति <span class="text-danger fw-bold">*</span></label>
                <input type="string" class="form-control" id="date" name="date" value="{{ old('date', $promotion->date) }}">
                @error('date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remarks -->
            <div class="mb-3">
                <label for="remarks" class="form-label">कैफियत</label>
                <input type="string" class="form-control" id="remarks" name="remarks" value="{{ old('remarks', $promotion->remarks) }}">
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
$("#date").nepaliDatePicker({
    dateFormat: "%y-%m-%d",
    closeOnDateSelect: true
});
</script>
@endsection
