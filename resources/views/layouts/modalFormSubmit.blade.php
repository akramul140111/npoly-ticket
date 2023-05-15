<script>

// $(document).ready(function () {
//     $('#informationForm').on('submit',function (e) {
//         e.preventDefault();
//         var url = $(this).attr('action');
//         // $('.modal').modal('hide');
//         console.log(this);
//         var formData = new FormData(this);
//         $.ajax({
//             url: $(this).attr('action'),
//             type: "POST",
//             dataType: 'json',
//             processData: false,
//             contentType: false,
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             //data: $('#informationForm').serialize(),
//             data: formData,
//             success: function (response) {
//                 // $('.modal').modal('hide');
//                 //    $("#msg").html("Recipe Saved");
//                 //  $("#msg").fadeOut(2000);
//                 //  table.draw();
//                 $('div.flash-message').html(response);
//                 // setTimeout(function() {
//                 //   $("div.hide-message").hide('blind', {}, 500)
//                 // }, 5000);

//                 window.location.reload();
//             },
//             error: function (response) {
//                 console.log('Error:', response);
//                 //  $('#saveBtn').html('Save Changes');
//             }
//         });
//     })

// })

    </script>