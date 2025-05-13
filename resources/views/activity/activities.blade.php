@extends('layout.app')

@section('title')
    गतिविधिहरु | {{ config('app.name') }}
@endsection




@section('beardcrumb')


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">ड्यासबोर्ड</a></li>
    <li class="breadcrumb-item">गतिविधिहरु</li>
  
  </ol>
</nav>

@endsection










@section('content')
<div class="card">
    <div class="card-header text-center">
        <h4>गतिविधिहरु | {{ config('app.name') }}</h4>
    </div>
    <div class="card-body">

<table class="table table-bordered table-hover">
    <thead>
        <tr>
        <th>मिति</th>
        <th>गतिविधि</th>
        <th>कैफियत</th>
        <th>समय</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($activities as $activity)
            <tr>
                <td>{{ $activity->created_at }}</td>
                <td>{{ $activity->activity }}</td>
                <td>{{ $activity->remarks }}</td>
                <td>{{ $activity->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
      

{{ $activities->links('pagination::bootstrap-5') }}


    </div>
</div>
@endsection
