<div class="bg-info fw-bold text-white mb-2 py-1 px-2">
                <div class="row">
                    <div class="col">स्थापना/ईजाजत</div>
                    <div class="col text-end">
                        <a href="{{ route('new_establishment', ['school_id' => $school->id]) }}" class="btn btn-sm btn-secondary rounded-0 d-print-none">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped" id="establishments">
                <thead>
                    <tr>
                        <th>क्र. स.</th>
                        <th>प्रकार</th>
                        <th>तह</th>
                        <th>मिति</th>
                        <th class="d-print-none">विकल्पहरु</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($school->establishments as $establishment)
                        <tr>
                        <td>{{ $loop->iteration }}.</td>
                            <td>{{ $establishment->establishment_type }}</td>
                            <td>{{ $establishment->school_level }}</td>
                            <td>{{ $establishment->date }}</td>
                            <td class="d-print-none">
                                <a href="{{route('edit_establishment', ['establishment_id' => $establishment->id]) }}" class="btn btn-warning btn-sm">अपडेट गर्नुहोस</a>


                                <a onclick="return confirm('के तपाईँ साच्चै यो विवरण डिलिट गर्न चाहनुहुन्छ?')" href="{{route('delete_establishment', ['establishment_id' => $establishment->id]) }}" class="btn btn-danger btn-sm">डिलिट गर्नुहोस</a>

                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>