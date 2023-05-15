<table class="table table-responsive ">
    <tbody><tr class="info">
        <td colspan="2">
            <b>Ticket Status Info</b>
            <a class="btn btn-success pull-right" id="edit_ticket_info" data-action="{{url('/editStatusInfo')}}" href="#">
                <i class="glyphicon glyphicon-pencil"></i> Edit
            </a>
        </td>
    </tr>
    <tr>
        <td>Status </td>
        <td>{{$result->ticketStatus}}</td>
    </tr>
    <tr>
        <td>Type </td>
        <td>{{$result->requestType}}</td>
    </tr>
    <tr>
        <td> Priority </td>
        <td>{{$result->priorityName}}</td>
    </tr>
    <tr>
        <td>Request Mode </td>
        <td>
            <p>{{$result->requestMode}}</p>
        </td>
    </tr>
    <tr>
        <td>Resolution </td>
        <td>
            <p>{{$result->resolution}}</p>
        </td>
    </tr>
    <tr>
        <td>Remarks </td>
        <td>
            <p>{{$result->remarks}}</p>
        </td>
    </tr>
    </tbody></table>

<script>
    $('#edit_ticket_info').click(function () {

        var ticketId = $("#ticketId").val();
        var action_uri = $(this).attr('data-action');
        $.ajax({
            type: "POST",
            url: action_uri,
            data: { ticketId:ticketId,_token:'{{csrf_token()}}'},
            success: function (data){
                $('.ticket-content').html(data);
            }
        });
    });
</script>


