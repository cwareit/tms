<div class="bg-info fw-bold text-white mb-2 py-1 px-2">
    <div class="row">
        <div class="col">असाधारण विदा सम्बन्धी विवरण</div>

        <div class="col text-end">
            <a href="{{ route('new_uleave', ['teacher_id' => $teacher->id]) }}" class="btn btn-sm btn-secondary rounded-0 d-print-none">
                <i class="fas fa-add"></i>
            </a>
        </div>
    </div>
</div>

<table class="table table-bordered table-striped" id="uleaves">
    <thead>
        <tr>
            <th>क्र. स.</th>
            <th>देखि</th>
            <th>सम्म</th>
            <th>कैफियत</th>
            <th class="d-print-none">विकल्पहरु</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teacher->uleaves as $uleave)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $uleave->leave_from }}</td>
                <td>{{ $uleave->leave_to }}</td>
                <td>{{ $uleave->remarks }}</td>
                <td class="d-print-none">
                    <a href="{{route('edit_uleave', ['uleave_id' => $uleave->id])}}" class="btn btn-warning btn-sm">अपडेट गर्नुहोस</a>
                    <a onclick="return confirm('के तपाईँ साँच्चै यो विवरण डिलिट गर्न चाहनुहुन्छ?')" href="{{route('delete_uleave', ['uleave_id' => $uleave->id])}}" class="btn btn-danger btn-sm">डिलिट गर्नुहोस</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
