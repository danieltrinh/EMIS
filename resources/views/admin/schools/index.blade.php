@extends('backpack::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Schools</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/schools/create') }}" class="btn btn-primary btn-xs" title="Add New School"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Name </th><th> Level </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($schools->sortBy('level_id') as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->level['name'] }}</td>
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
                            <div class="pagination-wrapper"> {!! $schools->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection