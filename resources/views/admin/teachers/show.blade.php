@extends('backpack::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Teacher {{ $teacher->name }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/teachers/' . $teacher->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Teacher"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/teachers', $teacher->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Teacher',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Teacher ID</th><td>{{ $teacher->teacher_id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $teacher->name }} </td></tr>
                                    <tr><th> Level </th><td> {{ $teacher->level['name'] }} </td></tr>
                                    <tr><th> School </th><td> {{ $teacher->school['name'] }} </td></tr>
                                    <tr><th> Teaching subjects </th>
                                    <td> 
                                    @foreach($teacher->subjects as $subject)
                                        {{ $subject->name }}
                                        <br>
                                    @endforeach
                                    </td></tr>
                                    <tr><th> Teaching Classes </th>
                                    <td> 
                                    @foreach($teacher->classrooms as $classroom)
                                        {{ $classroom->name }}
                                        <br>
                                    @endforeach
                                    </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection