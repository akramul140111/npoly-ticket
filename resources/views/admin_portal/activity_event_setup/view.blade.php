@section('content')
    @include('layouts.modalFormSubmit')
    <?php ini_set('memory_limit', -1) ?>
    <div id="printableArea">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="width-100p text-align-center">Activity/Event</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped jambo_table bulk_action table-borderd">
                        <tbody>
                        <tr>
                            <td>Activity Name</td>
                            <td>{{$activityEventInfo->activity_name}}</td>
                        </tr>
                        <tr>
                            <td>Description Name</td>
                            <td>{{$activityEventInfo->descripton}}</td>
                        </tr>

                        <tr>
                            <td>Active Status</td>
                            <td>
                                @if($activityEventInfo->active_status == 1){{"Active"}}@else {{"Inactive"}} @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>