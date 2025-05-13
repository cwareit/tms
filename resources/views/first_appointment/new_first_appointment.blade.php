@extends('layout.app')

@section('title')
    नयाँ सुरु नियुक्ति | {{$teacher->name}} | {{ config('app.name') }}
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
        <li class="breadcrumb-item"><a href="{{ route('schools') }}">विद्यालय</a></li>
        <li class="breadcrumb-item"><a href="{{ route('school', ['id' => $teacher->user->id]) }}">{{$teacher->user->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teacher', ['id' => $teacher->id]) }}">{{$teacher->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">नयाँ सुरु नियुक्ति</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>नयाँ सुरु नियुक्ति | {{$teacher->name}} | {{ config('app.name') }}</h4>
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
                        <label class="form-label">प्रकार <span class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                            <option value="{{ old('type') ?? '' }}">{{ old('type') ?? 'छान्नुहोस' }}</option>
                            <option value="स्थायी">स्थायी</option>
                            <option value="करार">करार</option>
                            <option value="अस्थायी">अस्थायी</option>
                            <option value="राहत">राहत</option>
                            <option value="अनुदान">अनुदान</option>
                            <option value="अन्य">अन्य</option>
                        </select>
                        @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



              <!-- Level -->
      
                    <div class="mb-3">
                        <label for="level" class="form-label">तह <span class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('level') is-invalid @enderror" id="level" name="level">
                            <option value="{{old('level') ?? ''}}">{{old('level') ?? 'छान्नुहोस'}}</option>
                            <option value="वाल कक्षा">वाल कक्षा</option>
                            <option value="आ. वि. (१-५)">आ. वि. (१-५)</option>
                            <option value="आ. वि. (६-८)">आ. वि. (६-८)</option>
                            <option value="मा. वि. (९-१०)">मा. वि. (९-१०)</option>
                            <option value="मा. वि. (११-१२)">मा. वि. (११-१२)</option>
                            <option value="अन्य">अन्य</option>
                        </select>
                        @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
              
                <!-- Class -->
             
                    <div class="mb-3">
                        <label for="class" class="form-label">श्रेणी <span class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('class') is-invalid @enderror" id="class" name="class">
                            <option value="{{old('class') ?? ''}}">{{old('class') ?? 'छान्नुहोस'}}</option>
                            <option value="प्रथम">प्रथम</option>
                            <option value="द्वितिय">द्वितिय</option>
                            <option value="तृतिय">तृतिय</option>
                            <option value="अन्य">अन्य</option>
                        </select>
                        @error('class')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            

            <div class="mb-3">
                <label for="date" class="form-label">मिति <span class="text-danger fw-bold">*</span></label>
                <input type="string" class="form-control" id="date" name="date" value="{{ old('date') }}">
                @error('date')
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
$("#date").nepaliDatePicker({
    dateFormat: "%y-%m-%d",
    closeOnDateSelect: true
});
</script>


@endsection
