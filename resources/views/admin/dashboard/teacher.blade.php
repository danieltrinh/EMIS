<pre>
	<?php 
	$user = Auth::user(); 
	$current_classroom = getTeacherClassroom($user->id);
	$current_classroom_id = $current_classroom[0]->id;
	$current_classroom = \App\Classroom::findOrFail($current_classroom_id);
	$data_aca = getStudentPerfomance($current_classroom,1);
	$data_be = getStudentPerfomance($current_classroom,2);


	$data = array();reset($data);
	$label = array();reset($label);

	$year_result = getYearYearResult(2017,22038);
	foreach ($year_result as $result) {
		array_push($label, $result->name);
		array_push($data, $result->year_final);
	}
	?>


	<input type="hidden" id="user_id" value="{{ $user->id }}">
	<input type="hidden" id="classroom_id" value="{{ $current_classroom_id }}">

	<div class="form-group">
		<label for="grade_graph" class="col-md-3 control-label">Statistic</label>
		<div class="col-md-6">
			<select name="teacher_graph" id="teacher_graph" class="form-control">
				<option value="" >Please Choose a</option>
				<option value="1" >Show subject statistic</option>
				<option value="2" >Show Student statistic</option>
			</select>
		</div>
	</div>

	<canvas id="teacher_subject_graph" height="280" width="600">XXX</canvas>
	<div class="form-group">
		<label for="grade_graph" class="col-md-3 control-label">Order By</label>
		<div class="col-md-6">
			<select name="order_by" id="order_by" class="form-control">
				<option value="1" >Academic Perfomance</option>
				<option value="2" >Behavior</option>
			</select>
		</div>
	</div>
	<canvas id="teacher_student_graph" height="280" width="600">YYY</canvas>

	<script type="text/javascript">
		

		$('#order_by').on('change',function(e) {
			/* Act on the event */
			var option = e.target.value;
			if(option==1)
			{
				var ctx = document.getElementById('teacher_student_graph').getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'horizontalBar',
					data: <?php echo json_encode($data_aca) ?>  ,
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
					data: <?php echo json_encode($data_be) ?>  ,
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

	</script>

	<script>
		var ctx = document.getElementById('teacher_subject_graph').getContext('2d');
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