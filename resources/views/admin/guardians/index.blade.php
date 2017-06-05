@extends('backpack::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Guardians</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/guardians/create') }}" class="btn btn-primary btn-xs" title="Add New Guardian"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Name </th>
                                        <th> Role </th>
                                        <th> Of Student </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($guardians as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                        @if ( $item->role == 1 )
                                            Father
                                        @elseif ( $item->role == 2 )
                                            Mother
                                        @else 
                                            Guardian
                                        @endif

                                        </td>
                                        <td>{{ $item->student['name'] }}</td>
                                        <td>
                                            <a href="{{ url('/admin/guardians/' . $item->id) }}" class="btn btn-success btn-xs" title="View Guardian"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/guardians/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Guardian"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/guardians', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Guardian" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Guardian',
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
                            <div class="pagination-wrapper"> {!! $guardians->render() !!} </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection