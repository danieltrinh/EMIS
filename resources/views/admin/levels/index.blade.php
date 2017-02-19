@extends('backpack::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Levels</div>
                    <div class="panel-body">

                        {{-- <a href="{{ url('/admin/levels/create') }}" class="btn btn-primary btn-xs" title="Add New Level"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a> --}}
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Name </th>
                                        {{-- <th> Description </th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($levels as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        {{-- <td>{{ $item->description }}</td> --}}
                                        <td>
                                            <a href="{{ url('/admin/levels/' . $item->id) }}" class="btn btn-success btn-xs" title="View Level"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/levels/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Level"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/levels', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                               {{--  {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Level" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Level',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!} --}}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $levels->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection