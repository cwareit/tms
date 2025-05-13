@extends('layout.guest')

@section('title')
रजिष्टर | {{ config('app.name') }}
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <div class="card">
        <div class="card-header text-center">
            <h4>रजिष्टर | {{ config('app.name') }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register_action') }}">
                @csrf
                <div class="mb-3">
                    <label for="registration_key" class="form-label">रजिष्ट्रेशन कि</label>
                    <input type="password" class="form-control @error('registration_key') is-invalid @enderror" id="registration_key" name="registration_key" value="{{ old('registration_key') }}">
                    @error('registration_key')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">नाम</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">ईमेल</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">पासवर्ड</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_again" class="form-label">पासवर्ड (फेरि)</label>
                    <input type="password" class="form-control @error('password_again') is-invalid @enderror" id="password_again" name="password_again">
                    @error('password_again')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-0">रजिष्टर</button>
            </form>
        </div>
    </div>
@endsection
