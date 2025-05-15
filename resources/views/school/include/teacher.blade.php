<div class="bg-info fw-bold text-white mb-2 py-1 px-2">
                <div class="row">
                    <div class="col">कार्यरत शिक्षकहरु</div>
                    <div class="col text-end">
                        <a href="{{ route('new_teacher', ['school_id' => $school->id]) }}" class="btn btn-sm btn-secondary rounded-0 d-print-none">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>


            <table class="table table-bordered table-striped" id="banks">
                <thead>
                    <tr>
                        <th>क्र. स.</th>
                        <th>नाम</th>
                        <th>ठेगाना</th>
                        <th>तह</th>
                        <th>श्रेणी</th>
                        <th>फोटो</th>
                        <th class="d-print-none">विकल्पहरु</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($school->teachers as $teacher)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>
                                <a class="fw-bold" href="{{route('teacher', ['id' => $teacher->id])}}">
                                {{ $teacher->name }}
                                </a>
                            </td>
                            <td>{{ $teacher->municipality }} - {{ $teacher->ward }}, {{ $teacher->district }}</td>
                            <td>{{ $teacher->level }}</td>
                            <td>{{ $teacher->class }}</td>
                            <td>
                            <img src="{{ asset('images/teachers/' . $teacher->photo)}}" alt="छैन" height="50">
                               
                            </td>
                            <td class="d-print-none">
                                <a href="{{ route('transfer_teacher', ['id' => $teacher->id]) }}" class="btn btn-warning btn-sm">सरुवा गर्नुहोस</a>
                                <a onclick="return confirm('के तपाईँ साँच्चै शिक्षक सम्बन्धि विवरण डिलिट गर्न चाहनुहुन्छ?')" href="{{ route('delete_teacher', ['id' => $teacher->id]) }}" class="btn btn-danger btn-sm">डिलिट गर्नुहोस</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>