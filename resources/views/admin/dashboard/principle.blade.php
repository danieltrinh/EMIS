<?php 
	$user = Auth::user(); 
	$current_school =  getPrincipleSchool($user->id); 
	$school_id = $current_school[0]->id;
	$current_school = \App\School::findOrFail($current_school[0]->id);
	$level = \App\Level::findOrFail($current_school->level['attributes']['id']);
	$grades = $level->grades;
?>

<input type="hidden" id="user_id" value="{{ $user->id }}">
<input type="hidden" id="school_id" value="{{ $school_id }}">

<div class="form-group">
	<label for="grade_graph" class="col-md-3 control-label">Grade</label>
	<div class="col-md-6">
		<select name="principle_grade" id="principle_grade" class="form-control">
            <option value="" >Please Choose a</option>
		 	@foreach($grades as $item)
                <option value="{{ $item->id }}" >{{ $item->name }}</option>
            @endforeach
		</select>
	</div>
</div>

<canvas id="principle_bargraph" height="280" width="600"></canvas>
<canvas id="principle_male_female" height="280" width="600"></canvas>

