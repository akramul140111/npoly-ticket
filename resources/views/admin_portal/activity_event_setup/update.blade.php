@section('content')
    @include('layouts.modalFormSubmit')
    @php $actionUrl=url('/updateActivityEvent'); @endphp
    <script>$('form').parsley();</script>
    <?php ini_set('memory_limit', -1) ?>
    <link rel="stylesheet" href="{{URL::asset('assets/custom_css/block_create.css')}}">
    <div class="flash-message"></div>
    <form id="BlockForm" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="x_title">
                        <h2 class="width-100p text-align-center">Update Activity/Event</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Activity Name*</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control" name="activity_name" value="{{$activityEventInfo->activity_name}}" id="activity_name" required>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Description*</label>
                        <div class="col-md-9 col-sm-9">
                            <textarea class="form-control" name="descripton" id="descripton">{{$activityEventInfo->descripton}}</textarea>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Active Status <span class="required  input-field-required-sign">*</span></label>
                        <div class="col-md-8 col-sm-8">
                            <select  class="form-control" name="active_status">
                                <option value="1" {{ ($activityEventInfo->active_status==1)? 'selected':'' }}>Active</optin>
                                <option value="0">Inactive</optin>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- Submit Button -->
        <div class="col-md-12 text-align-center">
            <input type="hidden" name="activity_id" value="{{$activityEventInfo->activity_id}}">
            <button type="submit" id='saveBtn' class="btn btn-primary">Submit</button>
            <button type='reset' class="btn btn-success">Reset</button>
        </div>
    </form>