@extends('layout.app')

@section('title')
    {{ $teacher->name }} | {{ config('app.name') }}
@endsection

@section('beardcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
            <li class="breadcrumb-item"><a href="{{ route('schools') }}">विद्यालय</a></li>
            <li class="breadcrumb-item"><a href="{{ route('school', ['id' => $teacher->user->id]) }}">{{ $teacher->user->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $teacher->name }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">
        <button onclick="return window.print()" class="btn btn-primary d-print-none float-end">प्रिन्ट गर्नुहोस</button>
            <h4>{{ $teacher->name }} | {{ config('app.name') }}</h4>
        </div>
        <div class="card-body">
        <div class="bg-info fw-bold text-white mb-2 py-1 px-2">
                <div class="row">
                    <div class="col">परिचय</div>
                    <div class="col text-end">
                        <a href="{{ route('edit_teacher', ['id' => $teacher->id]) }}" class="btn btn-sm btn-secondary rounded-0 d-print-none">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            </div>
           


         
  <div class="d-flex align-items-center bg-light p-3 border rounded mb-2">
    <!-- Teacher Photo -->
    <div class="flex-shrink-0">
      <img src="{{ asset('images/teachers/' . $teacher->photo) }}" 
           alt="Teacher Photo" 
           class="img-thumbnail me-3" 
           style="width: 80px; height: 80px; object-fit: cover;">
    </div>
    
    <!-- Teacher Info -->
    <div class="flex-grow-1">
      <div class="d-flex flex-wrap align-items-center justify-content-between">
        <!-- Names Section -->
        <div class="mb-2 mb-md-0">
          <h5 class="mb-0 fw-bold">{{ $teacher->user->name }}</h5>
          @if($teacher->name && $teacher->name != $teacher->user->name)
            <small class="text-muted">{{ $teacher->name }}</small>
          @endif
        </div>
        
        <!-- Age Info -->
        <div class="bg-white px-3 py-1 rounded border">
          <span class="text-primary">
            <i class="fas fa-birthday-cake me-1"></i>
            साठि बर्ष {{ $is_future ? 'पुग्न' : 'पुगेको' }}: 
            <span class="fw-bold text-danger">{{ $sixty_years }}</span>
          </span>
        </div>
      </div>
    </div>
  </div>





            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td><strong>नाम:</strong></td>
                                <td>{{ $teacher->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>लिङ्ग:</strong></td>
                                <td>{{ $teacher->gender }}</td>
                            </tr>
                            <tr>
                                <td><strong>ठेगाना:</strong></td>
                                <td>{{ $teacher->municipality }} - {{ $teacher->ward }}, {{ $teacher->district }}, {{ $teacher->province }} प्रदेश</td>
                            </tr>
                            <tr>
                                <td><strong>प्रकार:</strong></td>
                                <td>{{ $teacher->type }}</td>
                            </tr>
                            <tr>
                                <td><strong>स्तर:</strong></td>
                                <td>{{ $teacher->level }}</td>
                            </tr>
                            <tr>
                                <td><strong>कक्षा:</strong></td>
                                <td>{{ $teacher->class }}</td>
                            </tr>
                            <tr>
                                <td><strong>शिट रोल नम्बर:</strong></td>
                                <td>{{ $teacher->sheetroll_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>ईपीएफ नम्बर:</strong></td>
                                <td>{{ $teacher->epf_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>लाइसेन्स नम्बर:</strong></td>
                                <td>{{ $teacher->license_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>बीमा नम्बर:</strong></td>
                                <td>{{ $teacher->insurance_number }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td><strong>जन्म मिति (प्रमाणपत्रमा)</strong></td>
                                <td>{{ $teacher->dob_in_certificate }}</td>
                            </tr>
                            <tr>
                                <td><strong>जन्म मिति (नागरिकतामा)</strong></td>
                                <td>{{ $teacher->dob_in_citizenship }}</td>
                            </tr>
                            <tr>
                                <td><strong>अन्तिम योग्यता</strong></td>
                                <td>{{ $teacher->latest_qualification }}</td>
                            </tr>
                            <tr>
                                <td><strong>अन्तिम नियुक्ति मिति</strong></td>
                                <td>{{ $teacher->first_appointment_date }}</td>
                            </tr>
                            <tr>
                                <td><strong>पढेको विषय</strong></td>
                                <td>{{ $teacher->studied_subject }}</td>
                            </tr>
                            <tr>
                                <td><strong>नियुक्ति भएको विषय</strong></td>
                                <td>{{ $teacher->appointment_subject }}</td>
                            </tr>
                            <tr>
                                <td><strong>पढाउने विषय</strong></td>
                                <td>{{ $teacher->teaching_subject }}</td>
                            </tr>
                            <tr>
                                <td><strong>खाता नम्बर</strong></td>
                                <td>{{ $teacher->account_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>फोन नम्बर</strong></td>
                                <td>{{ $teacher->phone_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>ईमेल</strong></td>
                                <td>{{ $teacher->email }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            @include('teacher.include.training')
            @include('teacher.include.first_appointment')
            @include('teacher.include.promotion')
            @include('teacher.include.uleave')
        </div>
    </div>
@endsection
