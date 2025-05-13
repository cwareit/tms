@extends('layout.app')

@section('title')
    अपडेट पासवर्ड | {{ config('app.name') }}
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
        <li class="breadcrumb-item"><a href="{{ route('schools') }}">विद्यालय</a></li>
        <li class="breadcrumb-item"><a href="{{ route('school', ['id' => $school->id]) }}">{{ $school->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">अपडेट पासवर्ड</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>अपडेट पासवर्ड | {{ config('app.name') }}</h4>
    </div>
    <div class="card-body">
        <p class="text-muted">
            <small>
                <span class="text-danger fw-bold">*</span> चिन्ह लागेका महलहरु अनिवार्य छन् ।
            </small>
        </p>
        <form method="POST" action="#">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">नाम <span class="text-danger fw-bold">*</span></label>
                <input disabled type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $school->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="email" class="form-label">नाम <span class="text-danger fw-bold">*</span></label>
                <input disabled type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $school->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">पासवर्ड  <span class="text-danger fw-bold">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_again" class="form-label">पासवर्ड (फेरि)  <span class="text-danger fw-bold">*</span></label>
                <input type="password" class="form-control @error('password_again') is-invalid @enderror" id="password_again" name="password_again">
                @error('password_again')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-0">पासवर्ड अपडेट गर्नुहोस</button>
        </form>
    </div>
</div>
@endsection
