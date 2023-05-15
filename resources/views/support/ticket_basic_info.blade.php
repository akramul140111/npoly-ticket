                <table class="table table-responsive ">
                    <tbody><tr class="info">
                        <td colspan="2">
                            <b>Ticket Basic Info</b>
                            @if($result->ticket_status !='230')
                            <a class="btn btn-success pull-right" id="edit_ticket_info" data-action="{{url('/editTicketInfo')}}" href="#">
                                <i class="glyphicon glyphicon-pencil"></i> Edit
                            </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td> Client Name </td>
                        <td>{{$result->client_name}}</td>
                    </tr>
                    <tr>
                        <td> Project Name </td>
                        <td>{{$result->project_name}}</td>
                    </tr>
                    <tr>
                        <td> Ticket Title </td>
                        <td>{{$result->ticket_title}}</td>
                    </tr>
                    <tr>
                        <td> Ticket Description </td>
                        <td>
                            <p>{{$result->ticket_desc}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Ticket Create Date and Time</td>
                        <td>{{date('d-M-Y H:i A',strtotime($result->created_at))}}</td>

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


