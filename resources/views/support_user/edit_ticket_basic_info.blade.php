@section('content')
    @include('layouts.modalFormSubmit')
    @php $actionUrl=url('/updateTicketBasicInfo'); @endphp
    <script>$('form').parsley();</script>
    <?php ini_set('memory_limit', -1) ?>
    <div class="flash-message"></div>
    <div class="x_content">
        <form id="ClassRoutineForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}"
              class="form-label-left" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3  label-align">Client*</label>
                <div class="col-md-6 col-sm-6">
                    <select class="form-control" name="client_id" required id="clientId">
                        <option value="">--select--</option>
                        @foreach($clinets as $cli)
                            <option value="{{$cli->client_id}}" @if($ticketInfo->client_id ==$cli->client_id) selected @endif>{{$cli->client_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3  label-align">Project*</label>
                <div class="col-md-6 col-sm-6">
                    <select class="form-control" name="project_id" id="project_id" required>
                        <option value="">--select--</option>
                        @foreach($projects as $pro)
                            <option value="{{$pro->project_id}}" @if($ticketInfo->project_id ==$pro->project_id) selected @endif>{{$pro->project_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Ticket Title*</label>
                <div class="col-md-6 col-sm-6">
                    <input type="text" value="{{$ticketInfo->ticket_title}}" class="form-control" name="ticket_title" required />
                </div>

            </div>
            <div class="field item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Ticket Description*</label>
                <div class="col-md-6 col-sm-6">
{{--                    <input type="text" class=" form-control" name="ticket_desc" required />--}}
                    <textarea name="ticket_desc" class="form-control">{{$ticketInfo->ticket_desc}}</textarea>
                </div>
            </div>

            <div class="clearfix"></div>
            <input type="hidden" value="{{$ticketInfo->id}}" name="ticket_id">

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                    <button type='reset' class="btn btn-success">Reset</button>
                </div>
            </div>

        </form>
    </div>

    <script type="text/javascript">
        $(document).on('focus', '.datepickerMonthYearAppend', function(e){
            $(e.target).daterangepicker({
                singleDatePicker: true,
                singleClasses: "picker_1",
                showDropdowns: true,
                minDate: $('#block_from_date').val(),
                maxDate: $('#block_to_date').val(),
                locale: {
                    format: "DD-MM-YYYY"
                }
            })
        }).on('show.daterangepicker', function () {
            $('.table-condensed tbody tr:nth-child(2) td').click();
        });

        $('.time-picker').datetimepicker({
            format: 'hh:mm A'
        });

        // get day of a date
        function getDay() {
            var cDate = $('#class_start_date').val();
            if (cDate != '') {
                $.ajax({
                    type: 'GET',
                    url: '{{url("/getDay")}}/' + cDate,
                    success: function (data) {
                        $("#dayval").val(data);
                    }
                });
            }
        }

        // block date validation for class routine add
        $('#block_id').change(function(){
            $('#btnSubmit').prop("disabled",true);
            var blockID = $('#block_id').val();
            if (blockID != '') {
                $.ajax({
                    type: 'GET',
                    url: '{{url("/classRoutine/getBlockDate/")}}/' + blockID,
                    success: function (data) {
                        $('#block_from_date').val(data.dateForm);
                        $('#block_to_date').val(data.dateTo);
                        $('#class_start_date').focus();
                        // drp-calendar left single dspla none
                        if(data.status==1){
                            $('#btnSubmit').prop("disabled",false);
                        }
                    }
                });
            }
        });

    </script>

    <script>
        $('#clientId').change(function(){
            var clientId = $(this).val();
            $('#project_id').html('<option value="">--select--</option>');
            if(clientId!=''){
                $.ajax({
                    type: 'GET',
                    url: '{{url("/ticket/getProject")}}/'+clientId,
                    success: function (data) {
                        $('#project_id').html(data);
                    }
                });
            }
        });
    </script>
