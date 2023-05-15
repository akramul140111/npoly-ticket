
@include('layouts.modalFormSubmit')
    @php $actionUrl=url('/storeAssignActivity'); @endphp
<style>
    ul li.active, a.active {
        color: #3fbbc0;
    }
    .checkbox-group{
        margin-top: 20px;
        background-color: #cdedfc;
    }
    .checkbox-style{
        margin-bottom: 10px;
    }
    .button-style{
        margin-top: 10px;
    }
</style>
<link rel="stylesheet" href="{{URL::asset('assets/custom_css/block_index_academic_officer.css')}}">
<div class="" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{--<div class="row">--}}
            {{--<div class="col-md-12 col-sm-12 col-lg-12">--}}
                {{--<div class="x_panel">--}}

                    <style>
                        .dt-buttons{

                        }
                    </style>
                    <div class="x_content">
                        <form id="" data-parsley-validate="" role="form" method="post" action="{{$actionUrl}}" class="form-label-left" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 checkbox-group">
                                    <div class="col-md-12 checkbox-group">
                                        @foreach($activityInof as $activity)

                                            <div class="form-check checkbox-style">
                                                <input class="form-check-input activityStatus" type="checkbox" name="activity_id[]"
                                                       @if($assignActivityInfo)!='')
                                                       @foreach($assignActivityInfo as $value)
                                                       @if($value->activity_id==$activity->activity_id)
                                                       checked
                                                       @endif
                                                       @endforeach
                                                       @endif

                                                       value="{{$activity->activity_id}}">
                                                <label class="form-check-label">
                                                    {{$activity->activity_name}}
                                                </label>
                                            </div>

                                        @endforeach
                                            <input type="hidden" id="course_type" name="course_type" value="{{$type}}">
                                            <input type="hidden" id="department" name="department" value="{{$dept}}">
                                            <input type="hidden" id="courseName" name="course_name" value="{{$course}}">
                                    </div>
                                </div>

                            </div>

                            <!-- Submit Button -->
                            <div class="col-md-12 text-align-center button-style">
                                <button   type="submit" id='saveBtn' class="btn btn-primary">Submit</button>
                                <button type='reset' class="btn btn-success">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

{{--<script>--}}
    {{--$(document).off("click", ".activityStatus").on("click", ".activityStatus", function () {--}}
        {{--var thisRowU = $(this).closest('div');--}}
        {{--var activeStatus = thisRowU.find('input.activityStatus').val();--}}
        {{--var department = $("#department").val();--}}
        {{--var courseName = $("#courseName").val();--}}
        {{--$.ajax({--}}
            {{--type: "POST",--}}
            {{--url: "asignActivitiesStatus",--}}
            {{--data: {"_token": "{{ csrf_token()}}", "activeStatus": activeStatus, department:department, courseName:courseName},--}}
            {{--success: function (result) {--}}
                {{--//alertify.alert(result);--}}
            {{--}--}}
        {{--});--}}
    {{--});--}}

{{--</script>--}}









