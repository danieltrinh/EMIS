@extends('backpack::layout')

@section('content')
  <div class="row">
    <div class="col-md-10">
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
                  <canvas id="general_graph" height="280" width="600"></canvas>
                  <?php 
                  $data = array();reset($data);
                  $label = array();reset($label);
                  $all_year_avg = getYearsAverage($student->id);
                  foreach ($all_year_avg as $year_avg) {
                    array_push($label, $year_avg->year);
                    array_push($data, $year_avg->all_subject);
                  }
                  ?>
                  <script type="text/javascript">
                    var ctx = document.getElementById('general_graph').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: <?php echo json_encode($label); ?>,
                        datasets: [{
                          data: <?php echo json_encode($data); ?>,
                        }]
                      } ,
                      options: {
                        scales: {
                          yAxes: [{
                            ticks: {
                              beginAtZero:true
                            }
                          }]
                        }
                      }
                    });
                  </script>
                </tbody>
              </table>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">Student record</div>
              <div class="panel-body">
                <?php  for($grade=1; $grade<=$student->classroom['grade_id'];$grade++){?>
                <hr>
                <canvas id="radar-chart-{{$grade}}" height="280" width="600"></canvas>
                <h2>Grade {{$grade}} </h2>
                <h2>Year {{date("Y") - ($student->classroom['grade_id']-$grade)}} </h2>
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
                <?php 
                $all_results = getCurrentGradeResult($grade,$student->id); 
                ?>
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
                  @foreach ($all_results as $value)
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
                  <?php
                  $data = array();reset($data);
                  $label = array();reset($label);

                  $year_result = getYearResult($grade, $value->student_id);
                  foreach ($year_result as $result) {
                    array_push($label, $result->name);
                    array_push($data, $result->year_final);
                  }
                  ?>
                  <script>
                    var ctx = document.getElementById('radar-chart-<?php echo $grade;?>').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'radar',
                      data: {
                        labels: <?php echo json_encode($label); ?>,
                        datasets: [{
                          data: <?php echo json_encode($data); ?>,
                        }]
                      } ,
                      options: {
                        scales: {
                          yAxes: [{
                            ticks: {
                              beginAtZero:true
                            }
                          }]
                        }
                      }
                    });
                  </script>
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