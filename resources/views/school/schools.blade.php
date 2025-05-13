@extends('layout.app')

@section('title')
    विद्यालय | {{ config('app.name') }}
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#schools').DataTable({
            dom: 'Bfrtip',
            buttons: ['excel', 'print'],
            columnDefs: [
                {
                    targets: 'd-print-none',
                    visible: true,
                    className: 'd-print-none'
                }
            ]
        });
    });
</script>
@endsection

@section('beardcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">ड्यासबोर्ड</a></li>
        <li class="breadcrumb-item active">विद्यालय</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>विद्यालय | {{ config('app.name') }}</h4>
    </div>
    <div class="card-body">
        @if(auth()->user()->type == 'office')
        <div class="text-end mb-2">
            <a href="{{ route('new_school') }}" class="btn btn-sm btn-primary rounded-0 d-print-none">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        @endif

        <table class="table table-bordered table-striped" id="schools">
            <thead>
                <tr>
                    <th>नाम</th>
                    <th>ठेगाना</th>
                    <th class="d-print-none">विकल्पहरु</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schools as $school)
                <tr>
                    <td>
                        <a class="fw-bold" href="{{ route('school', ['id' => $school->id]) }}">{{ $school->name }}</a>
                    </td>
                    <td>{{ $school->municipality }} - {{ $school->ward }}, {{ $school->district }}</td>
                    <td class="d-print-none">
                        <a href="{{route('update_password', ['id'=>$school->id])}}" class="btn btn-warning btn-sm">पासवर्ड परिवर्तन गर्नुहोस</a>
                        @if(auth()->user()->type == 'office')
                        <a onclick="return confirm('के तपाईँ साँच्चै यो विद्यालय डिलिट गर्न चाहनुहुन्छ?')" href="{{route('delete_school', ['id' => $school->id])}}" class="btn btn-danger btn-sm">डिलिट गर्नुहोस</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
