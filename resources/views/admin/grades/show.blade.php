@extends('backpack::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Grade {{ $grade->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/grades/' . $grade->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Grade"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/grades', $grade->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Grade',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr><th> Name </th><td> Grade {{ $grade->name }} </td></tr>
                                    <tr><th> Level </th><td> {{ $grade->level['name'] }} </td></tr>
                                    <tr><th> Subject List </th>
                                    <td> 
                                    @foreach($grade->subjects as $subject)
                                        {{ $subject->name }}
                                        <br><hr>
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