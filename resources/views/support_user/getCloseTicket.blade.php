<table id="datatable" class="table table-striped table-bordered dataTable"
       role="grid" aria-describedby="data-table-info" width="100%">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Technical SR #</th>
        <th>Product</th>
        <th>Severity</th>
        <th>Contact</th>
        <th>Status</th>
        <th>Last Update</th>
    </tr>
    </thead>
    <tbody>
    @foreach($results as $key=> $value)
        <tr>
            <td>{{$key+1}}</td>
            <td>
                <a style="color: #00b1ff" href="{{url('/getTicketDetailsInfo/'.$value->id)}}" class=" btn dynamicModal" data-target=".bs-example-modal-lg" data-modal-size="modal-xl">{{$value->ticket_no}}</a>

            </td>
            <td>{{$value->module_name}}</td>
            <td>{{$value->priorityName}}</td>
            <td>
                @if(!empty($value->contact_person))
                    @php
                        $contactPerson = DB::selectOne("select employee_name from npoly_employees where employee_id = $value->contact_person");
                        echo $contactPerson->employee_name;
                    @endphp
                @endif
            </td>
            <td>{{$value->ticketStatus}}</td>
            <td>@if(!empty($value->updated_at)){{date('d-M-Y h:i:A',strtotime($value->updated_at))}}@endif</td>
        </tr>
    @endforeach

    </tbody>
</table>

<script>
    $(document).ready(function(){
        setTimeout(function() {
            $("<div style='padding-left: 30px !important;'><i class='fa fa-file-text-o btn changeTicketInfo' style='padding-left: 30px !important; margin-top: 10px'></i></div>").insertAfter(".dataTables_length");
        }, 100);
    })
</script>
