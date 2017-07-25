<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('radio') ? 'has-error' : ''}}">
    {!! Form::label('radio', 'Role', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('radio', ['father', 'mother', 'other'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('radio', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('BirthDay', 'BirthDay', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        @if( isset($guardian) && $guardian->bd)
            <?php $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $guardian->bd))); ?>
            <input type="date" value="{{$newDate}}" name="bd" >
        @else
            <input type="date"  value="" name="bd">
        @endif
        {!! $errors->first('classroom_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Parent of Student Id', 'Parent of Student Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        @if( isset($guardian) && $guardian->student)
            <input type="text" class="form-control" value="{{$guardian->student['student_id']}}" name="student_id" id="child_student_id" >
        @else
            <input type="text" class="form-control" value="" name="student_id" id="child_student_id">
        @endif
        {!! $errors->first('classroom_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('Original Hometown', 'Original Hometown', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
       {!! Form::text('home_state', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Job', 'Job', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
       {!! Form::text('job', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('Phone Number', 'Phone Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
       {!! Form::tel('phone_number', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>


@if ( isset($submitButtonText) && strtolower($submitButtonText)=="update" && isset($guardian->student['student_id']))
<?php  $user_id = getUserIdFromSid($guardian->student['student_id']); ?>
<div class="row">
    <div class="col-lg-4"> 
        <div class="btn btn-danger" style="width: 100%; <?php if(!empty($user_id)) echo "display:none;" ?>" id="assign_student" >Assign Parent Account</div>
        <div class="btn btn-warning" style="width: 100%; <?php if(empty($user_id)) echo "display:none;" ?>" id="unassign_student" >Unassign Parent Account</div>
        <div class="btn btn-success" style="width: 100%; <?php if(empty($user_id)) echo "display:none;" ?>" id="reset_pass" >Reset Password</div>
    </div>
    <div class="col-lg-6" id="account_display">
        <p><b>User email: </b><span id="user_name"></span></p>
        <p><b>Password: </b><span id="password"></span></p>
    </div>
    <script>
        $('#assign_student').on('click',function(e) {
            /* Act on the event */

            var sid = encodeURIComponent('PA-' + $("select#radio").val() + '-' + $('input#child_student_id').val());
            var role = 'parent';
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
            var sid = encodeURIComponent('PA-' + $("select#radio").val() + '-' + $('input#child_student_id').val());
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
            var sid = encodeURIComponent('PA-' + $("select#radio").val() + '-' + $('input#child_student_id').val());
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
@else


@endif
