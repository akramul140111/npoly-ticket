<table class="table table-responsive ">
    <tbody><tr class="info">
        <td colspan="2">
            <b>Ticket Assign Info</b>
            <a class="btn btn-success pull-right" id="edit_ticket_info" data-action="{{url('/editAssignInfo')}}" href="#">
                <i class="glyphicon glyphicon-pencil"></i> Edit
            </a>
        </td>
    </tr>
    <tr>
        <td> Assign To </td>
        <td>
           @if(!empty($result->employee_id))
               @php
               $empName = DB::selectOne("select employee_name from npoly_employees where employee_id = $result->employee_id");
               echo $empName->employee_name;
               @endphp
            @else

            @endif
        </td>
    </tr>
    <tr>
        <td> Assign Date </td>
        <td>
            @if(!empty($result->assign_date))
                {{date('d-M-Y',strtotime($result->assign_date))}}
            @else
            @endif
        </td>
    </tr>
    <tr>
        <td> Forecast Date </td>
        <td>
            @if(!empty($result->forecast_date))
                {{date('d-M-Y',strtotime($result->forecast_date))}}
            @else
            @endif
        </td>
    </tr>
    <tr>
        <td> Work Station </td>
        <td>
            <p>
                @if(!empty($result->work_station))
                    @if($result->work_station =='1')
                        In House
                    @else
                        Out Side Office
                        @endif
                @else
                @endif
            </p>
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


