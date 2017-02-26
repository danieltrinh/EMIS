@extends('backpack::layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Grades</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/grades/create') }}" class="btn btn-primary btn-xs" title="Add New Grade"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Grade </th><th> Level Id </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($grades as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td><td>{{ $item->level['name'] }}</td>
                                        <td>
                                            <a href="{{ url('/admin/grades/' . $item->id) }}" class="btn btn-success btn-xs" title="View Grade"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            {{-- <a href="{{ url('/admin/grades/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Grade"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a> --}}
{{--                                             {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/grades', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Grade" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Grade',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!} --}}
                                            {{-- {!! Form::close() !!} --}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $grades->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection