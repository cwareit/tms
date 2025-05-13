@extends('layout.guest')

@section('title')
लगईन | {{ config('app.name') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h4>लगईन | {{ config('app.name') }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login_action') }}">
                @csrf
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
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">सम्झनुहोस</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-0">लगईन</button>
            </form>
        </div>
    </div>
@endsection
