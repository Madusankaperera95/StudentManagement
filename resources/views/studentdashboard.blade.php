@extends('Studentlayout')

@section('content')
    <div class="studentcontainer">
        <h1>Student Scores</h1>
        <table>
            <thead>
            <tr>
                <th>Subject</th>
                <th>Score</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->name}}</td>
                    <td>{{ $subject->pivot->marks }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
