@extends('layout.app')

@section('title')
    विद्यालय अपडेट | {{ config('app.name') }}
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
        <li class="breadcrumb-item"><a href="{{ route('schools') }}">विद्यालय</a></li>
        <li class="breadcrumb-item"><a href="{{ route('school', ['id' => $school->id]) }}">{{ $school->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">विद्यालय अपडेट</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>विद्यालय अपडेट | {{ config('app.name') }}</h4>
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $school->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="iemis_code" class="form-label">IEMIS कोड <span class="text-danger fw-bold">*</span></label>
                <input type="text" class="form-control @error('iemis_code') is-invalid @enderror" id="iemis_code" name="iemis_code" value="{{ old('iemis_code', $school->iemis_code) }}">
                @error('iemis_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">विद्यालयको प्रकार <span class="text-danger fw-bold">*</span></label>
                <div>
                    @foreach(['आ. वि. (१-५)', 'आ. वि. (६-८)', 'मा. (९-१०)', 'मा. (११-१२)'] as $type)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="school_type" id="school_type_{{ $type }}" value="{{ $type }}" {{ old('school_type', $school->school_type) == $type ? 'checked' : '' }}>
                            <label class="form-check-label" for="school_type_{{ $type }}">{{ $type }}</label>
                        </div>
                    @endforeach
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
                                <label for="province" class="form-label">प्रदेश <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province', $school->province) }}">
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="district" class="form-label">जिल्ला <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district', $school->district) }}">
                                @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="municipality" class="form-label">स्थानिय तह <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control @error('municipality') is-invalid @enderror" id="municipality" name="municipality" value="{{ old('municipality', $school->municipality) }}">
                                @error('municipality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="ward" class="form-label">वडा नम्वर <span class="text-danger fw-bold">*</span></label>
                                <select class="form-select @error('ward') is-invalid @enderror" id="ward" name="ward">
                                    <option value="">छान्नुहोस</option>
                                    @for ($i = 1; $i <= config('app.wardCount'); $i++)
                                        <option value="{{ $i }}" {{ old('ward', $school->ward) == $i ? 'selected' : '' }}>{{ $i }}</option>
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
                        @foreach(['d1' => 'प्रा. (१-५)', 'd2' => 'नि. मा. (६-८)', 'd3' => 'मा. (९-१०)', 'd4' => 'मा. (११-१२)'] as $key => $label)
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="{{ $key }}" class="form-label">{{ $label }} <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control @error($key) is-invalid @enderror" id="{{ $key }}" name="{{ $key }}" value="{{ old($key, $school->$key ?? 0) }}">
                                    @error($key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="relief_positions" class="form-label">राहत दरवन्दी</label>
                <div class="card-header rounded">
                    <div class="row">
                        @foreach(['rd1' => 'प्रा. (१-५)', 'rd2' => 'नि. मा. (६-८)', 'rd3' => 'मा. (९-१०)', 'rd4' => 'मा. (११-१२)'] as $key => $label)
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="{{ $key }}" class="form-label">{{ $label }} <span class="text-danger fw-bold">*</span></label>
                                    <input type="text" class="form-control @error($key) is-invalid @enderror" id="{{ $key }}" name="{{ $key }}" value="{{ old($key, $school->$key ?? 0) }}">
                                    @error($key)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-0">अपडेट गर्नुहोस</button>
        </form>
    </div>
</div>
@endsection
