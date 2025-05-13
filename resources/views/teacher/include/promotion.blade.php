<div class="bg-info fw-bold text-white mb-2 py-1 px-2">
    <div class="row">
        <div class="col">बढुवा सम्बन्धी विवरण</div>

        <div class="col text-end">
            <a href="{{ route('new_promotion', ['teacher_id' => $teacher->id]) }}" class="btn btn-sm btn-secondary rounded-0 d-print-none">
                <i class="fas fa-add"></i>
            </a>
        </div>
    </div>
</div>

<table class="table table-bordered table-striped" id="promotions">
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
        @foreach ($teacher->promotions as $promotion)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $promotion->type }}</td>
                <td>{{ $promotion->level }}</td>
                <td>{{ $promotion->class }}</td>
                <td>{{ $promotion->date }}</td>
                <td>{{ $promotion->remarks }}</td>
                <td class="d-print-none">
                    <a href="{{route('edit_promotion', ['promotion_id' => $promotion->id])}}" class="btn btn-warning btn-sm">अपडेट गर्नुहोस</a>
                    <a onclick="return confirm('के तपाईँ साँच्चै यो विवरण डिलिट गर्न चाहनुहुन्छ?')" href="{{route('delete_promotion', ['promotion_id' => $promotion->id])}}" class="btn btn-danger btn-sm">डिलिट गर्नुहोस</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
