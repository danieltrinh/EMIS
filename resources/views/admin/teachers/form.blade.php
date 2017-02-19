<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('level_id') ? 'has-error' : ''}}">
    {!! Form::label('level_id', 'Level', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('level_id', $levels, old('level_id'), ['class' => 'form-control']) !!}
        {!! $errors->first('level_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('school_id') ? 'has-error' : ''}}">
    {!! Form::label('Subjects', 'Subjects', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
{{--         {!! Form::select('subjects[]', 
    $subjects, 
    null, 
    ['class' => 'form-control', 
    'multiple' => 'multiple']) !!} --}}
        <select class="form-control" multiple="multiple" name="subjects[]" id="subject_id">
    <option value=""></option>
    </select>

{{-- 
    <select class="form-control" multiple="multiple" name="classrooms[]" id="classroom_id">
    <option value=""></option>
    </select> --}}

        {!! $errors->first('school_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('school_id') ? 'has-error' : ''}}">
    {!! Form::label('school_id', 'School', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('school_id', $schools, old('school_id'), ['class' => 'form-control']) !!} 
        {!! $errors->first('school_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('school_id') ? 'has-error' : ''}}">
    {!! Form::label('Classroom', 'Classroom', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
{{--         {!! Form::select('classrooms[]', 
    $classrooms, 
    null, 
    ['class' => 'form-control', 
    'multiple' => 'multiple']) !!} --}}

    <select class="form-control" multiple="multiple" name="classrooms[]" id="classroom_id">
    <option value=""></option>
    </select>

        {!! $errors->first('school_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
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

<script>

    $('#level_id').on('change',function(e) {
        /* Act on the event */

        console.log(e);

        var lid = e.target.value;
        $.get('/ajax-subject/' + lid,function(data){
            //success data
            console.log(data);
            $('#subject_id').empty();
            $.each(data, function(index,subjectObj){

                $('#subject_id').append('<option value="'+subjectObj.id+'">'+subjectObj.name+'</option>');
            })
        });
    });
</script>

<script>
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
</script>