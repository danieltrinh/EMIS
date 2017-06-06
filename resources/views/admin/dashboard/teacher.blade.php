	<?php 
	$user = Auth::user(); 
	$current_classroom = getTeacherClassroom($user->id);
	$current_classroom_id = $current_classroom[0]->id;
	$current_classroom = \App\Classroom::findOrFail($current_classroom_id);
	$data_aca = getStudentPerfomance($current_classroom,1);
	$data_be = getStudentPerfomance($current_classroom,2);
	$top_students = getTopStudent($current_classroom);
	// echo"<pre>";print_r($top_student);die;


	$data = array();reset($data);
	$label = array();reset($label);

	$year_result = getYearYearResult(2017,22038);
	foreach ($year_result as $result) {
		array_push($label, $result->name);
		array_push($data, $result->year_final);
	}
	?>
	<div class="row">
		<div class="col-lg-12 connectedSortable">

			<div class="box box-info">
				<div class="box-header">
					<i class="fa fa-trophy"></i>
					<h3 class="box-title ng-binding">Student's leaderboard</h3>
				</div>
				<div class="box-body">
					<ul class="users-list clearfix">
						@foreach (array_slice($top_students, 0, 6) as $order => $student)
						<li ng-repeat="student in dashboardData.studentLeaderBoard" class="ng-scope" style="width: 33.33%">
							<img alt="Alice Bean" class="user-image img-circle" style="width:35px; height:35px;" ng-src="dashboard/profileImage/14" src="/./img/<?php if($order==0 || $order==1 || $order==2) {echo "top_student.png";} else {echo "profile.jpg";} ?>">

							<a class="users-list-name ng-binding">{{$student['name']}}</a>
							<span class="users-list-date ng-binding">{{$student['performance']}}</span>
						</li>
						@endforeach
					</ul>
				</div>
			</div>

		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-danger">
				<div class="box-header with-border">
					<div class="box-title">
						<span style="font-size: 122%;"> <i class="fa fa-building" aria-hidden="true"></i> Class {{	$current_classroom['name']}} Statistic </span>
					</div>
				</div>
				<div class="box-body">
					<input type="hidden" id="user_id" value="{{ $user->id }}">
					<input type="hidden" id="classroom_id" value="{{ $current_classroom_id }}">

{{-- 	<div class="form-group">
		<label for="grade_graph" class="col-md-3 control-label">Statistic</label>
		<div class="col-md-6">
			<select name="teacher_graph" id="teacher_graph" class="form-control">
				<option value="" >Please Choose a</option>
				<option value="1" >Show subject statistic</option>
				<option value="2" >Show Student statistic</option>
			</select>
		</div>
	</div>
	--}}
	<label>Student ranking</label>
	<div class="form-group">
		<label for="grade_graph" class="col-md-3 control-label">Order By</label>
		<div class="col-md-6">
			<select name="order_by" id="order_by" class="form-control">
				<option value="1" selected>Academic Perfomance</option>
				<option value="2" >Behavior</option>
			</select>
		</div>
	</div>
	<canvas id="teacher_student_graph" height="280" width="600">YYY</canvas>
	<br/>
	<canvas id="teacher_subject_graph" height="280" width="600">XXX</canvas>
</div>
</div>
</div>
</div>

<script type="text/javascript">

	var ctx = document.getElementById('teacher_student_graph').getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'horizontalBar',
				data: <?php echo json_encode($data_aca); ?>  ,
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
	$('#order_by').on('change',function(e) {
		/* Act on the event */
		var option = e.target.value;
		if(option==1)
		{
			var ctx = document.getElementById('teacher_student_graph').getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'horizontalBar',
				data: <?php echo json_encode($data_aca); ?>  ,
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
		}
		else if(option==2)
		{
			var ctx = document.getElementById('teacher_student_graph').getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'horizontalBar',
				data: <?php echo json_encode($data_be); ?>  ,
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
		}
	});
	var ctx = document.getElementById('teacher_subject_graph').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'radar',
		data: {
			labels: <?php echo json_encode($label); ?>,
			datasets: [{
				data: <?php echo json_encode($data); ?>,
				backgroundColor: 'rgba(204,178,255,0.3)',
				label: 'Subject Perfomance'
			}]
		} ,
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			},
			responsive: true,
			title: {
				display: true,
				text: 'Class average perfomance by subject',
			}
		}
	});
</script>
