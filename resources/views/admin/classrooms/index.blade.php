@extends('backpack::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Classrooms</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/classrooms/create') }}" class="btn btn-primary btn-xs" title="Add New Classroom"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Grade</th><th> Name </th><th> School </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($classrooms->sortBy('grade_id') as $item)
                                    <tr>
                                        <td>{{ $item->grade['name'] }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->school['name'] }}</td>
                                        <td>
                                            <a href="{{ url('/admin/classrooms/' . $item->id) }}" class="btn btn-success btn-xs" title="View Classroom"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/classrooms/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Classroom"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/classrooms', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Classroom" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Classroom',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $classrooms->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection