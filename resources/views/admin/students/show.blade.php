@extends('backpack::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $student->name }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/students/' . $student->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Student"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/students', $student->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Student',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr><th> Name </th><td> {{ $student->name }} </td></tr><tr><th> Student Id </th><td> {{ $student->student_id }} </td></tr><tr><th> Classroom </th><td> {{ $student->classroom['name'] }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">Student record</div>
                            <div class="panel-body">
                                <?php  for($i=1; $i<=$student->classroom['grade_id'];$i++){?>
                                    <h2>Grade {{$i}} - Year {{date("Y") - ($student->classroom['grade_id']-$i)}} </h2>
                                      <div class="table-responsive">
                                        <table class="table  table-bordered" style="border: 1px solid">
                                           <style>
                                            colgroup col.green {
                                              background-color: #e3ffc9;
                                          }
                                          colgroup col.blue {
                                              background-color: #d4ecf8;
                                          }
                                          colgroup col.grey {
                                              background-color: rgba(203, 200, 200, 0.25);
                                          }

                                      </style>
                                      <colgroup>
                                      <col class="col green"/>
                                      <col />
                                      <col />
                                      <col />
                                      <col class="col grey"/>
                                      <col  />
                                      <col />
                                      <col />
                                      <col class="col grey"/>
                                      <col class="col blue" />
                                  </colgroup>
                                  <?php $year_results = getCurrentGradeResult($i,$student->id); ?>
                                  <thead>
                                    <tr>
                                        <th> Subject name </th>
                                        <th> Semmester 1 quizzes </th>
                                        <th> Semmester 1 midterm </th>
                                        <th> Semmester 1 final </th>
                                        <th> Semmester 1 Total </th>
                                        <th> Semmester 2 quizzes </th>
                                        <th> Semmester 2 midterm </th>
                                        <th> Semmester 2 final </th>
                                        <th> Semmester 2 Total </th>
                                        <th> Final grade </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($year_results as $value)
                                    <tr>
                                        <td>{{getSubjectName($value->subject_id)}}</td>
                                        <td>{{$value->s1_quizzes}}</td>
                                        <td>{{$value->s1_midterm}}</td>
                                        <td>{{$value->s1_final}}</td>
                                        <td>{{$value->s1_total}}</td>
                                        <td>{{$value->s2_quizzes}}</td>
                                        <td>{{$value->s2_midterm}}</td>
                                        <td>{{$value->s2_final}}</td>
                                        <td>{{$value->s2_total}}</td>
                                        <td>{{$value->year_final}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection