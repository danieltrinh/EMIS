<?php 
$user = Auth::user(); 
$current_school =  getPrincipleSchool($user->id); 
$school_id = $current_school[0]->id;
$current_school = \App\School::findOrFail($current_school[0]->id);
$level = \App\Level::findOrFail($current_school->level['attributes']['id']);
$grades = $level->grades;
$school_years= getSchoolYears($school_id);
$countCurrentClasses = countCurrentClasses($school_id,date("Y"));
?>

<div class="row" ng-show="dashboardData.role == 'admin'">

	<a href="/admin/classrooms">
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-aqua reportsDiv">
				<span class="info-box-icon"><i class="fa fa-building"></i></span>
				<div class="info-box-content">
					<span class="info-box-text ng-binding"><?php echo $countCurrentClasses; ?></span>
					<span class="progress-description ng-binding">Classes</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
	</a>
	<a href="/admin/students">
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-yellow reportsDiv">
				<span class="info-box-icon"><i class="fa fa-child"></i></span>
				<div class="info-box-content">
					<span class="info-box-text ng-binding">{{count($current_school->students)}}</span>
					<span class="progress-description ng-binding">Students</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
	</a>
	<a href="/admin/teachers">
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box bg-green reportsDiv">
				<span class="info-box-icon"><i class="fa fa-male"></i></span>
				<div class="info-box-content">
					<span class="info-box-text ng-binding">{{count($current_school->teachers)}}</span>
					<span class="progress-description ng-binding">Teachers</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
	</a>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<div class="box-title">
					<span style="font-size: 122%;"> <i class="fa fa-university" aria-hidden="true"></i> School {{$current_school['name']}} Statistic </span>
				</div>
			</div>
			<div class="box-body principle_body">

				<input type="hidden" id="user_id" value="{{ $user->id }}">
				<input type="hidden" id="school_id" value="{{ $school_id }}">
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="grade_graph" class="col-md-3 control-label">Information</label>
							<div class="col-md-6">
								<select name="principle_graph" id="principle_graph" class="form-control">
									<option value="0" >All</option>
									<option value="1" >Perfomance</option>
									<option value="2" >Gender</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="school_year_graph" class="col-md-3 control-label">School Year</label>
							<div class="col-md-6">
								<select name="school_year_graph" id="school_year_graph" class="form-control">
									<option value="" >Please Choose a School Year</option>
									@foreach($school_years as $item)
									<option value="{{ $item['id'] }}" >{{ $item['name'] }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="grade_graph" class="col-md-3 control-label">Grade</label>
							<div class="col-md-6">
								<select name="principle_grade" id="principle_grade" class="form-control">
									<option value="" >Please Choose a Grade</option>
									@foreach($grades as $item)
									<option value="{{ $item->id }}" >{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>

				<canvas id="principle_bargraph" height="280" width="600"></canvas>
				<canvas id="principle_male_female" height="280" width="600"></canvas>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#principle_graph").change(function(event) {
		/* Act on the event */
		option = $(this).val();
		if (option == 1)
		{
			$("#principle_bargraph").show();
			$("#principle_male_female").hide();
		}
		else if (option == 2)
		{
			$("#principle_bargraph").hide();
			$("#principle_male_female").show();
		}
		else 
		{
			$("#principle_bargraph").show();
			$("#principle_male_female").show();
		}
	});
</script>