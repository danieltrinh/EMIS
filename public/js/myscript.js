$(document).ready(function(){
    $('#level_id').on('change',function(e) {
        /* Act on the event */

        console.log(e);

        var cid = e.target.value;
        $.get('/ajax-school/' + cid,function(data){
        //success data
        console.log(data);
        $('#school_id').empty();
        $.each(data, function(index,schoolObj){
            $('#school_id').append('<option value="'+schoolObj.id+'">'+schoolObj.name+'</option>');
        })
        });

        $.get('/ajax-grade/' + cid,function(datag){
        //success data
        console.log(datag);
        $('#grade_id').empty();
        $.each(datag, function(index,gradeObj){
            $('#grade_id').append('<option value="'+gradeObj.id+'">'+gradeObj.name+'</option>');
        })
        });
    });

     $('#school_id').on('change',function(e) {
        /* Act on the event */

        console.log(e);

        var sid = e.target.value;
        var gid = $('#grade_id').val();

        console.log(sid);
        $.get('/ajax-classroom/' + sid + '/' + gid,function(data){
            //success data
            console.log(data);
            $('#classroom_id').empty();
            $.each(data, function(index,classObj){

                $('#classroom_id').append('<option value="'+classObj.id+'">'+classObj.name+'</option>');
            })
        });
    });

      $('#grade_id').on('change',function(e) {
        /* Act on the event */

        console.log(e);

        var gid = e.target.value;
        var sid = $('#school_id').val();

        console.log(sid);
        $.get('/ajax-classroom/' + sid + '/' + gid,function(data){
            //success data
            console.log(data);
            $('#classroom_id').empty();
            $.each(data, function(index,classObj){

                $('#classroom_id').append('<option value="'+classObj.id+'">'+classObj.name+'</option>');
            })
        });
    });

});
