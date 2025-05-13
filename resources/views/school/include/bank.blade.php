<div class="bg-info fw-bold text-white mb-2 py-1 px-2">
                <div class="row">
                    <div class="col">विद्यालयको खाता रहेको बैङ्क</div>
                    <div class="col text-end">
                        <a href="{{ route('new_bank', ['school_id' => $school->id]) }}" class="btn btn-sm btn-secondary rounded-0 d-print-none">
                            <i class="fas fa-add"></i>
                        </a>
                    </div>
                </div>
            </div>


            <table class="table table-bordered table-striped" id="banks">
                <thead>
                    <tr>
                        <th>क्र. स.</th>
                        <th>बैङ्कको नाम</th>
                        <th>शाखा</th>
                        <th>खाता नम्बर</th>
                        <th class="d-print-none">विकल्पहरु</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($school->banks as $bank)
                        <tr>
                        <td>{{ $loop->iteration }}.</td>
                            <td>{{ $bank->name }}</td>
                            <td>{{ $bank->branch }}</td>
                            <td>{{ $bank->account_number }}</td>
                            <td class="d-print-none">
                                <a href="{{route('edit_bank', ['bank_id' => $bank->id])}}" class="btn btn-warning btn-sm">अपडेट गर्नुहोस</a>
                                <a onclick = "return confirm('के तपाईँ साँच्चै यो विवरण डिलिट गर्न चाहनुहुन्छ?')" href="{{route('delete_bank', ['bank_id' => $bank->id])}}" class="btn btn-danger btn-sm">डिलिट गर्नुहोस</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>