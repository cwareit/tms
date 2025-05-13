<div class="bg-info fw-bold text-white mb-2 py-1 px-2">
    <div class="row">
        <div class="col">सुरु नियुक्ति सम्बन्धी विवरण</div>

        <div class="col text-end">
            <a href="{{ route('new_first_appointment', ['teacher_id' => $teacher->id]) }}" class="btn btn-sm btn-secondary rounded-0 d-print-none">
                <i class="fas fa-add"></i>
            </a>
        </div>
    </div>
</div>

<table class="table table-bordered table-striped" id="first_appointments">
    <thead>
        <tr>
            <th>क्र. स.</th>
            <th>प्रकार</th>
            <th>तह</th>
            <th>श्रेणी</th>
            <th>मिति</th>
            <th>कैफियत</th>
            <th class="d-print-none">विकल्पहरु</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teacher->first_appointments as $first_appointment)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $first_appointment->type }}</td>
                <td>{{ $first_appointment->level }}</td>
                <td>{{ $first_appointment->class }}</td>
                <td>{{ $first_appointment->date }}</td>
                <td>{{ $first_appointment->remarks }}</td>
                <td class="d-print-none">
                    <a href="{{route('edit_first_appointment', ['first_appointment_id' => $first_appointment->id])}}" class="btn btn-warning btn-sm">अपडेट गर्नुहोस</a>
                    <a onclick="confirm('के तपाईँ साँच्चै यो विवरण डिलिट गर्न चाहनुहुनछ?')"href="{{route('delete_first_appointment', ['first_appointment_id' => $first_appointment->id])}}" class="btn btn-danger btn-sm">डिलिट गर्नुहोस</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
