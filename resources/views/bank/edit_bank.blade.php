@extends('layout.app')

@section('title')
    बैङ्क अपडेट | {{$bank->user->name}} | {{ config('app.name') }}
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
    <li class="breadcrumb-item"><a href="{{route('schools')}}">विद्यालय</a></li>
    <li class="breadcrumb-item"><a href="{{route('school', ['id' => $bank->user->id])}}">{{$bank->user->name}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">बैङ्क अपडेट</li>
  </ol>
</nav>
@endsection






@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>बैङ्क अपडेट | {{$bank->user->name}} | {{ config('app.name') }}</h4>
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
                <label for="name" class="form-label">नाम  <span class="text-danger fw-bold">*</span></label>
                <input type="string" class="form-control" id="name" name="name" value="{{old('name', $bank->name)}}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="branch" class="form-label">शाखा  <span class="text-danger fw-bold">*</span></label>
                <input type="string" class="form-control" id="branch" name="branch" value="{{old('branch', $bank->branch)}}">
                @error('branch')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="account_number" class="form-label">  <span class="text-danger fw-bold">*</span>खाता नम्बर</label>
                <input type="string" class="form-control" id="account_number" name="account_number" value="{{old('account_number', $bank->account_number)}}">
                @error('account_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary rounded-0 w-100">अपडेट गर्नुहोस्</button>
        </form>
    </div>
</div>
@endsection
