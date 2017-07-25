<?php if (isset($teacher))
{
    $teacher_id = $teacher->teacher_id;
    if(isset($teacher->subjects))
    {
        $preset_subs=''; 
        foreach ($teacher->subjects as $key => $subject) {
            $preset_subs =$preset_subs.$subject->id.",";
        }
        $preset_subs = rtrim($preset_subs, ',');
    }

    if(isset($teacher->classrooms))
    {
        $preset_classes=''; 
        foreach ($teacher->classrooms as $key => $classroom) {
            $preset_classes =$preset_classes.$classroom->id.",";
        }
        $preset_classes = rtrim($preset_classes, ',');
    }
} 
?>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('teacher_id') ? 'has-error' : ''}}">
    {!! Form::label('teacher_id', 'Teacher Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('teacher_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('teacher_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('BirthDay', 'BirthDay', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {{-- {!! Form::select('classroom_id', $classrooms, old('classroom_id'), ['class' => 'form-control']) !!} --}}
        @if( isset($teacher) && $teacher->bd)
        <?php $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $teacher->bd))); ?>
        <input type="date" value="{{$newDate}}" name="bd" >
        @else
        <input type="date" value="" name="bd">
        @endif
        {!! $errors->first('classroom_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Gender', 'Gender', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
     <input type="radio" name="female" value="0" <?php if( isset($teacher) && $teacher->female!=1) echo "checked"; ?>> Male<br>
     <input type="radio" name="female" value="1" <?php if( isset($teacher) && $teacher->female==1) echo "checked"; ?>> Female<br>
     {!! $errors->first('classroom_id', '<p class="help-block">:message</p>') !!}
 </div>
</div>

<div class="form-group">
    {!! Form::label('Address', 'Address', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
     {!! Form::text('address', null, ['class' => 'form-control']) !!}
 </div>
</div>

<div class="form-group">
    {!! Form::label('State', 'State', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
     {!! Form::text('state', null, ['class' => 'form-control']) !!}
 </div>
</div>

<div class="form-group">
    {!! Form::label('Original Hometown', 'Original Hometown', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
     {!! Form::text('hometown', null, ['class' => 'form-control']) !!}
 </div>
</div>

<div class="form-group">
    {!! Form::label('Phone Number', 'Phone Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
     {!! Form::tel('phone_number', null, ['class' => 'form-control']) !!}
 </div>
</div>

<div class="form-group">
    {!! Form::label('Email', 'Email', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
     {!! Form::email('email', null, ['class' => 'form-control']) !!}
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

        <select class="form-control" multiple="multiple" name="subjects[]" id="subject_id">
            <option value=""></option>
        </select>


        {!! $errors->first('school_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('school_id') ? 'has-error' : ''}}">
    {!! Form::label('school', 'School', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {{-- {!! Form::select('school_id', $schools, old('school_id'), ['class' => 'form-control']) !!} --}}
        <?php $schools=\App\School::all();   ?>

        <select class="form-control" id="school_id" name="school_id">
           <option value="">Please choose a school</option>
           @foreach($schools as $school)
           @if (isset($teacher) && $teacher->school_id == $school->id)
           <option value="{{ $school->id }}" selected>{{ $school->name }}</option>

           @else
           <option value="{{ $school->id }}">{{ $school->name }}</option>
           @endif
           @endforeach
       </select>
       {!! $errors->first('school_id', '<p class="help-block">:message</p>') !!}
   </div>
</div>

<div class="form-group {{ $errors->has('school_id') ? 'has-error' : ''}}">
    {!! Form::label('Classroom', 'Classroom', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">

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
        var sid =$('#school_id').val();
        $.get('/ajax-classroom/' + sid + '/' + 0 + '/' + <?php echo date("Y"); ?>,function(data){
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

@if ( isset($submitButtonText) && strtolower($submitButtonText)=="update" && isset($teacher_id))
<?php  $user_id = getUserIdFromSid($teacher_id); ?>
<div class="row">
    <div class="col-lg-4"> 
        <div class="btn btn-danger" style="width: 100%; <?php if(!empty($user_id)) echo "display:none;" ?>" id="assign_student" >Assign Teacher Account</div>
        <div class="btn btn-warning" style="width: 100%; <?php if(empty($user_id)) echo "display:none;" ?>" id="unassign_student" >Unassign Teacher Account</div>
        <div class="btn btn-success" style="width: 100%; <?php if(empty($user_id)) echo "display:none;" ?>" id="reset_pass" >Reset Password</div>
    </div>
    <div class="col-lg-6" id="account_display">
    <p><b>User email: </b><span id="user_name"></span></p>
        <p><b>Password: </b><span id="password"></span></p>
    </div>
    <script>
        $('#assign_student').on('click',function(e) {
            /* Act on the event */

            var sid = encodeURIComponent("{{$teacher_id}}");
            var role = 'teacher';
            var name = encodeURIComponent($('input#name').val());

            $.get('/ajax-member/' + sid + '/' + name + '/' + role  ,function(data){
            //success data
            console.log(data);

            $('span#user_name').text(data.email);
            $('span#password').text(data.ps);
            
            $('#assign_student').fadeOut();
            $('#unassign_student').fadeIn();
            $('#reset_pass').fadeIn();

        }).fail(function(e) {
           console.log(e.error());
       });
    });

        $('#unassign_student').on('click',function(e) {
            /* Act on the event */
            var sid = encodeURIComponent("{{$teacher_id}}");
            $.get('/ajax-unassign/' + sid  ,function(data){
                //success data
                // alert(data);

                $('span#user_name').text('');
                $('span#password').text('');
                
                $('#assign_student').fadeIn();
                $('#unassign_student').fadeOut();
                $('#reset_pass').fadeOut();

            }).fail(function(e) {
             console.log(e.error());
         });
        });

        $('#reset_pass').on('click',function(e) {
            /* Act on the event */
            var sid = encodeURIComponent("{{$teacher_id}}");
            $.get('/ajax-reset_pass/' + sid  ,function(data){
                //success data
                console.log(data);

                $('span#user_name').text(data.email);
                $('span#password').text(data.ps);
                

            }).fail(function(e) {
             console.log(e.error());
         });
        });
    </script>
</div> 
<script>
  var lid = $('#level_id').val();
  $.get('/ajax-subject/' + lid,function(data){
            //success data
            console.log(data);
            $('#subject_id').empty();
            $.each(data, function(index,subjectObj){

                $('#subject_id').append('<option value="'+subjectObj.id+'">'+subjectObj.name+'</option>');
                $('#subject_id').val([{{$preset_subs}}]);
            })
        });
  /* Act on the event */
  var sid =$('#school_id').val();
  $.get('/ajax-classroom/' + sid + '/' + 0 + '/' + <?php echo date("Y"); ?>,function(data){
        //success data
        console.log(data);
        $('#classroom_id').empty();
        $.each(data, function(index,classObj){
            $('#classroom_id').append('<option value="'+classObj.id+'">'+classObj.name+'</option>');
            $('#classroom_id').val([{{$preset_classes}}]);
        })
    }); 
</script>

@else


@endif

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