$(document).ready(function(){
    var baseUrl = document.location.origin;

   

    $('#level_id').on('change',function(e) {

        $('#grade_id').empty();
        $('#classroom_id').empty();

        var cid = e.target.value;
        $.get('/ajax-school/' + cid,function(data){
        
        $('#school_id').empty();
        $('#school_id').append('<option value="">Please choose a school</option>');

        $('#filter_header').empty();
        $('#filter_content').empty();
        $('#filter_header').append('<tr><th> School </th><th>Actions</th></tr>');
        $.each(data, function(index,schoolObj){
            $('#school_id').append('<option value="'+schoolObj.id+'">'+schoolObj.name+'</option>');

            $('#filter_content').append('<tr><td>'+schoolObj.name+'</td><td><a href="'+ baseUrl +'/admin/schools/'+ schoolObj.id 
                +'" class="btn btn-success btn-xs" title="View School"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a></td>');
        })
    });


    });

    // check on load
    var lid = $('#level_id').val();
    if(lid && lid!="")
    {
        var sid = $('#school_id').val();

        $.get('/ajax-grade/' + lid,function(datag){
            //success data
            console.log(datag);
            $('#grade_id').empty();
            $('#grade_id').append('<option value="">Please choose a grade</option>');
            $.each(datag, function(index,gradeObj){
                $('#grade_id').append('<option value="'+gradeObj.id+'">'+gradeObj.name+'</option>');
            })
        });
    }

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

    // /* Act on the event */

    var gid = $('#grade_id').val();
     if(gid && gid!="")
    {
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
    }

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

    $('#principle_grade').on('change',function(e) {
        /* Act on the event */

        console.log(e);

        var gid = e.target.value;
        var uid = $('#user_id').val();
        var sid = $('#school_id').val();

        console.log(uid);

        $('#principle_bargraph').empty();
        $.get('/ajax-principle-dashboard/' + uid + '/' + gid,function(data){
            console.log(data);

            var graphdata = data;
            var ctx = document.getElementById('principle_bargraph').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: graphdata ,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Grade ' + gid + ' Perfomance and Behavior of all Classes',
                    }
                }
            });

        });

        $.get('/ajax-principle-dashboard-gender/' + sid + '/' + gid,function(data){
            var graphdata = data;
            var ctx = document.getElementById('principle_male_female').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: graphdata ,
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Grade ' + gid + ' Gender ratio',
                    }
                }
            });
        });
    });

    $('#teacher_graph').on('change',function(e) {
        /* Act on the event */

        console.log(e);

        var option = e.target.value;
        var uid = $('#user_id').val();
        var sid = $('#school_id').val();

        console.log(uid);

        if(option==1)
        {
            $("#teacher_subject_graph").show();
            $("#teacher_student_graph").hide();
        }
        else if(option==2)
        {
            $("#teacher_subject_graph").hide();
            $("#teacher_student_graph").show();
        }
    });
});
