@extends('backpack::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Guardian {{ $guardian->name }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/guardians/' . $guardian->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Guardian"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/guardians', $guardian->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Guardian',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $guardian->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Role </th>
                                        <td> 
                                        <?php 
                                            if($guardian->radio ==0)
                                            {
                                                echo "father";
                                            } 
                                            elseif($guardian->radio ==1)
                                            {
                                                echo "mother";
                                            }
                                            else
                                            {
                                                echo "other";
                                            }
                                        ?>  </td>
                                    </tr>
                                    <tr>
                                        <th> Birthday </th>
                                        <td> {{ $guardian->bd }} </td>
                                    </tr>
                                    <tr>
                                        <th> Job </th>
                                        <td> {{ $guardian->job }} </td>
                                    </tr>
                                    <tr>
                                        <th> Phone Number </th>
                                        <td> {{ $guardian->name }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection