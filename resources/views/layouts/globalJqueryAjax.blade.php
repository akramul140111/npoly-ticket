<script>
/*
$('#saveBtnStudentInfo').click(function(e){
    if($('#students_name').val()==''){
        $("#students_name").focus(); $("#students_name").css({"border": "1px solid #f95e5e"}); return false;
    }else{
        $("#students_name").css({"border": "1px solid #ced4da"});
    }
    if($('#stu_id').val()==''){
        $("#stu_id").focus(); $("#stu_id").css({"border": "1px solid #f95e5e"}); return false;
    }else{
        $("#stu_id").css({"border": "1px solid #ced4da"});
    }
    if($('#session_years').val()==''){
        $("#session_years").focus(); $("#session_years").css({"border": "1px solid #f95e5e"}); return false;
    }else{
        $("#session_years").css({"border": "1px solid #ced4da"});
    }
    if($('#batch_no').val()==''){
        $("#batch_no").focus(); $("#batch_no").css({"border": "1px solid #f95e5e"}); return false;
    }else{
        $("#batch_no").css({"border": "1px solid #ced4da"});
    }
    if($('#course_type').val()==''){
        $("#course_type").focus(); $("#course_type").css({"border": "1px solid #f95e5e"}); return false;
    }else{
        $("#course_type").css({"border": "1px solid #ced4da"});
    }
    if($('#department').val()==''){
        $("#department").focus(); $("#department").css({"border": "1px solid #f95e5e"}); return false;
    }else{
        $("#department").css({"border": "1px solid #ced4da"});
    }
    if($('#course_name').val()==''){
        $("#course_name").focus(); $("#course_name").css({"border": "1px solid #f95e5e"}); return false;
    }else{
        $("#course_name").css({"border": "1px solid #ced4da"});
    }
    if($('#gender').val()==''){
        $("#gender").focus(); $("#gender").css({"border": "1px solid #f95e5e"}); return false;
    }else{
        $("#gender").css({"border": "1px solid #ced4da"});
    }

    var id = $('#stu_id').val();
    if(id==''){
        return false;
    }else{

        $.ajax({
            type:'post',
            url:'<?php echo url("/checkDuplicateStuId/"); ?>',
            cache : false,
            data : {
                'id':id,
                '_token': $("#_token").val()
            },
            success:function(data){
                if(data==1){
                    $('#informationForm').attr('action', '{{$actionUrl}}');
                    $("#informationForm").submit();
                }else{
                    alertify.alert('Student Id already taken!');
                    $('#stu_id').val('');
                    e.preventDefault();
                    return false;
                }
            }
        });
    }
});*/

 /*
$(document).ready(function () {
    $('#informationForm').on('submit',function (e) {
        e.preventDefault();
        console.log(555);
        var url = $(this).attr('action');
        // $('.modal').modal('hide');
        console.log(this);
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //data: $('#informationForm').serialize(),
            data: formData,
            success: function (response) {
                // $('.modal').modal('hide');
                //    $("#msg").html("Recipe Saved");
                //  $("#msg").fadeOut(2000);
                //  table.draw();
                $('div.flash-message').html(response);
                // setTimeout(function() {
                //   $("div.hide-message").hide('blind', {}, 500)
                // }, 5000);

                window.location.reload();
            },
            error: function (response) {
                console.log('Error:', response);
                //  $('#saveBtn').html('Save Changes');
            }
        });
    })

})*/

</script>