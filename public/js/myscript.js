$(document).ready(function(){
    var baseUrl = document.location.origin;
    $('#level_id').on('change',function(e) {
        /* Act on the event */
        console.log(baseUrl);
        $('#grade_id').empty();
        $('#classroom_id').empty();

        var cid = e.target.value;
        $.get('/ajax-school/' + cid,function(data){
        //success data
        console.log(data);
        $('#school_id').empty();
        $('#school_id').append('<option value="">Please choose a school</option>');

        $('#filter_header').empty();
        $('#filter_content').empty();
        $('#filter_header').append('<tr><th> School </th><th>Actions</th></tr>');
        $.each(data, function(index,schoolObj){
            $('#school_id').append('<option value="'+schoolObj.id+'">'+schoolObj.name+'</option>');

            $('#filter_content').append('<tr><td>'+schoolObj.name+'</td><td><a href="'+ baseUrl +'/admin/schools/'+ schoolObj.id +'" class="btn btn-success btn-xs" title="View School"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a></td>');
            })
        });

       
    });

     $('#school_id').on('change',function(e) {
        /* Act on the event */

        console.log(e);

        var sid = e.target.value;
        // var gid = $('#grade_id').val();
        var lid = $('#level_id').val();

        console.log(sid);

         $.get('/ajax-grade/' + lid,function(datag){
        //success data
        console.log(datag);
        $('#grade_id').empty();
        $('#grade_id').append('<option value="">Please choose a grade</option>');
        $.each(datag, function(index,gradeObj){
            $('#grade_id').append('<option value="'+gradeObj.id+'">'+gradeObj.name+'</option>');
        })
        });
    });

      $('#grade_id').on('change',function(e) {
        /* Act on the event */

        console.log(e);

        var gid = e.target.value;
        var sid = $('#school_id').val();

        $('#filter_header').empty();
        $('#filter_content').empty();
        $('#filter_header').append('<tr><th> Class </th><th>Actions</th></tr>');
        $.get('/ajax-classroom/' + sid + '/' + gid,function(data){
            //success data
            console.log(data);
            $('#classroom_id').empty();
            $('#classroom_id').append('<option value="">Please choose a class</option>');

            $.each(data, function(index,classObj){

                $('#classroom_id').append('<option value="'+classObj.id+'">'+classObj.name+'</option>');
                $('#filter_content').append('<tr><td>'+classObj.name+'</td><td><a href="'+ baseUrl +'/admin/classrooms/'+ classObj.id +'" class="btn btn-success btn-xs" title="View Class"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a></td>');
            })
        });
    });

    $('#classroom_id').on('change',function(e) {
        /* Act on the event */
        console.log(e);
        var cid = e.target.value;

        $.get('/ajax-student/' + cid,function(data){

            $('#filter_header').empty();
            $('#filter_content').empty();
            $('#filter_header').append('<tr><th> Name </th><th> Student Id </th><th>Actions</th></tr>');
            //success data
            $.each(data, function(index,studentObj){
                $('#filter_content').append('<tr><td>'+studentObj.name+'</td><td>'+studentObj.student_id+'</td><td><a href="'+ baseUrl +'/admin/students/'+ studentObj.id +'" class="btn btn-success btn-xs" title="View Student"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a></td>');
            })
        });
    });
});
