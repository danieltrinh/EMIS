@extends('backpack::layout')

@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $school->name }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/schools/' . $school->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit School"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/schools', $school->id],
                            'style' => 'display:inline'
                            ]) !!}
                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-xs',
                            'title' => 'Delete School',
                            'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                            {!! Form::close() !!}
                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr><th> Name </th>
                                        <td> {{ $school->name }} </td></tr>
                                        <tr><th> Level </th>
                                        <td> {{ $school->level['name'] }} </td></tr>
                                        <tr>
                                            <td style="width: 100%"> <canvas id="enrollment" ></canvas></td>
                                            {{-- <td style="width: 50%"> <canvas id="state_graph"></canvas></td> --}}
                                            <?php 
                                            $data = array();reset($data);
                                            $label = array();reset($label);
                                            $school_gender = getGenderPercent($school->id);
                                            foreach ($school_gender as $gender) {
                                                array_push($label, $gender->year);
                                                array_push($data, $gender->all_subject);
                                            }
                                            ?>
                                            <script type="text/javascript">
                                                var ctx = document.getElementById("enrollment").getContext("2d");

                                                var data = {
                                                    labels: ["Male", "Female"],
                                                    datasets: [
                                                    {
                                                        label: "Male",
                                                        backgroundColor: "male",
                                                        data: [3,7,4]
                                                    },
                                                    {
                                                        label: "Female",
                                                        backgroundColor: "female",
                                                        data: [4,3,5]
                                                    }
                                                    ]
                                                };

                                                var myBarChart = new Chart(ctx, {
                                                    type: 'bar',
                                                    data: data,
                                                    options: {
                                                        barValueSpacing: 20,
                                                        scales: {
                                                            yAxes: [{
                                                                ticks: {
                                                                    min: 0,
                                                                }
                                                            }]
                                                        }
                                                    }
                                                });
                                            </script>
                                        </tr>
                                        <tr>
                                            {{-- <td style="width: 50%"> <canvas id="grade_student" ></canvas></td> --}}
                                            <td style="width: 100%"> <canvas id="economic"></canvas></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Class list</div>
                        <div class="panel-body" style="height: 500px; overflow-y: scroll;">

                        <a href="{{ url('/admin/classrooms/create') }}" class="btn btn-primary btn-xs" title="Add New Classroom"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>

                            <div class="table-responsive ">
                                <table class="table table-borderless table-hover">
                                    <thead>
                                        <tr>
                                        <th> Name </th><th>Grade</th><th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($school->classrooms->sortBy('grade_id') as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->grade['name'] }}</td>
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
                                </div>

                            </div>
                        </div>

                        <div class="panel panel-default">
                    <div class="panel-heading">Teachers</div>
                    <div class="panel-body" style="height: 500px; overflow-y: scroll;">

                        <a href="{{ url('/admin/teachers/create') }}" class="btn btn-primary btn-xs" title="Add New Teacher"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th>Teacher ID</th><th> Name </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($school->teachers as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ url('/admin/teachers/' . $item->id) }}" class="btn btn-success btn-xs" title="View Teacher"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/teachers/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Teacher"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/teachers', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Teacher" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Teacher',
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
        </div>
        @endsection