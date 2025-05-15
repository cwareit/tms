@extends('layout.app')

@section('title')
    शिक्षक खोजी गर्नुहोस् | {{ config('app.name') }}
@endsection

@section('beardcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">ड्यासबोर्ड</a></li>

            <li class="breadcrumb-item active" aria-current="page">शिक्षक खोजी गर्नुहोस्</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-center">


        <button onclick="return window.print()" class="btn btn-primary d-print-none float-end">प्रिन्ट गर्नुहोस</button>
            <h4 class="d-print-none">शिक्षक खोजी गर्नुहोस</h4>  
            <h4 class="d-none d-print-block">शिक्षक सम्बन्धि विवरण</h4>



        </div>
        <div class="card-body">
            <form method="post" action="#" class="d-print-none">
                @csrf
                <div class="row">
                    <!-- Name -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="name" class="form-label">नाम</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Type -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">प्रकार </label>
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
                    </div>

                    <!-- Level -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="level" class="form-label">तह </label>
                            <select class="form-select @error('level') is-invalid @enderror" id="level" name="level">
                                <option value="{{ old('level') ?? '' }}">{{ old('level') ?? 'छान्नुहोस' }}</option>
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
                    </div>

                    <!-- Class -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="class" class="form-label">श्रेणी </label>
                            <select class="form-select @error('class') is-invalid @enderror" id="class" name="class">
                                <option value="{{ old('class') ?? '' }}">{{ old('class') ?? 'छान्नुहोस' }}</option>
                                <option value="प्रथम">प्रथम</option>
                                <option value="द्वितिय">द्वितिय</option>
                                <option value="तृतिय">तृतिय</option>
                                <option value="अन्य">अन्य</option>
                            </select>
                            @error('class')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary rounded-0 w-100">खोज्नुहोस</button>
            </form>

            @if(isset($teachers))
                @if ($teachers->isEmpty())
                    <div class="alert alert-warning text-center mt-2" role="alert">
                        <strong>शिक्षक सम्बन्धि विवरण भेटिएन</strong>
                        <p>कृपया सही जानकारी भरेर पुनः खोजी गर्नुहोस्।</p>
                    </div>
                @else
                    <div class="table-responsive mt-2">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">विद्यालय</th>
                                    <th scope="col">नाम</th>
                                    <th scope="col">प्रकार</th>
                                    <th scope="col">तह</th>
                                    <th scope="col">श्रेणी</th>
                                    <th scope="col">सुरु नियुक्ति</th>
                                    <th scope="col">तश्वीर</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $teacher->user?->name ?? 'N/A' }}</td>
                                        @if(auth()->user()->type === 'office')
                                            <td><a href="{{ route('teacher', ['id' => $teacher->id]) }}" class="">{{ $teacher->name }}</a></td>
                                        @else
                                            <td>{{ $teacher->name }}</td>
                                        @endif
                                        <td>{{ $teacher->type }}</td>
                                        <td>{{ $teacher->level }}</td>
                                        <td>{{ $teacher->class }}</td>
                                        <td>{{ $teacher->first_appointment_date }}</td>
                                        <td>
                                            <img class="rounded-circle" height="75px" width="75px" src="{{ asset('storage/' . $teacher->photo) }}" alt="फोटो">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @else
                <div class="alert alert-info text-center mt-2" role="alert">
                    <strong>शिक्षकको विवरण खोजी गर्नुहोस्।</strong>
                    <p>शिक्षकको विवरण खोजी गर्नको लागि माथिको फर्ममा आवश्यक जानकारी भरेर <strong>खोज्नुहोस</strong> बटन थिच्नुहोस ।</p>
                </div>
            @endif
        </div>
    </div>
@endsection
