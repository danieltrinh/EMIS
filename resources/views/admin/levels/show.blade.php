@extends('backpack::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong> {{ $level->name }} </strong></div>
                    <div class="panel-body">

                        <a href="{{ url('admin/levels/' . $level->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Level"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {{-- {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/levels', $level->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Level',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!} --}}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $level->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $level->name }} </td></tr>
                                    <tr><th> Description </th><td> {{ $level->description }} </td></tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">School list</div>
                        <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Name </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($level->schools as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ url('/admin/schools/' . $item->id) }}" class="btn btn-success btn-xs" title="View School"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/schools/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit School"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/schools', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete School" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete School',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection