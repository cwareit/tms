@extends('layout.app')

@section('title')
    नयाँ विद्यालय | {{ config('app.name') }}
@endsection




@section('beardcrumb')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
    <li class="breadcrumb-item"><a href="{{route('schools')}}">विद्यालय</a></li>
    <li class="breadcrumb-item active" aria-current="page">नयाँ विद्यालय</li>
  </ol>
</nav>

@endsection










@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>नयाँ विद्यालय | {{ config('app.name') }}</h4>
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
                <label for="name" class="form-label">नाम  <span class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="iemis_code" class="form-label">IEMIS कोड  <span class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control @error('iemis_code') is-invalid @enderror" id="iemis_code" name="iemis_code" value="{{ old('iemis_code') }}">
                @error('iemis_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">विद्यालयको प्रकार  <span class="text-danger fw-bold">*</span></label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input " type="radio" name="school_type" id="school_type1" value="आ. वि. (१-५)" {{ old('school_type') == 'आ. वि. (१-५)' ? 'checked' : '' }}>
                        <label class="form-check-label" for="school_type1">आ. वि. (१-५)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input " type="radio" name="school_type" id="school_type2" value="आ. वि. (६-८)" {{ old('school_type') == 'आ. वि. (६-८)' ? 'checked' : '' }}>
                        <label class="form-check-label" for="school_type2">आ. वि. (६-८)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input " type="radio" name="school_type" id="school_type3" value="मा. (९-१०)" {{ old('school_type') == 'मा. (९-१०)' ? 'checked' : '' }}>
                        <label class="form-check-label" for="school_type3">मा. (९-१०)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input " type="radio" name="school_type" id="school_type4" value="मा. (११-१२)" {{ old('school_type') == 'मा. (११-१२)' ? 'checked' : '' }}>
                        <label class="form-check-label" for="school_type4">मा. (११-१२)</label>
                    </div>
                    @error('school_type')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">ठेगाना</label>
                <div class="card-header rounded">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="province" class="form-label">प्रदेश  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province') ?? config('app.province') }}">
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="district" class="form-label">जिल्ला  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district') ?? config('app.district') }}">
                                @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="municipality" class="form-label">स्थानिय तह  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('municipality') is-invalid @enderror" id="municipality" name="municipality" value="{{ old('municipality') ?? config('app.municipality') }}">
                                @error('municipality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="ward" class="form-label">वडा नम्वर  <span class="text-danger fw-bold">*</span></label>
                                <select class="form-select @error('ward') is-invalid @enderror" id="ward" name="ward">
                                    <option value="">छान्नुहोस</option>
                                    @for ($i = 1; $i <= config('app.ward_count'); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('ward')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="approved_positions" class="form-label">स्विकृत दरवन्दी</label>
                <div class="card-header rounded">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="d1" class="form-label">प्रा. (१-५)  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('d1') is-invalid @enderror" id="d1" name="d1" value="{{ old('d1') ?? 0 }}">
                                @error('d1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="d2" class="form-label">नि. मा. (६-८)  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('d2') is-invalid @enderror" id="d2" name="d2" value="{{ old('d2') ?? 0 }}">
                                @error('d2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="d3" class="form-label">मा. (९-१०)  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('d3') is-invalid @enderror" id="d3" name="d3" value="{{ old('d3') ?? 0 }}">
                                @error('d3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="d4" class="form-label">मा. (११-१२)  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('d4') is-invalid @enderror" id="d4" name="d4" value="{{ old('d4') ?? 0 }}">
                                @error('d4')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="relief_positions" class="form-label">राहत दरवन्दी</label>
                <div class="card-header rounded">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="rd1" class="form-label">प्रा. (१-५)  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('rd1') is-invalid @enderror" id="rd1" name="rd1" value="{{ old('rd1') ?? 0 }}">
                                @error('rd1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="rd2" class="form-label">नि. मा. (६-८)  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('rd2') is-invalid @enderror" id="rd2" name="rd2" value="{{ old('rd2') ?? 0 }}">
                                @error('rd2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="rd3" class="form-label">मा. (९-१०)  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('rd3') is-invalid @enderror" id="rd3" name="rd3" value="{{ old('rd3') ?? 0 }}">
                                @error('rd3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="rd4" class="form-label">मा. (११-१२)  <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('rd4') is-invalid @enderror" id="rd4" name="rd4" value="{{ old('rd4') ?? 0 }}">
                                @error('rd4')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">ईमेल  <span class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
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
            <button type="submit" class="btn btn-primary w-100 rounded-0">थप गर्नुहोस</button>
        </form>
    </div>
</div>
@endsection
