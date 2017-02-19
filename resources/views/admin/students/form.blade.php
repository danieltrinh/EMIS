<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('student_id') ? 'has-error' : ''}}">
    {!! Form::label('student_id', 'Student Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('student_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('student_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('school_id') ? 'has-error' : ''}}">
    {!! Form::label('school', 'School', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {{-- {!! Form::select('school_id', $schools, old('school_id'), ['class' => 'form-control']) !!} --}}
        <?php $schools=\App\School::all();   ?>

        <select class="form-control" id="school_id" name="school_id">
          @foreach($schools as $school)
                <option value="{{ $school->id }}">{{ $school->name }}</option>
          @endforeach
        </select>
        {!! $errors->first('school_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('classroom_id') ? 'has-error' : ''}}">
    {!! Form::label('classroom', 'Classroom', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {{-- {!! Form::select('classroom_id', $classrooms, old('classroom_id'), ['class' => 'form-control']) !!} --}}
        <select class="form-control" id="classroom_id" name="classroom_id">
          <option value=""></option>
        </select>

        {!! $errors->first('classroom_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<script>

    $('#school_id').on('change',function(e) {
        /* Act on the event */

        console.log(e);

        var cid = e.target.value;
        $.get('/ajax-classroom/' + cid,function(data){
            //success data
            console.log(data);
            $('#classroom_id').empty();
            $.each(data, function(index,classObj){

                $('#classroom_id').append('<option value="'+classObj.id+'">'+classObj.name+'</option>');
            })
        });
    });
</script>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>