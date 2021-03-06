<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('school_id') ? 'has-error' : ''}}">
    {!! Form::label('school_id', 'School', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('school_id', $schools, old('school_id'), ['class' => 'form-control']) !!} 
        {!! $errors->first('school_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('grade_id') ? 'has-error' : ''}}">
    {!! Form::label('Grade ID', 'Grade Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('grade_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('grade_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>