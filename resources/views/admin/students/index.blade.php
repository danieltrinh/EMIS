@extends('backpack::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Students</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/students/create') }}" class="btn btn-primary btn-xs" title="Add New Student"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Name </th><th> Student Id </th><th> School</th><th> Classroom</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($students->sortBy('school_id')  as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->student_id }}</td>
                                        <td>{{ $item->school['name'] }}</td>
                                        <td>{{ $item->classroom['name'] }}</td>
                                        <td>
                                            <a href="{{ url('/admin/students/' . $item->id) }}" class="btn btn-success btn-xs" title="View Student"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/students/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Student"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/students', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Student" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Student',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <?php $user = Auth::user(); ?>
                            @if (!$user->hasRole('teacher'))
                                <div class="pagination-wrapper"> {!! $students->render() !!} </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection