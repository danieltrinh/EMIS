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
            <br>
            <div class="panel panel-info">
              <div class="panel-heading">Student Information</div>
              <table class="table table-borderless">
                <tbody>
                  <tr><th> Name </th><td> {{ $student->name }} </td></tr>
                  <tr><th> Student Id </th><td> {{ $student->student_id }} </td></tr>
                  <tr><th> Classroom </th><td> {{ $student->classroom['name'] }} </td></tr>
                  <tr><th> Gender </th><td> <?php if ($student->female == 1) echo "Female"; else echo "male"; ?> </td></tr>
                  <tr><th> Address </th><td> {{ $student->address }} </td></tr>
                  <tr><th> City/State </th><td> {{ $student->state }} </td></tr>
                  <tr><th> HomeNumber </th><td> {{ $student->phone_number }} </td></tr>
                  <tr><th> Economic Disadvantage </th><td> <?php if ($student->economic_disadvantaged==1) echo "Yes";else echo "None";  ?> </td></tr>
                  <tr><th> Original Hometown </th><td> {{ $student->hometown }} </td></tr>

          
                  @if ((int)$student->classroom['grade_id'] >1)
                  <canvas id="general_graph" height="330" width="600"></canvas>
                  <?php 
                    $data = array();reset($data);
                    $label = array();reset($label);
                    $all_year_avg = getYearsAverage($student->id,(int)$student->classroom['grade_id']);
                    foreach ($all_year_avg as $year_avg) {
                      array_push($label, (intval($year_avg->year) - 1)." - ".(intval($year_avg->year)));
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
                          backgroundColor: 'red',
                          borderColor: 'red',
                          fill: false,
                          label: "Student Grade Performance from School Year <?php echo $label[0];?> to <?php echo $label[count($label)-1]; ?>",
                          data: <?php echo json_encode($data); ?>,
                          lineTension: 0,
                        }]
                      } ,
                      options: {
                        scales: {
                          yAxes: [{
                            ticks: {
                              beginAtZero:true,
                              min:  <?php echo (int)min($data) -2; ?>,
                              max: 10
                            }
                          }]
                        }
                      }
                    });
                  </script>
                  @endif
                </tbody>
              </table>
              </div>
              </div>
            <div class="panel panel-default">
              <div class="panel-heading">Student yearly record</div>
                
              <div class="panel-body">
                <?php  for($grade=1; $grade<=$student->classroom['grade_id'];$grade++){?>
                <hr>
                <h3>Grade {{$grade}} - School year of {{date("Y") - ($student->classroom['grade_id']-$grade) - 1}} - {{date("Y") - ($student->classroom['grade_id']-$grade)}}</h3>
                  <?php 
                   foreach ($student->student_classroom as $key => $classroom) {
                    if ($classroom->year == date("Y") - ($student->classroom['grade_id']-$grade))
                      {
                      $school_id = $classroom->school_id;
                      $school= \App\School::where('id','=',$school_id)->get(); 
                      ?>
                        <p><b>Class:</b> <?php echo  $classroom->name ; ?> </p>
                        <p><b>School:</b> <?php echo  $school[0]->name ; ?> </p>
                      <?php
                      }
                  } ?>
                
                <canvas id="radar-chart-{{$grade}}" height="280" width="600"></canvas>
                <?php
                  $data = array();reset($data);
                  $label = array();reset($label);
                  $year_result = getYearResult($grade,$student->id);
                  foreach ($year_result as $result) {
                    array_push($label, $result->name);
                    array_push($data, $result->year_final);
                  }
                  ?>
                  <script>
                    var chartData = <?php echo json_encode($data); ?>;
                    max =  Math.max.apply(null, chartData);
                    min =  Math.min.apply(null, chartData);
                    var ctx = document.getElementById('radar-chart-<?php echo $grade;?>').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'radar',
                      data: {
                        labels: <?php echo json_encode($label); ?>,
                        datasets: [{
                          borderColor: 'blue',
                          backgroundColor: 'rgba(0,0,255,0.3)',
                          label: "Student Grade <?php echo $grade; ?> Performance",
                          data: <?php echo json_encode($data); ?>,
                        }]
                      } ,
                      options: {
                        scale: {
                          ticks: {
                            beginAtZero: true,
                            max: 10
                          }
                        }
                      }
                    });
                  </script>
                <div class="table-responsive" style="padding-top: 30px">
                  <table class="table  table-bordered" style="border: 1px solid;font-size: 10.5px">
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