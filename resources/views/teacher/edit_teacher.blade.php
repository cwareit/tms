@extends('layout.app')
@section('title')
शिक्षक अपडेट गर्नुहोस् | {{$teacher->name}} | {{ config('app.name') }}
@endsection
@section('beardcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
        <li class="breadcrumb-item"><a href="{{route('schools')}}">विद्यालय</a></li>
        <li class="breadcrumb-item"><a href="{{route('school', ['id' => $teacher->user->id])}}">{{$teacher->user->name}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('teacher', ['id' => $teacher->id])}}">{{$teacher->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">शिक्षक अपडेट गर्नुहोस्</li>
    </ol>
</nav>
@endsection
@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>शिक्षक अपडेट गर्नुहोस् | {{$teacher->name}} | {{ config('app.name') }}</h4>
    </div>
    <div class="card-body">
        <p class="text-muted">
            <small>
            <span class="text-danger fw-bold">*</span> चिन्ह लागेका महलहरु अनिवार्य छन् ।
            </small>
        </p>
        <form method="post" action="#" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Name -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">नाम <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $teacher->name) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Gender -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label class="form-label">लिङ्ग <span class="text-danger fw-bold">*</span></label>
                        <div class="d-flex gap-3 @error('gender') is-invalid @enderror">
                            <!-- Add error class to container -->
                            <div class="form-check">
                                <input class="form-check-input @error('gender') is-invalid @enderror" 
                                type="radio" name="gender" id="male" value="पुरुष"
                                {{ old('gender', $teacher->gender) == 'पुरुष' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">पुरुष</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('gender') is-invalid @enderror" 
                                type="radio" name="gender" id="female" value="महिला"
                                {{ old('gender', $teacher->gender) == 'महिला' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">महिला</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('gender') is-invalid @enderror" 
                                type="radio" name="gender" id="other" value="अन्य"
                                {{ old('gender', $teacher->gender) == 'अन्य' ? 'checked' : '' }}>
                                <label class="form-check-label" for="other">अन्य</label>
                            </div>
                        </div>
                        @error('gender')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        <!-- Added d-block -->
                        @enderror
                    </div>
                </div>
                <!-- Level -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="level" class="form-label">तह <span class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('level') is-invalid @enderror" id="level" name="level">
                            <option value="{{old('level', $teacher->level) ?? ''}}">{{old('level', $teacher->level) ?? 'छान्नुहोस'}}</option>
                            <option value="वाल कक्षा" {{ old('level', $teacher->level) == 'वाल कक्षा' ? 'selected' : '' }}>वाल कक्षा</option>
                            <option value="आ. वि. (१-५)" {{ old('level', $teacher->level) == 'आ. वि. (१-५)' ? 'selected' : '' }}>आ. वि. (१-५)</option>
                            <option value="आ. वि. (६-८)" {{ old('level', $teacher->level) == 'आ. वि. (६-८)' ? 'selected' : '' }}>आ. वि. (६-८)</option>
                            <option value="मा. वि. (९-१०)" {{ old('level', $teacher->level) == 'मा. वि. (९-१०)' ? 'selected' : '' }}>मा. वि. (९-१०)</option>
                            <option value="मा. वि. (११-१२)" {{ old('level', $teacher->level) == 'मा. वि. (११-१२)' ? 'selected' : '' }}>मा. वि. (११-१२)</option>
                            <option value="अन्य" {{ old('level', $teacher->level) == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                        </select>
                        @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Class -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="class" class="form-label">श्रेणी <span class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('class') is-invalid @enderror" id="class" name="class">
                            <option value="{{old('class', $teacher->class) ?? ''}}">{{old('class', $teacher->class) ?? 'छान्नुहोस'}}</option>
                            <option value="प्रथम" {{ old('class', $teacher->class) == 'प्रथम' ? 'selected' : '' }}>प्रथम</option>
                            <option value="द्वितिय" {{ old('class', $teacher->class) == 'द्वितिय' ? 'selected' : '' }}>द्वितिय</option>
                            <option value="तृतिय" {{ old('class', $teacher->class) == 'तृतिय' ? 'selected' : '' }}>तृतिय</option>
                            <option value="अन्य" {{ old('class', $teacher->class) == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                        </select>
                        @error('class')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Province -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="province" class="form-label">प्रदेश <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province', $teacher->province) ?? config('app.province') }}">
                        @error('province')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- District -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="district" class="form-label">जिल्ला <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district', $teacher->district) ?? config('app.district') }}">
                        @error('district')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Municipality -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="municipality" class="form-label">स्थानिय तह <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('municipality') is-invalid @enderror" id="municipality" name="municipality" value="{{ old('municipality', $teacher->municipality) ?? config('app.municipality') }}">
                        @error('municipality')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Ward -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="ward" class="form-label">वडा नम्वर <span class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('ward') is-invalid @enderror" id="ward" name="ward">
                            <option value="{{old('ward', $teacher->ward) ?? ''}}">{{old('ward', $teacher->ward) ?? 'छान्नुहोस' }}</option>
                            @for ($i = 1; $i <= 35; $i++)
                            <option value="{{ $i }}" {{ old('ward', $teacher->ward) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('ward')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Is Technical -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label class="form-label">प्रकार <span class="text-danger fw-bold">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                            <option value="{{ old('type', $teacher->type) ?? '' }}">{{ old('type', $teacher->type) ?? 'छान्नुहोस' }}</option>
                            <option value="स्थायी" {{ old('type', $teacher->type) == 'स्थायी' ? 'selected' : '' }}>स्थायी</option>
                            <option value="करार" {{ old('type', $teacher->type) == 'करार' ? 'selected' : '' }}>करार</option>
                            <option value="अस्थायी" {{ old('type', $teacher->type) == 'अस्थायी' ? 'selected' : '' }}>अस्थायी</option>
                            <option value="राहत" {{ old('type', $teacher->type) == 'राहत' ? 'selected' : '' }}>राहत</option>
                            <option value="अनुदान" {{ old('type', $teacher->type) == 'अनुदान' ? 'selected' : '' }}>अनुदान</option>
                            <option value="अन्य" {{ old('type', $teacher->type) == 'अन्य' ? 'selected' : '' }}>अन्य</option>
                        </select>
                        @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Sheetroll Number -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="sheetroll_number" class="form-label">सिटरोल नम्बर</label>
                        <input type="text" class="form-control @error('sheetroll_number') is-invalid @enderror" id="sheetroll_number" name="sheetroll_number" value="{{ old('sheetroll_number', $teacher->sheetroll_number) }}">
                        @error('sheetroll_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- EPF Number -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="epf_number" class="form-label">संचयकोष नम्बर</label>
                        <input type="text" class="form-control @error('epf_number') is-invalid @enderror" id="epf_number" name="epf_number" value="{{ old('epf_number', $teacher->epf_number) }}">
                        @error('epf_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- License Number -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="license_number" class="form-label">अध्यापन अनुमतिपत्र नम्बर <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('license_number') is-invalid @enderror" id="license_number" name="license_number" value="{{ old('license_number', $teacher->license_number) }}">
                        @error('license_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Insurance Number -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="insurance_number" class="form-label">बीमा नम्बर</label>
                        <input type="text" class="form-control @error('insurance_number') is-invalid @enderror" id="insurance_number" name="insurance_number" value="{{ old('insurance_number', $teacher->insurance_number) }}">
                        @error('insurance_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- DOB in Certificate -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="dob_in_certificate" class="form-label">प्रमाणपत्रमा जन्म मिति <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('dob_in_certificate') is-invalid @enderror" id="dob_in_certificate" name="dob_in_certificate" value="{{ old('dob_in_certificate', $teacher->dob_in_certificate) }}">
                        @error('dob_in_certificate')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- DOB in Citizenship -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="dob_in_citizenship" class="form-label">नागरिकतामा जन्म मिति <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('dob_in_citizenship') is-invalid @enderror" id="dob_in_citizenship" name="dob_in_citizenship" value="{{ old('dob_in_citizenship', $teacher->dob_in_citizenship) }}">
                        @error('dob_in_citizenship')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Latest Qualification -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="latest_qualification" class="form-label">पछिल्लो शैक्षिक योग्यता <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('latest_qualification') is-invalid @enderror" id="latest_qualification" name="latest_qualification" value="{{ old('latest_qualification', $teacher->latest_qualification) }}">
                        @error('latest_qualification')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Latest Appointment Date -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="first_appointment_date" class="form-label">सुरु नियुक्ति मिति <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('first_appointment_date') is-invalid @enderror" id="first_appointment_date" name="first_appointment_date" value="{{ old('first_appointment_date', $teacher->first_appointment_date) }}">
                        @error('first_appointment_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Studied Subject -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="studied_subject" class="form-label">अध्ययन गरेको विषय <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('studied_subject') is-invalid @enderror" id="studied_subject" name="studied_subject" value="{{ old('studied_subject', $teacher->studied_subject) }}">
                        @error('studied_subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Appointment Subject -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="appointment_subject" class="form-label">नियुक्ति भएको विषय</label>
                        <input type="text" class="form-control @error('appointment_subject') is-invalid @enderror" id="appointment_subject" name="appointment_subject" value="{{ old('appointment_subject', $teacher->appointment_subject) }}">
                        @error('appointment_subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Teaching Subject -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="teaching_subject" class="form-label">अध्यापन गरिरहेको विषय</label>
                        <input type="text" class="form-control @error('teaching_subject') is-invalid @enderror" id="teaching_subject" name="teaching_subject" value="{{ old('teaching_subject', $teacher->teaching_subject) }}">
                        @error('teaching_subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Account Number -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="account_number" class="form-label">बैंक खाता नम्बर</label>
                        <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" value="{{ old('account_number', $teacher->account_number) }}">
                        @error('account_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Phone Number -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">फोन नम्बर <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $teacher->phone_number) }}">
                        @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Email -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="email" class="form-label">इमेल</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $teacher->email) }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="photo" class="form-label">फोटो</label>

                        @if($teacher->photo !== 'no_photo.png')
                        <div class="mt-2">
                            <img src="{{ asset('images/teachers/'.$teacher->photo) }}" alt="Current Photo" width="100" class="img-thumbnail">
                            <a onclick = "return confirm('के तपाईँ साच्चै यो तश्वीर डिलिट गर्न चाहनुहुन्छ?')" class="btn btn-danger btn-sm ms-3" href="{{route('delete_photo', ['id' => $teacher->id])}}"> डिलिट गर्नुहोस</a>
                        </div>

                       
                        @else

                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                        @endif
                        @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary rounded-0 w-100">अपडेट गर्नुहोस</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    // Common configuration for both date pickers
    const nepaliDatePickerConfig = {
        dateFormat: "%y-%m-%d",
        closeOnDateSelect: true
    };

    // Initialize both date pickers in one line each
    $("#dob_in_certificate, #dob_in_citizenship, #first_appointment_date").nepaliDatePicker(nepaliDatePickerConfig);
</script>
@endsection